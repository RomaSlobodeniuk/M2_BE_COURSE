<?php

namespace Alex\Fin\Setup\Patch\Data;

use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\TabletsCasesModelFactory;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutIntoCasesR2
 */
class PutIntoCasesR2 implements DataPatchInterface
{
    /**
     * @var TabletsCasesFactory
     */
    private $tabletsCasesFactory;
    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     */
    public function __construct(
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        LoggerInterface $logger,
        TabletsCasesModelFactory $tabletsCasesFactory
    ) {
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->logger = $logger;
        $this->tabletsCasesFactory = $tabletsCasesFactory;
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $data = [
            [
                'entity_id' => null,
                'forTabSku' => 1119,
                'caseSKU' => 72728119,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '11',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1119,
                'caseSKU' => 72728019,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '12',
                'color' => 'red-blue',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1129,
                'caseSKU' => 72727119,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '13',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1129,
                'caseSKU' => 72727109,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '14',
                'color' => 'red',
                'brand' => 'versafe'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1139,
                'caseSKU' => 72725109,
                'description' => 'Test Description 1',
                'created_at' => '',
                'price' => '15',
                'color' => 'red',
                'brand' => 'baoboao'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1139,
                'caseSKU' => 727259,
                'description' => 'Test Description 2',
                'created_at' => '',
                'price' => '16',
                'color' => 'red-blue',
                'brand' => 'baoboao_new'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1149,
                'caseSKU' => 72527109,
                'description' => 'coolest',
                'created_at' => '',
                'price' => '16',
                'color' => 'red-white-blue',
                'brand' => 'chana'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1149,
                'caseSKU' => 725279,
                'description' => 'coolest and best',
                'created_at' => '',
                'price' => '17',
                'color' => 'red-white',
                'brand' => 'chana bao'
            ],
            [
                'entity_id' => null,
                'forTabSku' => 1149,
                'caseSKU' => 725289,
                'description' => 'coolest',
                'created_at' => '',
                'price' => '178',
                'color' => 'red-white',
                'brand' => 'chana bao bu'
            ]
        ];

        try {
            foreach ($data as $row) {
                /** @var TabletsCasesInterface $case */
                $case = $this->tabletsCasesFactory->create();
                $case->setForTabSku($row['forTabSku']);
                $case->setCaseSku($row['caseSKU']);
                $case->setDescription($row['description']);
                $case->setBrand($row['brand']);
                $case->setColor($row['color']);
                $case->setPrice($row['price']);
                $this->tabletsCasesRepository->save($case);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "' . $exception->getMessage() . '"');
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [
            PutIntoTabletsR2::class
        ];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }
}