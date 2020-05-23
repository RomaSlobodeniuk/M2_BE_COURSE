<?php

namespace Owner\TaskModul\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Owner\TaskModul\Api\Data\EngineInterface;
use Owner\TaskModul\Api\Data\EngineInterfaceFactory;
use Owner\TaskModul\Api\RepositoryInterface\EngineRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DataEngineTable
 * @package Owner\TaskModul\Setup\Patch\Data
 */
class Data1EngineTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EngineRepositoryInterface
     */
    private $engineRepository;

    /**
     * @var EngineInterfaceFactory
     */
    private $engineFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EngineRepositoryInterface $engineRepository
     * @param EngineInterfaceFactory $engineFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EngineRepositoryInterface $engineRepository,
        EngineInterfaceFactory $engineFactory,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->engineRepository = $engineRepository;
        $this->engineFactory = $engineFactory;
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
            foreach ($data as $row) {
                /** @var EngineInterface $engine */
                $engine = $this->engineFactory->create();
                $engine->setManufacturer($row['manufacturer'])
                    ->setWin($row['win'])
                    ->setPower($row['power'])
                    ->setVolume($row['volume'])
                    ->setYears($row['years']);
                $this->engineRepository->save($engine);
            }
        } catch (\Exception $exception){
            $this->logger->debug('Problem with save data: ' . $exception->getMessage() );
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
