<?php

namespace Slayer\Mobile\Model\Currency\Import;

use Magento\Directory\Model\CurrencyFactory;
use Magento\Directory\Model\Currency\Import\AbstractImport;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\ZendClient;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Currency rate import model (From https://currencylayer.com/)
 */
class CurrencyLayer extends AbstractImport
{
    /**
     * @var string
     */
    const CURRENCY_CONVERTER_URL = 'http://apilayer.net/api/live?access_key={{API_KEY}}&currencies={{CURRENCY_TO}}' .
    '&source={{CURRENCY_FROM}}&format=1';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Http Client Factory
     *
     * @var ZendClientFactory
     */
    private $httpClientFactory;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param CurrencyFactory $currencyFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param ZendClientFactory $httpClientFactory
     * @param SerializerInterface $serializer
     */
    public function __construct(
        CurrencyFactory $currencyFactory,
        ScopeConfigInterface $scopeConfig,
        ZendClientFactory $httpClientFactory,
        SerializerInterface $serializer
    ) {
        parent::__construct($currencyFactory);
        $this->scopeConfig = $scopeConfig;
        $this->httpClientFactory = $httpClientFactory;
        $this->serializer = $serializer;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param int $retry
     * @return float|null
     */
    protected function _convert($currencyFrom, $currencyTo, $retry = 0)
    {
        $result = null;
        $timeout = (int)$this->scopeConfig->getValue(
            'currency/currencyLayer/timeout',
            ScopeInterface::SCOPE_STORE
        );
        $apiKey = $this->scopeConfig->getValue(
            'currency/currencyLayer/apikey',
            ScopeInterface::SCOPE_STORE
        );
        $url = str_replace('{{CURRENCY_FROM}}', $currencyFrom, self::CURRENCY_CONVERTER_URL);
        $url = str_replace('{{CURRENCY_TO}}', $currencyTo, $url);
        $url = str_replace('{{API_KEY}}', $apiKey, $url);

        /** @var ZendClient $httpClient */
        $httpClient = $this->httpClientFactory->create();

        try {
            $response = $httpClient->setUri($url)
                ->setConfig(['timeout' => $timeout])
                ->request('GET')
                ->getBody();

            $resultKey = $currencyFrom . $currencyTo;
            $data = $this->serializer->unserialize($response);

            if (isset($data['quotes'][$resultKey])) {
                $result = (float)$data['quotes'][$resultKey];
            } else {
                $this->_messages[] = __('We can\'t retrieve a rate from %1.', $url);
            }
        } catch (\Exception $e) {
            if ($retry == 0) {
                $this->_convert($currencyFrom, $currencyTo, 1);
            } else {
                $this->_messages[] = __('We can\'t retrieve a rate from %1.', $url);
            }
        }

        return $result;
    }
}
