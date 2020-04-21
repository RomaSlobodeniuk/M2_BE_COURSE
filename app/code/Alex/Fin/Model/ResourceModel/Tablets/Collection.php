<?php

namespace Alex\Fin\Model\ResourceModel\Tablets;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Alex\Fin\Model\TabletsModel;
use Alex\Fin\Model\ResourceModel\TabletsResource as TabletsResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = TabletsModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            TabletsModel::class,
            TabletsResourceModel::class
        );
    }
}
