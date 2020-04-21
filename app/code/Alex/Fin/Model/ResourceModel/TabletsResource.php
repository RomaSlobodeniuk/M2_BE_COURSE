<?php

namespace Alex\Fin\Model\ResourceModel;

use Alex\Fin\Model\TabletsModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class TabletsResource
 */
class TabletsResource extends AbstractDb
{
    const TABLETS_TABLE = 'tablets';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::TABLETS_TABLE,
            TabletsModel::ENTITY_ID
        );
    }
}