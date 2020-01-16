<?php

namespace Roma\Test\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Class UpgradeSchema
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        echo 'Roma_Test:UpgradeSchema:upgradeStart' . "\r\n";

        // beware, this is the version we are upgrading from, not to!
        $moduleVersion = $context->getVersion();
        if (version_compare($moduleVersion, '0.0.3', '<')) {
            echo 'Roma_Test:UpgradeSchema:upgradeStart:0.0.3' . "\r\n";
            $this->updateMyTable($setup);
            echo 'Roma_Test:UpgradeSchema:upgradeEnd:0.0.3' . "\r\n";
        }

        echo 'Roma_Test:UpgradeSchema:upgradeEnd' . "\r\n";
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function updateMyTable($setup)
    {
        $setup->startSetup();

        $myTable = $setup->getTable('my_old_fashioned_table');
        $setup->getConnection()->modifyColumn(
                $myTable,
                'some_id',
                [
                    'type' => Table::TYPE_INTEGER,
                    'size' => 11
                ]
            )
            ->addColumn(
            $myTable,
            'name',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 128,
                'nullable' => true,
                'comment' => 'Customer Name'
            ]
        );
        $setup->endSetup();
    }
}
