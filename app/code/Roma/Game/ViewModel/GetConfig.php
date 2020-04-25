<?php

namespace Roma\Game\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class GetConfig Знову - фоматування ?
 */
class GetConfig implements ArgumentInterface
{
    const PRINT_CUSTOMER = 'game_shop_customer_config/settings_output/how_customer_print';
    const MY_SORT_ORDER = 'game_shop_customer_config/sort_group/sort_order';
    const SORT_FIELD = 'game_shop_customer_config/sort_group/sort_filed';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Що це ?
     */
    private $logger;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Psr\Log\LoggerInterface $logger // винести!
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->logger=$logger;
    }

    /**
     * @return int
     */
    public function getCustomersPrintValue()
    {
        $result = 1;
        try {
            $result = $this->scopeConfig->getValue(
                self::PRINT_CUSTOMER,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return (int)$result;
    }

    /**
     * @return mixed|string
     */
    public function getSortFiled()
    {
        $result = 'entity_id';
        try {
            $result = $this->scopeConfig->getValue(
                self::SORT_FIELD,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }

    /**
     * @return mixed|string
     */
    public function getSortOrder()
    {
        $result = 'ASC';
        try {
            $result = $this->scopeConfig->getValue(
                self::MY_SORT_ORDER,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }
}