<?php

namespace Roma\Game\ViewModel;

use Magento\Framework\Event\Manager as EventManager;
use Roma\Game\Model\ResourceModel\Game\Collection as GameCollection;

/**
 * Class CreateEvents - форматування ріже мені очі. Де Doc Блоки?
 *
 * Це ViewModel, а я не бачу, що ти імплементуєш ArgumentInterface!!!
 */
class CreateEvents
{
    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @param EventManager $eventManager
     */
    public function __construct(
        EventManager $eventManager
    ) {
        $this->eventManager = $eventManager;
    }

    public function see_customer_games_event()
    {
        /**
         * Де дані, які ти передаєш в обсервер? Навіщо цей івент без даних, які ти
         * передаєш для інших розробників? Це без сенсу
         */
        $this->eventManager->dispatch('see_customer_games');
    }

    public function check_game_license()
    {
        /**
         * Теж саме
         */
        $this->eventManager->dispatch('check_game_license');
    }

    /**
     * @param GameCollection|null $collection
     */
    public function get_game_collection(GameCollection $collection = null)
    {
        $eventData = [
            'game_collection' => $collection
        ];

        /**
         * А ось тут бачу, є дані
         */
        $this->eventManager->dispatch('get_game_collection', $eventData);
    }

    /**
     * Doc блок ? Методи повинні іменуватися ось так - getGameCustomerCollection
     */
    public function get_game_customer_collection($array)
    {
        $eventData = [
            'customer_collection' => $array
        ];

        $this->eventManager->dispatch('get_game_customer_collection', $eventData);
    }
}