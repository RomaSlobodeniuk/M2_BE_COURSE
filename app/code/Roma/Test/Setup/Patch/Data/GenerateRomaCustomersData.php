<?php

namespace Roma\Test\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Roma\Test\Api\CarCustomerRepositoryInterface;
use Roma\Test\Api\Data\CarCustomerInterface;
use Roma\Test\Api\Data\CarCustomerInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class GenerateRomaCustomersData
 */
class GenerateRomaCustomersData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CarCustomerInterfaceFactory
     */
    private $carCustomerFactory;

    /**
     * @var CarCustomerRepositoryInterface
     */
    private $carCustomerRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CarCustomerInterfaceFactory $carCustomerFactory
     * @param CarCustomerRepositoryInterface $carCustomerRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CarCustomerInterfaceFactory $carCustomerFactory,
        CarCustomerRepositoryInterface $carCustomerRepository,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->carCustomerFactory = $carCustomerFactory;
        $this->carCustomerRepository = $carCustomerRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Test:GenerateRomaCustomersData:Data:startSetup' . "\r\n";

        try {
            $data = [
                [
                    'entity_id' => null,
                    'email' => 'example@gmail.com',
                    'some_id' => 278,
                    'name' => 'Example',
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'email' => 'my_new_email@i.ua',
                    'some_id' => 111,
                    'name' => 'New Customer',
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'email' => 'roma@gmail.com',
                    'some_id' => 222,
                    'name' => 'Roma',
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'email' => 'sania11@gmail.com',
                    'some_id' => 321,
                    'name' => 'Sanya',
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'email' => 'myemail@i.ua',
                    'some_id' => 872,
                    'name' => 'Petro',
                    'created_at' => ''
                ]
            ];
            foreach ($data as $row) {
                /** @var CarCustomerInterface $newCustomerCar */
                $newCustomerCar = $this->carCustomerFactory->create();
                $newCustomerCar->setName($row['name']);
                $newCustomerCar->setEmail($row['email']);
                $newCustomerCar->setSomeId($row['some_id']);
                $newCustomerCar->setCreatedAt('now');
                $this->carCustomerRepository->save($newCustomerCar);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new customer car model, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:GenerateRomaCustomersData:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [

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
