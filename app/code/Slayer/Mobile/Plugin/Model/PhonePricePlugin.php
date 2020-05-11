<?php

namespace Slayer\Mobile\Plugin\Model;

use Magento\Directory\Model\Currency;
use Magento\Directory\Model\CurrencyFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;
use Slayer\Mobile\Api\Data\PhoneInterface;

/**
 * Class PhonePricePlugin
 */
class PhonePricePlugin
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Currency
     */
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
     * @param Currency $currency
     * @param CurrencyFactory $currencyFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        EventManager $eventManager,
        Currency $currency,
        CurrencyFactory $currencyFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->eventManager = $eventManager;
        $this->_currency = $currency;
        $this->_storeManager = $storeManager;
        $this->currencyFactory = $currencyFactory;
    }

    /**
     * @param float $amountValue
     * @return float|int
     * @throws LocalizedException
     */
    private function convertPrice(float $amountValue)
    {
        $currentCurrency = $this->_storeManager->getStore()->getCurrentCurrencyCode();
        $baseCurrency = $this->_storeManager->getStore()->getBaseCurrency()->getCode();
        try {
            if ($currentCurrency && $baseCurrency) {
                if ($currentCurrency !== $baseCurrency) {
                    $rate = $this->_storeManager->getStore()->getCurrentCurrencyRate();
                    $amountValue *= $rate;
                    $this->eventManager->dispatch(
                        'add_convert_price_after',
                        [
                            'rate' => $rate,
                            'amount_value' => $amountValue
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            throw new LocalizedException(
                __('Error happened during currency loading. ' . $e->getMessage())
            );
        }

        return $amountValue;
    }

    /**
     * @param PhoneInterface $phoneModel
     * @param float $price
     * @return string
     * @throws LocalizedException
     */
    public function afterGetPrice(PhoneInterface $phoneModel, float $price)
    {
        try {
            $resultPrice = round($this->convertPrice($price), 2);
            $currencySymbol = $this->_currency->getCurrencySymbol();
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }

        return "$resultPrice <b class=\"currency\"> $currencySymbol</b>";
    }
}
