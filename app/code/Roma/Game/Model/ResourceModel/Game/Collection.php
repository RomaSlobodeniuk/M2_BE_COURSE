<?php

namespace Roma\Game\Model\ResourceModel\Game;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\Game\Model\GameModel;
use Roma\Game\Model\ResourceModel\Game as GameResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = GameModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            GameModel::class,
            GameResourceModel::class
        );
    }
}