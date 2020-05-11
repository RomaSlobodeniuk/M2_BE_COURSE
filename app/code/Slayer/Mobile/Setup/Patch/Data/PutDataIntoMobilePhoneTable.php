<?php

namespace Slayer\Mobile\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Slayer\Mobile\Api\PhoneRepositoryInterface;
use Slayer\Mobile\Api\Data\PhoneInterface;
use Slayer\Mobile\Api\Data\PhoneInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataIntoMobilePhoneTable
 * Slayer\Mobile\Setup\Patch\Data
 */
class PutDataIntoMobilePhoneTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var PhoneInterfaceFactory
     */
    private $phoneFactory;

    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PhoneInterfaceFactory $phoneFactory
     * @param PhoneRepositoryInterface $phoneRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PhoneInterfaceFactory $phoneFactory,
        PhoneRepositoryInterface $phoneRepository,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->phoneFactory = $phoneFactory;
        $this->phoneRepository = $phoneRepository;
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
                    'manufacturer_id' => 1,
                    'model' => 'Apple iPhone 11 Pro',
                    'os' => 'ios',
                    'resolution' => '828 x 1792 pixels, 19.5:9 ratio (~326 ppi density);',
                    'ram' => '64GB 4GB RAM, 256GB 4GB RAM, 512GB 4GB RAM;',
                    'cpu' => 'Hexa-core (2x2.65 GHz Lightning + 4x1.8 GHz Thunder);',
                    'battery' => 'Non-removable Li-Ion 3110 mAh battery (11.91 Wh);',
                    'description' => '2019 Sep 21, Smartphone, 71.4x144x8.1 mm, iOS, Apple A13 Bionic APL1085 / APL1W85 (T8030), 4.00 GiB RAM, 512.0 GB ROM, 1-notch, 5.8 inch, 1125x2436, AM-OLED display, Dual standby operation, NFC (A), NFC (B), FeliCa, GPS, 12.2 MP camera, 12.2 MP aux. camera, 12.2 MP aux. 2 camera, 12.2 MP 2nd camera, Light sensor, Proximity sensor, Barometer, 3046 mAh battery',
                    'released' => '2019-09-00',
                    'photo' => 'iphone11pro.jpg',
                    'price' => 1678.5311,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 1,
                    'model' => 'Apple iPhone 11 Pro Max',
                    'os' => 'ios',
                    'resolution' => '1125 x 2436 pixels, 19.5:9 ratio (~458 ppi density);',
                    'ram' => '64GB 4GB RAM, 256GB 4GB RAM, 512GB 4GB RAM;',
                    'cpu' => 'Hexa-core (2x2.65 GHz Lightning + 4x1.8 GHz Thunder);',
                    'battery' => 'Non-removable Li-Ion 3046 mAh battery (11.67 Wh);',
                    'description' => '2019 Sep 21, Smartphone, 77.8x158x8.1 mm, iOS, Apple A13 Bionic APL1085 / APL1W85 (T8030), 4.00 GiB RAM, 512.0 GB ROM, 1-notch, 6.5 inch, 1242x2688, AM-OLED display, Dual standby operation, NFC (A), NFC (B), GPS, 12.2 MP camera, 12.2 MP aux. camera, 12.2 MP aux. 2 camera, 12.2 MP 2nd camera, Light sensor, Proximity sensor, Barometer, 3969 mAh battery',
                    'released' => '2019-09-00',
                    'photo' => 'iphone11pro_max.jpg',
                    'price' => 1428.53,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 1,
                    'model' => 'Apple iPhone 8 Plus',
                    'os' => 'ios',
                    'resolution' => '1080 x 1920 pixels, 16:9 ratio (~401 ppi density);',
                    'ram' => '64GB 3GB RAM, 256GB 3GB RAM;',
                    'cpu' => 'Hexa-core (2x Monsoon + 4x Mistral);',
                    'battery' => 'Non-removable Li-Ion 2691 mAh battery (10.28 Wh);',
                    'description' => '2017 Oct, Smartphone, 78.1x158.4x7.5 mm, iOS, Apple A11 Bionic APL1072 / APL1W72 (T8015), 3.00 GiB RAM, 256.0 GB ROM, 5.5 inch, 1080x1920, Color IPS TFT LCD display, NFC (A), NFC (B), GPS, 12.2 MP camera, 12.2 MP aux. camera, 7.2 MP 2nd camera, Light sensor, Proximity sensor, Barometer, Fingerprint sensor, 2675 mAh battery',
                    'released' => '2017-09-00',
                    'photo' => 'iphone8plus.jpg',
                    'price' => 696.39,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 2,
                    'model' => 'SM-N770F/DSM Galaxy Note 10 Lite Standard Edition Dual SIM TD-LTE APAC',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '6.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Samsung Exynos 9 Octa 9810, 2018, 64 bit, octa-core, 2560 Kbyte L2, 4096 Kbyte L3, 10 nm, ARM Mali-G72 GPU',
                    'battery' => 'Li-ion  4500 mAh battery',
                    'description' => 'NEW 2020 Feb 3, Smartphone, 76.1x163.7x8.7 mm, Android, Samsung Exynos 9 Octa 9810, 6.00 GiB RAM, 128.0 GB ROM, 1-hole, 6.7 inch, 1080x2400, AM-OLED display, Dual standby operation, NFC (A), NFC (B), GPS, 12.2 MP camera, 12.2 MP aux. camera, 12.2 MP aux. 2 camera, 32.0 MP 2nd camera, Light sensor, Proximity sensor, Hall, In-screen fingerprint sensor, 4500 mAh battery',
                    'released' => '2020-02-03',
                    'photo' => 'samsung_galaxy_note10ls.jpg',
                    'price' => 678.53,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 2,
                    'model' => 'SM-N770F/DSM Galaxy Note 10 Lite Premium Edition Dual SIM TD-LTE APAC',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '8.00 GiB RAM  LPDDR4x SDRAM',
                    'cpu' => 'Samsung Exynos 9 Octa 9810, 2018, 64 bit, octa-core, 2560 Kbyte L2, 4096 Kbyte L3, 10 nm, ARM Mali-G72 GPU',
                    'battery' => 'Li-ion  4500 mAh battery',
                    'description' => 'NEW 2020 Feb 3, Smartphone, 76.1x163.7x8.7 mm, Android, Samsung Exynos 9 Octa 9810, 8.00 GiB RAM, 128.0 GB ROM, 1-hole, 6.7 inch, 1080x2400, AM-OLED display, Dual standby operation, NFC (A), NFC (B), GPS, 12.2 MP camera, 12.2 MP aux. camera, 12.2 MP aux. 2 camera, 32.0 MP 2nd camera, Light sensor, Proximity sensor, Hall, In-screen fingerprint sensor, 4500 mAh battery',
                    'released' => '2020-02-03',
                    'photo' => 'samsung_galaxy_note10lp.jpg',
                    'price' => 964.25,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 2,
                    'model' => 'SM-N960F/DS Galaxy Note9 Global Dual SIM TD-LTE 512GB',
                    'os' => 'android',
                    'resolution' => '1440x2960',
                    'ram' => '8.00 GiB RAM  LPDDR4x SDRAM',
                    'cpu' => 'Samsung Exynos 9 Octa 9810, 2018, 64 bit, octa-core, 2560 Kbyte L2, 4096 Kbyte L3, 10 nm, ARM Mali-G72 GPU',
                    'battery' => 'Li-ion 4000 mAh battery',
                    'description' => '2018 Aug 22, Smartphone, 76.4x161.9x8.8 mm, Android, Samsung Exynos 9 Octa 9810, 8.00 GiB RAM, 512.0 GB ROM, 6.4 inch, 1440x2960, AM-OLED display, Dual standby operation, NFC (A), NFC (B), GPS, 12.2 MP camera, 12.2 MP aux. camera, 8.0 MP 2nd camera, Light sensor, Proximity sensor, Barometer, Hall, Gesture sensor, Fingerprint sensor, Heart rate sensor, Iris scanner, 4000 mAh battery',
                    'released' => '2018-08-22',
                    'photo' => 'samsung_galaxy_note9.jpg',
                    'price' => 681.96,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 3,
                    'model' => 'Xperia 10 II TD-LTE JP SO-41A',
                    'os' => 'android',
                    'resolution' => '1080x2520',
                    'ram' => '4.00 GiB RAM LPDDR4 SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 665 SM6125 (Trinket), 2019, 64 bit, octa-core, 11 nm, Qualcomm Adreno 610 GPU',
                    'battery' => 'Li-ion 3600 mAh battery',
                    'description' => 'UPCOMING 2020 May, Smartphone, 69x157x8.2 mm, Android, Qualcomm Snapdragon 665 SM6125 (Trinket), 4.00 GiB RAM, 64.0 GB ROM, 6 inch, 1080x2520, AM-OLED display, NFC (A), NFC (B), GPS, 12.2 MP camera, 8.0 MP aux. camera, 8.0 MP aux. 2 camera, 8.0 MP 2nd camera, Light sensor, Proximity sensor, Fingerprint sensor, Step counter, 3600 mAh battery',
                    'released' => '2020-05-00',
                    'photo' => 'sony_xperia10ll.jpg',
                    'price' => 414.28,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 3,
                    'model' => 'Xperia 1 II 5G TD-LTE JP SO-51A',
                    'os' => 'android',
                    'resolution' => '1644x3840',
                    'ram' => '8.00 GiB RAM  LPDDR5 SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 865 SM8250 (Kona), 2020, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 2304 Kbyte L2, 4096 Kbyte L3, 7 nm, Qualcomm Adreno 650 GPU',
                    'battery' => 'Li-ion 4000 mAh battery',
                    'description' => 'UPCOMING 2020 May, Smartphone, 72x166x7.9 mm, Android, Qualcomm Snapdragon 865 SM8250 (Kona), 8.00 GiB RAM, 256.0 GB ROM, 6.5 inch, 1644x3840, AM-OLED display, NFC (A), NFC (B), ISDB-T 1-Seg, ISDB-T Full-Seg receiver, GPS, 12.2 MP camera, 12.2 MP aux. camera, 12.2 MP aux. 2 camera, 8.0 MP 2nd camera, Light sensor, Proximity sensor, Fingerprint sensor, 4000 mAh battery',
                    'released' => '2020-05-00',
                    'photo' => 'sony_xperia1ll5g.jpg',
                    'price' => 872.85,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 3,
                    'model' => 'Xperia 10 II Global Dual SIM TD-LTE / Xperia 10 Mk. 2',
                    'os' => 'android',
                    'resolution' => '1080x2520',
                    'ram' => '4.00 GiB RAM LPDDR4 SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 665 SM6125 (Trinket), 2019, 64 bit, octa-core, 11 nm, Qualcomm Adreno 610 GPU',
                    'battery' => 'Li-ion 3600 mAh battery',
                    'description' => '',
                    'released' => '2020-04-00',
                    'photo' => 'sony_xperia10llgds.jpg',
                    'price' => 414.28,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 4,
                    'model' => 'Redmi K30 Pro 5G Zoom Standard Edition 5G Dual SIM TD-LTE CN 256GB',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '8.00 GiB RAM',
                    'cpu' => 'Qualcomm Snapdragon 865 SM8250 (Kona), 2020, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 2304 Kbyte L2, 4096 Kbyte L3, 7 nm, Qualcomm Adreno 650 GPUQualcomm Snapdragon 865 SM8250 (Kona), 2020, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 2304 Kbyte L2, 4096 Kbyte L3, 7 nm, Qualcomm Adreno 650 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 4700 mAh battery',
                    'description' => 'NEW 2020 Apr 4, Smartphone, 75.4x163.3x8.9 mm, Android, Qualcomm Snapdragon 865 SM8250 (Kona), 8.00 GiB RAM, 256.0 GB ROM, 6.7 inch, 1080x2400, AM-OLED display, Dual standby operation, NFC (A), NFC (B), IR: Yes, GPS, 63.7 MP camera, 13.0 MP aux. camera, 8.0 MP aux. 2 camera, 1.9 MP aux. 3 camera, 19.7 MP 2nd camera, Light sensor, Proximity sensor, Barometer, Hall, In-screen fingerprint sensor, 4700 mAh battery',
                    'released' => '2020-04-04',
                    'photo' => 'xiaomi_redmik30_pro.jpg',
                    'price' => 369.25,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 4,
                    'model' => 'Redmi Note 9 Pro Max Premium Edition Dual SIM TD-LTE IN 128GB M2003J6B1I',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '8.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 720G SM7125, 2020, 64 bit, octa-core, 8 nm, Qualcomm Adreno 618 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 5020 mAh battery',
                    'description' => '',
                    'released' => '2020-03-26',
                    'photo' => 'xiaomi_redmi_note9_pro_max.jpg',
                    'price' => 357.14,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 4,
                    'model' => 'Redmi Note 9 Pro Dual SIM TD-LTE IN 128GB M2003J6A1I',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '6144 MiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 720G SM7125, 2020, 64 bit, octa-core, 8 nm, Qualcomm Adreno 618 GPU',
                    'battery' => 'Lithium-ion 5020 mAh cell',
                    'description' => '',
                    'released' => '2020-03-17',
                    'photo' => 'xiaomi_redmi_note9_pro_dual.jpg',
                    'price' => 339.29,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 5,
                    'model' => 'Mate Xs Global Dual SIM 5G TD-LTE 512GB TAH-N29m',
                    'os' => 'android',
                    'resolution' => '2480x2200',
                    'ram' => '8192 MiB RAM LPDDR4x SDRAM',
                    'cpu' => 'HiSilicon Honor KIRIN990 5G, 2019, 64 bit, octa-core, 7 nm, ARM Mali-G76 GPU',
                    'battery' => 'Lithium-ion polymer (LiPo) 2250 mAh cell',
                    'description' => '',
                    'released' => '2020-04-00',
                    'photo' => 'huawei_mate_xs.jpg',
                    'price' => 357.14,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 5,
                    'model' => 'Honor View 30 Pro 5G Global Dual SIM TD-LTE 256GB OXF-N29',
                    'os' => 'android',
                    'resolution' => '1080x2400',
                    'ram' => '8.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'HiSilicon Honor KIRIN990 5G, 2019, 64 bit, octa-core, 7 nm, ARM Mali-G76 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 4100 mAh battery',
                    'description' => '',
                    'released' => '2020-03-00',
                    'photo' => 'huawei_honor_view_30pro.jpg',
                    'price' => 321.42,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 5,
                    'model' => 'P40 Lite E Dual SIM TD-LTE EMEA 64GB ART-L29 / Y7p 2020',
                    'os' => 'android',
                    'resolution' => '720x1560',
                    'ram' => '4.00 GiB RAM LPDDR4 SDRAM',
                    'cpu' => 'HiSilicon Honor KIRIN710, 2018, 64 bit, octa-core, 12 nm, ARM Mali-G51 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 4000 mAh battery',
                    'description' => '',
                    'released' => '2020-03-06',
                    'photo' => 'huawei_p40_lite.jpg',
                    'price' => 142.85,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 6,
                    'model' => 'ROG Phone II Ultimate Edition Global Dual SIM TD-LTE 1TB ZS660KL',
                    'os' => 'android',
                    'resolution' => '1080x2340',
                    'ram' => '12.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 855+ SM8150-AC (Hana), 2019, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 1536 Kbyte L2, 3072 Kbyte L3, 7 nm, Qualcomm Adreno 640 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 6000 mAh battery',
                    'description' => '',
                    'released' => '2019-12-11',
                    'photo' => 'asus_rog_phonell_ue.jpg',
                    'price' => 928.53,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 6,
                    'model' => 'ROG Phone II Global Dual SIM TD-LTE 512GB ZS660KL',
                    'os' => 'android',
                    'resolution' => '1080x2340',
                    'ram' => '12.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 855+ SM8150-AC (Hana), 2019, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 1536 Kbyte L2, 3072 Kbyte L3, 7 nm, Qualcomm Adreno 640 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 6000 mAh battery',
                    'description' => '',
                    'released' => '2019-09-21',
                    'photo' => 'asus_rog_phonell_gd.jpg',
                    'price' => 606.32,
                    'created_at' => ''
                ],
                [
                    'entity_id' => null,
                    'manufacturer_id' => 6,
                    'model' => 'ZenFone 6 2019 Global Dual SIM TD-LTE Version A ZS630KL 256GB / 6z',
                    'os' => 'android',
                    'resolution' => '1080x2340',
                    'ram' => '8.00 GiB RAM LPDDR4x SDRAM',
                    'cpu' => 'Qualcomm Snapdragon 855 SM8150 (Hana), 2019, 64 bit, octa-core, 32 Kbyte I-Cache, 32 Kbyte D-Cache, 1536 Kbyte L2, 3072 Kbyte L3, 7 nm, Qualcomm Adreno 640 GPU',
                    'battery' => 'Li-ion polymer (LiPo) 5000 mAh battery',
                    'description' => '',
                    'released' => '2019-07-00',
                    'photo' => 'asus_zenfone6.jpg',
                    'price' => 752.39,
                    'created_at' => ''
                ],
            ];
            foreach ($data as $row) {
                /** @var PhoneInterface $newPhone */
                $newPhone = $this->phoneFactory->create();
                $newPhone->setManufacturerId($row['manufacturer_id']);
                $newPhone->setModel($row['model']);
                $newPhone->setOs($row['os']);
                $newPhone->setResolution('resolution');
                $newPhone->setRam($row['ram']);
                $newPhone->setCpu($row['cpu']);
                $newPhone->setBattery($row['battery']);
                $newPhone->setDescription($row['description']);
                $newPhone->setReleased($row['released']);
                $newPhone->setPhoto($row['photo']);
                $newPhone->setPrice($row['price']);
                $newPhone->setCreatedAt('now');
                $this->phoneRepository->save($newPhone);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new phone model, message: "'. $exception->getMessage() . '"');
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