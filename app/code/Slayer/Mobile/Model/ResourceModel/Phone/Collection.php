<?php

namespace Slayer\Mobile\Model\ResourceModel\Phone;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Slayer\Mobile\Model\PhoneModel;
use Slayer\Mobile\Model\ResourceModel\Phone as PhoneResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritDoc}
     */
    protected $_idFieldName = PhoneModel::ENTITY_ID;

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            PhoneModel::class,
            PhoneResourceModel::class
        );
    }
}
