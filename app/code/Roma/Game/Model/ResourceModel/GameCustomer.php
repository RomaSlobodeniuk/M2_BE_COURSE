<?php

namespace Roma\Game\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\Game\Model\GameCustomerModel;

/**
 * Class GameCustomer
 */
class GameCustomer extends AbstractDb
{
    const GAME_CUSTOMER_TABLE = 'game_customer_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::GAME_CUSTOMER_TABLE,
            GameCustomerModel::ENTITY_ID
        );
    }
}