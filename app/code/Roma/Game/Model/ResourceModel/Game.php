<?php

namespace Roma\Game\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\Game\Model\GameModel;

/**
 * Class Game
 */
class Game extends AbstractDb
{
    const GAME_TABLE = 'game_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::GAME_TABLE,
            GameModel::ENTITY_ID
        );
    }
}