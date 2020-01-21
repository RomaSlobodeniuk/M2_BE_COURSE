<?php

namespace Roma\Test\Model\ResourceModel\CarResource;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\Test\Model\CarModel;
use Roma\Test\Model\ResourceModel\CarResource as CarResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = CarModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            CarModel::class,
            CarResourceModel::class
        );
    }
}
