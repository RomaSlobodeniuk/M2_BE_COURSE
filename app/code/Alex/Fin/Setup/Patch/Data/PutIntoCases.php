<?php


namespace Alex\Fin\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;


/**
 * Class PutIntoCases
 *
 * Форматування коду!
 */
class PutIntoCases implements DataPatchInterface
{
    const CASES = 'tablets_cases';
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
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        $data = [
            [
                'entity_id' => null,
                'forTabSku' => 111,
                'caseSKU' => 7272811,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '11',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 111,
                'caseSKU' => 7272801,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '12',
                'color' => 'red-blue',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 112,
                'caseSKU' => 7272711,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '13',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 112,
                'caseSKU' => 7272710,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '14',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 113,
                'caseSKU' => 7272510,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '15',
                'color' => 'red',
                'brand' => 'baoboao'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 113,
                'caseSKU' => 72725,
                'description' => 'Test Description 2',
                'created_at' => '',
                'price' => '16',
                'color' => 'red-blue',
                'brand' => 'baoboao_new'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 114,
                'caseSKU' => 7252710,
                'description' => 'coolest',
                'created_at' => '',
                'price' => '16',
                'color' => 'red-white-blue',
                'brand' => 'chana'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 114,
                'caseSKU' => 72527,
                'description' => 'coolest and best',
                'created_at' => '',
                'price' => '17',
                'color' => 'red-white',
                'brand' => 'chana bao'
            ]
        ];
        $this->moduleDataSetup->startSetup();
        try {
            /**
             * Згідно 7 пункту я казав, щоб ви використали фарбики і репозиторії
             * в патчах для даного роду операції над БД
             */
            $connection = $this->moduleDataSetup->getConnection();
            foreach ($data as $row) {
                $row['created_at'] = date("Y-m-d H:i:s");   //!
                $connection->insert(self::CASES, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}