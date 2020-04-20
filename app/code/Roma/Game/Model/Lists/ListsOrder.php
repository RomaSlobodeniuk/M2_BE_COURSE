<?php

namespace Roma\Game\Model\Lists;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class ListField - форматування знову ріже мені сам знаєш що )
 *
 * Де Doc блоки?
 */
class ListsOrder implements OptionSourceInterface{

    public function toOptionArray()
    {
        $resultArray[] = [
            'label' => 'ASC',
            'value' => SortOrder::SORT_ASC];
        $resultArray[] = [
            'label' => 'DESC',
            'value' => SortOrder::SORT_DESC];
        return $resultArray;
    }
}