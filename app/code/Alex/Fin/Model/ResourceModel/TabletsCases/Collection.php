<?php

namespace Alex\Fin\Model\ResourceModel\TabletsCases;

use Alex\Fin\Model\TabletsCasesModel;
use Alex\Fin\Model\ResourceModel\TabletsCasesResource as TabletsCasesResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = TabletsCasesModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            TabletsCasesModel::class,
            TabletsCasesResourceModel::class
        );
    }
}
