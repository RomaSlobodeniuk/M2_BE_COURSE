<?php

namespace Alex\Fin\Model;

/**
 * use Magento\Framework\Serialize\SerializerInterface;
 */
use Magento\Framework\Json\Helper\Data;

use Magento\Framework\HTTP\ZendClient;
use Magento\Framework\HTTP\ZendClientFactory;

/**
 * Class ExternalApi
 * @package Alex\Fin\Model
 */
class ExternalApi
{
    const EXTERNAL_CURRENCY_URL = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    /**
     * @var Data // SerializerInterface
     */
    protected $jsonHelper;

    /**
     * Http Client Factory - це лишнє
     * @var ZendClientFactory
     */
    protected $httpClientFactory;

    /**
     * Де Опис Параметрів?
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        Data $jsonHelper
    ) {
        $this->httpClientFactory = $httpClientFactory;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * Де Doc блок? Що ця штука повертає?
     */
    public function getExternalCurrency()
    {
        try {
            /** @var ZendClient $httpClient */
            $httpClient = $this->httpClientFactory->create();
            $response = $httpClient->setUri(self::EXTERNAL_CURRENCY_URL)
                ->request('GET')
                ->getBody();

            /**
             * Magento\Framework\Json\Helper\Data - застарілий, використай
             * Magento\Framework\Serialize\SerializerInterface
             *
             * метод - unserialize
             */
            $data = $this->jsonHelper->jsonDecode($response);
            return floatval($data["0"]["sale"]);
        } catch (\Exception $e) {
            /**
             * Цього не повинно тут бути!
             */
            echo 'Currencyxceptions : ',  $e->getMessage(), "\n";
        }

        /**
         * Цей метод нічого не повертає у разі виключення!
         */
    }

}
