<?php

namespace Owner\TaskModul\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Owner\TaskModul\Api\Data\CarInterface;
use Owner\TaskModul\Api\Data\CarInterfaceFactory;
use Owner\TaskModul\Api\RepositoryInterface\CarRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DataCarTable
 * @package Owner\TaskModul\Setup\Patch\Data
 */
class Data2CarTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var CarInterfaceFactory
     */
    private $carFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CarRepositoryInterface $carRepository
     * @param CarInterfaceFactory $carFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CarRepositoryInterface $carRepository,
        CarInterfaceFactory $carFactory,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->carRepository = $carRepository;
        $this->carFactory = $carFactory;
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
                'brand' => 'Mercedes-Benz',
                'model' => 'E200',
                'engine_id' => 4,
                'price' => 8000,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'brand' => 'Mercedes-Benz',
                'model' => 'E240',
                'engine_id' => 2,
                'price' => 10000,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'brand' => 'Mercedes-Benz',
                'model' => 'E200',
                'engine_id' => 1,
                'price' => 7000,
                'years' => '2003–2006',
            ],
            [
                'entity_id' => null,
                'brand' => 'BMW',
                'model' => 'M750',
                'engine_id' => 7,
                'price' => 15000,
                'years' => '1994-2001',
            ],
            [
                'entity_id' => null,
                'brand' => 'BMW',
                'model' => 'M740',
                'engine_id' => 6,
                'price' => 13000,
                'years' => '1994-2001',
            ]
        ];

        try {
            foreach ($data as $row) {
                /** @var CarInterface $car */
                $car = $this->carFactory->create();
                $car->setBrand($row['brand'])
                    ->setModel($row['model'])
                    ->setEngineId($row['engine_id'])
                    ->setPrice($row['price'])
                    ->setYears($row['years']);
                $this->carRepository->save($car);
            }
        } catch (\Exception $exception){
            $this->logger->debug('Problem with saving data: ' . $exception->getMessage() );
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
