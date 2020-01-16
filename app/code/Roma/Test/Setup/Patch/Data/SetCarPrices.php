<?php

namespace Roma\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SetCarPrices
 */
class SetCarPrices implements DataPatchInterface
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
                'price' => 35000.2900,
                'car_id' => 7272811
            ],
            [
                'price' => 28000.0000,
                'car_id' => 7272812,
            ],
            [
                'price' => 32822.0000,
                'car_id' => 2272811
            ],
            [
                'price' => 120282.0100,
                'car_id' => 3272812
            ],
            [
                'price' => 50082.9900,
                'car_id' => 3232812
            ],
            [
                'price' => 250000.0000,
                'car_id' => 3272814
            ],
            [
                'price' => 176000.1111,
                'car_id' => 4272813
            ],
            [
                'price' => 999999.9999,
                'car_id' => 5272812
            ]
        ];

        $this->moduleDataSetup->startSetup();
        echo 'Roma_Test:SetCarPrices:Data:startSetup' . "\r\n";

        try {
            $connection = $this->moduleDataSetup->getConnection();
            $myNewTable = $connection->getTableName(self::MY_NEW_WAY_TABLE);
            foreach ($data as $row) {
                try {
                    $connection->update(
                        $myNewTable,
                        [
                            'price' => $row['price']
                        ],
                        "car_id = {$row['car_id']}"
                    );
                } catch (\Exception $exception) {
                    $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
                }
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Something went wrong, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:SetCarPrices:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            PutDataIntoMyNewTable::class
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
