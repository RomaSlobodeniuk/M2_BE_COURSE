<?php

namespace Alex\Fin\Setup\Patch\Data;

use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Model\TabletsModelFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutIntoCasesR2
 */
class PutIntoTabletsR2 implements DataPatchInterface
{
    /**
     * @var TabletsFactory
     */
    private $tabletsFactory;
    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param TabletsModelFactory $tabletsFactory
     */
    public function __construct(
        TabletsRepositoryInterface $tabletsRepository,
        LoggerInterface $logger,
        TabletsModelFactory $tabletsFactory
    ) {
        $this->tabletsRepository = $tabletsRepository;
        $this->logger = $logger;
        $this->tabletsFactory = $tabletsFactory;
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $data = [
            [
                'entity_id' => null,
                'TabSku' => 1119,
                'brand' => 'LG',
                'model' => 'yht123',
                'descriptions' => 'Test Description 1',
                'created_at' => '',
                'price' => '12332',
            ],
            [
                'entity_id' => null,
                'TabSku' => 1129,
                'brand' => 'SAMSUNG',
                'model' => 'yhsdsd',
                'descriptions' => 'Test Description 1',
                'created_at' => '',
                'price' => '9999',
            ],
            [
                'entity_id' => null,
                'TabSku' => 1139,
                'brand' => 'APPLE',
                'model' => 'mini3',
                'descriptions' => 'this is the best!',
                'created_at' => '',
                'price' => '15999',
            ],
            [
                'entity_id' => null,
                'TabSku' => 1149,
                'brand' => 'xiaomi',
                'model' => 'note4',
                'descriptions' => 'cheap and cool',
                'created_at' => '',
                'price' => '3687',
            ]
        ];

        try {
            foreach ($data as $row) {
                /** @var TabletsInterface $tablet */
                $tablet = $this->tabletsFactory->create();
                $tablet->setTabSku($row['TabSku']);
                $tablet->setDescriptions($row['descriptions']);
                $tablet->setBrand($row['brand']);
                $tablet->setModel($row['model']);
                $tablet->setPrice($row['price']);
                $this->tabletsRepository->save($tablet);
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
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }
}