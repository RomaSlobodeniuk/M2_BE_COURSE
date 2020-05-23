<?php

namespace Owner\TaskModul\Model\ResourceModel\Engine;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Owner\TaskModul\Model\EngineModel;
use Owner\TaskModul\Model\ResourceModel\EngineResource;

/**
 * Class Collection
 * @package Owner\TaskModul\Model\ResourceModel\Engine
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritDoc}
     */
    protected $_idFieldName = EngineModel::ENTITY_ID;

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            EngineModel::class,
            EngineResource::class
        );
    }
}