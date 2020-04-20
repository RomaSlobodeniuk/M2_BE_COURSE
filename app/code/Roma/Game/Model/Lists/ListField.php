<?php
namespace Roma\Game\Model\Lists;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\OptionSourceInterface;
use Roma\Game\Api\Data\GameCustomerInterface as Game;

/**
 * Class ListField - форматування знову ріже мені сам знаєш що )
 *
 * Де Doc блоки?
 */
class ListField implements OptionSourceInterface{

    public function toOptionArray()
    {
        $resultArray[] = [
            'label' => GAME::NAME,
            'value' => GAME::NAME];
        $resultArray[] = [
            'label' => GAME::SURNAME,
            'value' => GAME::SURNAME];
        $resultArray[] = [
            'label' => GAME::ENTITY_ID,
            'value' => GAME::ENTITY_ID];
        $resultArray[] = [
            'label' => GAME::EMAIL,
            'value' => GAME::EMAIL];
        $resultArray[] = [
            'label' => GAME::CREATED_AT,
            'value' => GAME::CREATED_AT];
        return $resultArray;

    }
}