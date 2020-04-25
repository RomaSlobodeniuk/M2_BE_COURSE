<?php

namespace Owner\TaskModul\ViewModel;

/**
 * Рекомендації:
 *
 * Всі класи/інтерфейси в use повинні бути відсортованими по алфавіту.
 */
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class AdditionInfo
 * @package Owner\TestModul\ViewModel
 */
class AdditionInfo implements ArgumentInterface
{
    const USE_SORT = 'owner_task/settings/use_sort';

    const USE_NUMBER_RECORDS = 'owner_task/settings/number_records';

    const SCOPE_TYPE = 'store';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConf;

    /**
     * @param ScopeConfigInterface $scopeConf
     */
    public function __construct(
        ScopeConfigInterface $scopeConf
    )
    {
        $this->scopeConf = $scopeConf;
    }

    /**
     * @return int
     */
    public function getNumberRecord()
    {
        $result = 0;
        try {
            $result = (int)$this->scopeConf->getValue(self::USE_NUMBER_RECORDS, self::SCOPE_TYPE);
        } catch (\Exception $ex) {
            /**
             * Залогувати виключення
             */
        }

        return $result;
    }

    /**
     * True - use sort ASC. False - use sort DESC
     *
     * @return string
     */
    public function useSort()
    {
        $result = 'ASC';
        try {
            $result = $this->scopeConf->getValue(self::USE_SORT, self::SCOPE_TYPE);
        } catch (\Exception $ex) {
            /**
             * Залогувати виключення
             */
        }

        return $result;
    }
}