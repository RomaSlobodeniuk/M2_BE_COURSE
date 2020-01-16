<?php

namespace Roma\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataIntoMyNewTable
 */
class PutDataIntoMyNewTable implements DataPatchInterface
{
    const MY_NEW_WAY_TABLE = 'my_new_way_table';

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

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
        $data = [
            [
                'entity_id' => null,
                'user_id' => 1,
                'car_id' => 7272811,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 1,
                'car_id' => 7272812,
                'description' => 'Test Description 2',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 2,
                'car_id' => 2272811,
                'description' => 'Test Description 3',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 3,
                'car_id' => 3272812,
                'description' => 'Test Description 4',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 3,
                'car_id' => 3232812,
                'description' => 'Test Description 5',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 3,
                'car_id' => 3272814,
                'description' => 'Test Description 6',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 4,
                'car_id' => 4272813,
                'description' => 'Test Description 7',
                'created_at' => '',
                'price' => null
            ],
            [
                'entity_id' => null,
                'user_id' => 5,
                'car_id' => 5272812,
                'description' => 'Test Description 8',
                'created_at' => '',
                'price' => null
            ],
        ];

        $this->moduleDataSetup->startSetup();
        echo 'Roma_Test:PutDataIntoMyNewTable:Data:startSetup' . "\r\n";

        try {
            $connection = $this->moduleDataSetup->getConnection();
            foreach ($data as $row) {
                $row['created_at'] = time();
                $connection->insert(self::MY_NEW_WAY_TABLE, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:PutDataIntoMyNewTable:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
