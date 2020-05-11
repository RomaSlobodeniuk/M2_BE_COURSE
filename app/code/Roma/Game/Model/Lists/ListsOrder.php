<?php

namespace Roma\Game\Model\Lists;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class ListsOrder
 *
 * Generating a list with a fields for the direction of sorting of customers
 */
class ListsOrder implements OptionSourceInterface{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $resultArray[] = [
            'label' => 'ASC',
            'value' => SortOrder::SORT_ASC
        ];
        $resultArray[] = [
            'label' => 'DESC',
            'value' => SortOrder::SORT_DESC
        ];
        return $resultArray;
    }
}