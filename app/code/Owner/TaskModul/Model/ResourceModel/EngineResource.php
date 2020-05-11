<?php

namespace Owner\TaskModul\Model\ResourceModel;

use Owner\TaskModul\Model\EngineModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class EngineResource extends AbstractDb
{
    const MODEL_ENGINE = 'model_engine';

    public function _construct()
    {
        $this->_init(
            self::MODEL_ENGINE,
            EngineModel::ENTITY_ID
        );
    }
}