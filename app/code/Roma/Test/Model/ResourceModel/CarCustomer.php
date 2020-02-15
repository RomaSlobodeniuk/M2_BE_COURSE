<?php

namespace Roma\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\Test\Model\CarCustomerModel;

/**
 * Class CarCustomer
 */
class CarCustomer extends AbstractDb
{
    const CAR_CUSTOMER_TABLE = 'roma_customers';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::CAR_CUSTOMER_TABLE,
            CarCustomerModel::ENTITY_ID
        );
    }

    public function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        //my custom logic
        return parent::_beforeDelete($object);
    }
}
