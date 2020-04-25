<?php

namespace Slayer\Mobile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Slayer\Mobile\Model\PhoneModel;

/**
 * Class Phone
 */
class Phone extends AbstractDb
{
    const MOBILE_PHONES_TABLE = 'mobile_phone_table';

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::MOBILE_PHONES_TABLE,
            PhoneModel::ENTITY_ID
        );
    }
}
