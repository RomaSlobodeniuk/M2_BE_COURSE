<?php

namespace Owner\TaskModul\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DataEngineTable
 * @package Owner\TaskModul\Setup\Patch\Data
 */
class Data1EngineTable implements DataPatchInterface
{
    const MODEL_ENGINE = 'model_engine';

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
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $data = [
            [
                'entity_id' => null,
                'manufacturer' => 'Mercedes-Benz',
                'win' => 'E200 Kompressor',
                'power' => 163,
                'volume' => 1.8,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'Mercedes-Benz',
                'win' => 'E240 Kompressor',
                'power' => 184,
                'volume' => 1.8,
                'years' => '2006–2009',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'Mercedes-Benz',
                'win' => 'E240 4MATIC',
                'power' => 177,
                'volume' => 2.5,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'Mercedes-Benz',
                'win' => 'E500 4MATIC',
                'power' => 306,
                'volume' => 4.9,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'BMW',
                'win' => 'R6 2.8-193',
                'power' => 193,
                'volume' => 2.7,
                'years' => '1994-2001',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'BMW',
                'win' => 'V8 4.0-286',
                'power' => 286,
                'volume' => 4.0,
                'years' => '1994-2001',
            ],
            [
                'entity_id' => null,
                'manufacturer' => 'BMW',
                'win' => 'V12 5.4-326',
                'power' => 326  ,
                'volume' => 5.3,
                'years' => '1994-2001',
            ]
        ];

        try {
            $connection = $this->moduleDataSetup->getConnection();
            foreach ($data as $row) {
                $connection->insert(self::MODEL_ENGINE, $row);
            }
        }
        catch (\Exception $exception){
            $this->logger->debug('Problem with insert date.' . $exception->getMessage() );
        }

        $this->moduleDataSetup->endSetup();
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
