<?php

namespace Slayer\Mobile\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Slayer\Mobile\Api\ManufacturerRepositoryInterface;
use Slayer\Mobile\Api\Data\ManufacturerInterface;
use Slayer\Mobile\Api\Data\ManufacturerInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataIntoMobileManufacturerTable
 * Slayer\Mobile\Setup\Patch\Data
 */
class PutDataIntoMobileManufacturerTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var ManufacturerInterfaceFactory
     */
    private $manufacturerFactory;

    /**
     * @var ManufacturerRepositoryInterface
     */
    private $manufacturerRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ManufacturerInterfaceFactory $manufacturerFactory
     * @param ManufacturerRepositoryInterface $manufacturerRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ManufacturerInterfaceFactory $manufacturerFactory,
        ManufacturerRepositoryInterface $manufacturerRepository,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->manufacturerFactory = $manufacturerFactory;
        $this->manufacturerRepository = $manufacturerRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $data = [
                [
                    'entity_id' => null,
                    'name' => 'Apple',
                    'director' => 'Timothy Donald Cook',
                    'phone' => '1-800-275-2273',
                    'email' => 'apple@gmail.com',
                    'address' => 'Cupertino, CA 95014',
                    'foundation_date' => '1976-04-01',
                ],
                [
                    'entity_id' => null,
                    'name' => 'Samsung',
                    'director' => 'Ki-Nam Kim',
                    'phone' => '800 726-7864',
                    'email' => 'apple@gmail.com',
                    'address' => 'Samsung 105 Challenger Rd. Ridgefield Park, NJ 07660-0511',
                    'foundation_date' => '1938-03-01',
                ],
                [
                    'entity_id' => null,
                    'name' => 'Sony',
                    'director' => 'Kenichiro Yoshida',
                    'phone' => '',
                    'email' => '',
                    'address' => 'New York, NY, Sony Corporation of America is the U.S. headquarters of Sony Corporation, based in Tokyo, Japan',
                    'foundation_date' => '1946-05-07',
                ],
                [
                    'entity_id' => null,
                    'name' => 'Xiaomi',
                    'director' => 'John Chen',
                    'phone' => '1800 103 6286',
                    'email' => 'service.in@xiaomi.com',
                    'address' => 'Xiaomi Technology India Private Limited, 8th Floor, Tower-1, 
                    Umiya Business Bay Marathahalli-Sarjapur, Outer Ring Road, Bangalore, Karnataka, 
                    India, Pin Code – 560103',
                    'foundation_date' => '2010-04-06',
                ],
                [
                    'entity_id' => null,
                    'name' => 'Huawei',
                    'director' => 'Liang Hua',
                    'phone' => '',
                    'email' => '',
                    'address' => '4815NG Stadionstraat 2, 6th fl.',
                    'foundation_date' => '1987-00-00',
                ],
                [
                    'entity_id' => null,
                    'name' => 'Asus',
                    'director' => 'Jonney Shih',
                    'phone' => '800-820-6655',
                    'email' => '',
                    'address' => '',
                    'foundation_date' => '1989-03-02',
                ],
            ];
            foreach ($data as $row) {
                /** @var ManufacturerInterface $newManufacturer */
                $newManufacturer = $this->manufacturerFactory->create();
                $newManufacturer->setName($row['name']);
                $newManufacturer->setDirector($row['director']);
                $newManufacturer->setPhoneNumber($row['phone']);
                $newManufacturer->setEmail('email');
                $newManufacturer->setAddress($row['address']);
                $newManufacturer->setFoundationDate($row['foundation_date']);
                $this->manufacturerRepository->save($newManufacturer);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new manufacturer model, message: "'. $exception->getMessage() . '"');
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