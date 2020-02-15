<?php

namespace Roma\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class RemoveOldTables
 */
class RemoveOldTables implements DataPatchInterface
{
    const OLD_TABLES = [
        'my_old_fashioned_table',
        'my_new_way_table'
    ];

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CarInterfaceFactory
     */
    private $carFactory;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Test:RemoveOldTables:Data:startRemoving' . "\r\n";

        try {
            $connection = $this->moduleDataSetup->getConnection();
            foreach (self::OLD_TABLES as $oldTableName) {
                echo 'Roma_Test:RemoveOldTables:tableToBeRemoved: "' . $oldTableName . '"' . "\r\n";
                if ($connection->isTableExists($oldTableName)) {
                    echo 'Roma_Test:RemoveOldTables:table: "' . $oldTableName . '" is found, start removing...' . "\r\n";
                    $connection->dropTable($oldTableName);
                    echo 'Roma_Test:RemoveOldTables:table: "' . $oldTableName . '" is removed successfully!' . "\r\n";
                } else {
                    echo 'Roma_Test:RemoveOldTables:table: "' . $oldTableName . '" does not exist' . "\r\n";
                }
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot remove old table, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:RemoveOldTables:Data:endRemoving' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            GenerateRomaCustomersData::class,
            GenerateRomaCarsData::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
