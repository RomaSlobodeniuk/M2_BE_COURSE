<?php


namespace Alex\Fin\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;


/**
 * Class PutIntoTablets
 *
 * Форматування коду!
 */
class PutIntoTablets implements DataPatchInterface
{
    const TABLETS= 'tablets';
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
                'TabSku' => 111,
                'brand' => 'LG',
                'model' => 'yht123',
                'descriptions' => 'Test Description 1',
                'created_at' => '',
                'price' => '12332',
            ],
            [
                'entity_id' => null,
                'TabSku' => 112,
                'brand' => 'SAMSUNG',
                'model' => 'yhsdsd',
                'descriptions' => 'Test Description 1',
                'created_at' => '',
                'price' => '9999',
            ],
            [
                'entity_id' => null,
                'TabSku' => 113,
                'brand' => 'APPLE',
                'model' => 'mini3',
                'descriptions' => 'this is the best!',
                'created_at' => '',
                'price' => '15999',
            ],
            [
                'entity_id' => null,
                'TabSku' => 114,
                'brand' => 'xiaomi',
                'model' => 'note4',
                'descriptions' => 'cheap and cool',
                'created_at' => '',
                'price' => '3687',
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
                $connection->insert(self::TABLETS, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();

        return $this;
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