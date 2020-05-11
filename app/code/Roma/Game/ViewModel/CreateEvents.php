<?php

namespace Roma\Game\ViewModel;

use Magento\Framework\Event\Manager;

/**
 * Creating events and put data into them
 *
 * Class CreateEvents
 */
class CreateEvents
{
    /**
     * @var Manager
     */
    private $eventManager;

    /**
     * @param Manager $eventManager
     */
    public function __construct(
        Manager $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    /**
     * @param $id
     */
    public function getGameCustomerId($id)
    {
        $eventData = [
            'game_customer_id' => $id
        ];

        $this->eventManager->dispatch('get_game_customer_id', $eventData);
    }

    /**
     * @param $id
     */
    public function getGameID($id)
    {
        $eventData = [
            'game_id' => $id
        ];

        $this->eventManager->dispatch('get_game_id', $eventData);
    }

    /**
     * @param $array
     */
    public function getGetGameCollection($array)
    {
        $eventData = [
            'customer_collection' => $array
        ];

        $this->eventManager->dispatch('get_game_collection', $eventData);
    }

    /**
     * @param $array
     */
    public function getGameCustomerCollection($array)
    {
        $eventData = [
            'customer_collection' => $array
        ];

        $this->eventManager->dispatch('get_game_customer_collection', $eventData);
    }
}