<?php

namespace Roma\Game\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class GameLicense
 *
 * This class is for saving game id, passed by the controller
 */
class GameLicense extends Template
{
    /**
     * @var int
     */
    private $gameId;

    /**
     * @param $id
     */
    public function setGameId($id)
    {
        $this->gameId = $id;
    }

    /**
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }
}