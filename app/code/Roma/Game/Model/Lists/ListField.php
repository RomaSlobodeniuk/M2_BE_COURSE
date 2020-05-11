<?php

namespace Roma\Game\Model\Lists;

use Magento\Framework\Data\OptionSourceInterface;
use Roma\Game\Api\Data\GameCustomerInterface as Game;

/**
 * Class ListField
 *
 * Generating a list with a field from the customers table for sorting
 */
class ListField implements OptionSourceInterface{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $resultArray[] = [
            'label' => GAME::NAME,
            'value' => GAME::NAME
        ];
        $resultArray[] = [
            'label' => GAME::SURNAME,
            'value' => GAME::SURNAME
        ];
        $resultArray[] = [
            'label' => GAME::ENTITY_ID,
            'value' => GAME::ENTITY_ID
        ];
        $resultArray[] = [
            'label' => GAME::EMAIL,
            'value' => GAME::EMAIL
        ];
        $resultArray[] = [
            'label' => GAME::CREATED_AT,
            'value' => GAME::CREATED_AT
        ];
        return $resultArray;
    }
}