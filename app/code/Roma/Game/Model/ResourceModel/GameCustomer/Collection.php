<?php

namespace Roma\Game\Model\ResourceModel\GameCustomer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\Game\Model\GameCustomerModel;
use Roma\Game\Model\ResourceModel\GameCustomer as GameCustomerResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = GameCustomerModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            GameCustomerModel::class,
            GameCustomerResourceModel::class
        );
    }
}