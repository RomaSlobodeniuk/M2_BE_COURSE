<?php

namespace Owner\TaskModul\Model\ResourceModel;

use Owner\TaskModul\Model\EngineModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class EngineResource extends AbstractDb
{
    /**
     * {@inheritDoc}
     */
    const MODEL_ENGINE = 'model_engine';

    /**
     * {@inheritDoc}
     */
    public function _construct()
    {
        $this->_init(
            self::MODEL_ENGINE,
            EngineModel::ENTITY_ID
        );
    }
}