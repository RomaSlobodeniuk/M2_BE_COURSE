<?php

namespace Alex\Fin\Model;

use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\HTTP\ZendClient;
use Magento\Framework\HTTP\ZendClientFactory;
use Psr\Log\LoggerInterface;

/**
 * Class ExternalApi
 * @package Alex\Fin\Model
 */
class ExternalApi
{
    const EXTERNAL_CURRENCY_URL = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var SerializerInterface
     */
    protected $jsonHelper;

    /**
     * @var ZendClientFactory
     */
    protected $httpClientFactory;

    /**
     * @param LoggerInterface $logger
     * @param SerializerInterface $jsonHelper
     * @param ZendClientFactory $httpClientFactory
     */
    public function __construct(
        ZendClientFactory $httpClientFactory,
        LoggerInterface $logger,
        SerializerInterface $jsonHelper
    ) {
        $this->httpClientFactory = $httpClientFactory;
        $this->logger = $logger;
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * @return float
     */
    public function getExternalCurrency()
    {
        try {
            /** @var ZendClient $httpClient */
            $httpClient = $this->httpClientFactory->create();
            $response = $httpClient->setUri(self::EXTERNAL_CURRENCY_URL)
                ->request('GET')
                ->getBody();
            $data = $this->jsonHelper->unserialize($response);
            return floatval($data["0"]["sale"]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $this->logger->debug($error);
            return 1;
        }
    }
}