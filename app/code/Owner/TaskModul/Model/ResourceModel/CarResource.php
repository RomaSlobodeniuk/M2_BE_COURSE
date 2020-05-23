<?php

namespace Owner\TaskModul\Model\ResourceModel;

use Owner\TaskModul\Model\CarModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CarResource
 * @package Owner\TaskModul\Model\ResourceModel
 */
class CarResource extends AbstractDb
{
    /**
     * {@inheritDoc}
     */
    const MODEL_CAR = 'model_car';

    /**
     * {@inheritDoc}
     */
    public function _construct()
    {
        $this->_init(
            self::MODEL_CAR,
            CarModel::ENTITY_ID
        );
    }
}