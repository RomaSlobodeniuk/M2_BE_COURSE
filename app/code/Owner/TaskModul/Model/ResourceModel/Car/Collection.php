<?php

namespace Owner\TaskModul\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Owner\TaskModul\Model\CarModel;
use Owner\TaskModul\Model\ResourceModel\CarResource;

/**
 * Class Collection
 * @package Owner\TaskModul\Model\ResourceModel\Car
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritDoc}
     */
    protected $_idFieldName = CarModel::ENTITY_ID;

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            CarModel::class,
            CarResource::class
        );
    }
}