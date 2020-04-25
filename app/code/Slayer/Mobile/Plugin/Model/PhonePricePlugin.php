<?php

namespace Slayer\Mobile\Plugin\Model;

use Magento\Directory\Model\Currency;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Template;
use Slayer\Mobile\Api\Data\PhoneInterface;

/**
 * Такс, тут мені потрібні роз'ясненя двох речей:
 *
 * 1. Навіщо ти створив непотрібний плагін у своєму модулі
 * на свій же інтерфейс (по суті на модель)? Ти міг би добавити
 * ці методи в свою модель
 *
 * 2. Навіть якщо чисто в тестових цілях - навіщо ти наслідуєшся від `Template` класу?
 * (для мене це загадка) :)
 *
 * Class PhonePricePlugin
 */
class PhonePricePlugin extends Template
{
    /**
     * Коментарі, форматування?)
     */
    protected $_storeManager;
    protected $_currency;

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var CurrencyFactory
     */
    protected $currencyFactory;

    /**
     * @param EventManager $eventManager
     * @param Context $context
     * @param Currency $currency
     * @param CurrencyFactory $currencyFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        EventManager $eventManager,
        Currency $currency,
        CurrencyFactory $currencyFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->eventManager = $eventManager;
        $this->_currency = $currency;
        $this->_storeManager = $storeManager;
        $this->currencyFactory = $currencyFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param $amountValue
     * @return float|int
     * @throws LocalizedException
     */
    private function convertPrice($amountValue)
    {
        $currentCurrency = $this->_storeManager->getStore()->getCurrentCurrencyCode();
        $baseCurrency = $this->_storeManager->getStore()->getBaseCurrency()->getCode();
        try {
            /**
             * ($currentCurrency && $baseCurrency) тобі верне `true` або `false`, не зрозуміло
             * до кінця чому ти вибрав порівняння з `null`. Можна було просто залишити
             * `if ($currentCurrency && $baseCurrency)`
             */
            if ($currentCurrency && $baseCurrency) {
                if ($currentCurrency != $baseCurrency) {
                    $rate = $this->_storeManager->getStore()->getCurrentCurrencyRate();
                    $amountValue = $amountValue * $rate;

                    /**
                     * Ідея зрозуміла, але тут є один нюанс: а які дані ти передаєш в
                     * обсервер для подальших маніпуляцій? Наприклад, я як розробник захочу
                     * вклинитися і щось тут перевірити в $amountValue. Як я цю змінну дістану
                     * з Обсервера? Ніяк.
                     */
                    $this->eventManager->dispatch('add_currency_logic_after', [
                        'amount_value' => $amountValue,
                        'rate' => $rate
                    ]);
                }
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $text = 'Error happened during currency loading."%s"';
            $message = sprintf($text, $error);
            $this->_logger->debug($message);
            throw new LocalizedException(__($message));
        }

        return $amountValue;
    }

    /**
     * @param PhoneInterface $subject
     * @param float $result
     * @return float
     */
    public function afterGetPrice(PhoneInterface $subject, $result)
    {
        $newResult = $result;

        try {
            if (is_numeric($result)) {
                $result = round($this->convertPrice($result), 2);
                $currencySymbol = $this->_currency->getCurrencySymbol();
                $newResult = "$result <b class=\"currency\"> $currencySymbol</b>";
            }
        } catch (\Exception $e) {
            $this->_logger->debug(__($e->getMessage()));
        }

        return $newResult;
    }
}