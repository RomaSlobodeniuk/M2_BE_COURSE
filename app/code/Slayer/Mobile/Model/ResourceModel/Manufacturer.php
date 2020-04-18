<?php

namespace Slayer\Mobile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Slayer\Mobile\Model\ManufacturerModel;

/**
 * Class Manufacturer
 */
class Manufacturer extends AbstractDb
{
    const MOBILE_MANUFACTURERS_TABLE = 'mobile_manufacturer_table';

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::MOBILE_MANUFACTURERS_TABLE,
            ManufacturerModel::ENTITY_ID
        );
    }
}
