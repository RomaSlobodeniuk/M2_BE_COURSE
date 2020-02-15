<?php

namespace Roma\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Roma\Test\Api\CarRepositoryInterface;
use Roma\Test\Api\Data\CarInterface;
use Roma\Test\Api\Data\CarInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class GenerateRomaCarsData
 */
class GenerateRomaCarsData implements DataPatchInterface
{
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
     * @param CarInterfaceFactory $carFactory
     * @param CarRepositoryInterface $carRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CarInterfaceFactory $carFactory,
        CarRepositoryInterface $carRepository,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->carFactory = $carFactory;
        $this->carRepository = $carRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Test:GenerateRomaCarsData:Data:startSetup' . "\r\n";

        try {
            $connection = $this->moduleDataSetup->getConnection();
            $sql = "SELECT * FROM `my_new_way_table`";
            $data = $connection->fetchAssoc($sql);
            foreach ($data as $row) {
                /** @var CarInterface $newCar */
                $newCar = $this->carFactory->create();
                $newCar->setCarId($row['car_id']);
                $newCar->setUserId($row['user_id']);
                $newCar->setDescription($row['description']);
                $newCar->setCreatedAt($row['created_at']);
                $newCar->setPrice($row['price']);
                $this->carRepository->save($newCar);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new car model, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:GenerateRomaCarsData:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            GenerateRomaCustomersData::class
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
