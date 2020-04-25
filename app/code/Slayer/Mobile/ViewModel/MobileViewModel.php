<?php

namespace Slayer\Mobile\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\App\Config\ScopeConfigInterface;

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
     */
    public function getCurrentDate()
    {
        /**
         * Якщо ти викидуєш виключення, то оголошення змінної тут немає сенсу, оскільки
         * до return діло не дійде
         */
        $result = '';

        /**
         * Тут дві помилки:
         *
         * 1. Використання блоку try/catch тут майже без сенсу;
         * 2. Якщо ти використовуєш try/catch щоб відловити виключення, то навіщо
         * це далі викидувати в phtml? Сторінка впаде, користувач бачитиме дивні
         * повідомлення.
         */
        try {
            /**
             * Знову ж таки який сенс у створенні обсерверу без передачі даних?
             */
            $this->eventManager->dispatch('manufacturers_block_current_date_before');
            $date = new \DateTime('now');
            $result = $date->format('d-M-yy');
            $this->eventManager->dispatch('manufacturers_block_current_date_after');
        } catch (\Exception $exception) {
            $message = "Error happened during application run.\n";
            $message .= $exception->getMessage();
            throw new \DomainException($message);
        }

        return $result;
    }

    /**
     * Ця функція не використовується ніде
     *
     * @return int
     */
    public function showManufacturersCountPerPage()
    {
        $result = null;
        try {
            $result = (int)$this->scopeConfig->getValue(self::MANUFACTURERS_COUNT);
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
        return $result;
    }
}
