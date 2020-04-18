<?php

namespace Slayer\Mobile\Model\ResourceModel\Manufacturer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Slayer\Mobile\Model\ManufacturerModel;
use Slayer\Mobile\Model\ResourceModel\Manufacturer as ManufacturerResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritDoc}
     */
    protected $_idFieldName = ManufacturerModel::ENTITY_ID;

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            ManufacturerModel::class,
            ManufacturerResourceModel::class
        );
    }
}
