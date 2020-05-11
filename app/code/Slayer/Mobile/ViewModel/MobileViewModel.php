<?php

namespace Slayer\Mobile\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class MobileViewModel
 */
class MobileViewModel implements ArgumentInterface
{
    const MANUFACTURERS_COUNT = 'slayer_mobile/mobile_settings/manufacturers_count';

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param EventManager $eventManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EventManager $eventManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->eventManager = $eventManager;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCurrentDate()
    {
        $date = new \DateTime('now');
        return $date->format('d-M-yy');
    }

    /**
     * @return int
     */
    public function showManufacturersCountPerPage()
    {
        return (int)$this->scopeConfig->getValue(self::MANUFACTURERS_COUNT);
    }
}
