<?php

namespace Alex\Fin\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Alex\Fin\Model\TabletsCasesModel;

/**
 * Class TabletsCasesResource
 */
class TabletsCasesResource extends AbstractDb
{
    const TABLETS_CASES_TABLE = 'tablets_cases';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::TABLETS_CASES_TABLE,
            TabletsCasesModel::ENTITY_ID
        );
    }
}