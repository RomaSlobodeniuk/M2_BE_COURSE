<?php

namespace Alex\Fin\Model;

use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\ResourceModel\TabletsResource as TabletsResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class TabletsModel
 */
class TabletsModel extends AbstractModel implements TabletsInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(TabletsResourceModel::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getModel()
    {
        return $this->getData(self::MODEL);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabSku()
    {
        return $this->getData(self::TABSKU);
    }

    /**
     * {@inheritdoc}
     */
    public function getBrand()
    {
        return $this->getData(self::BRAND);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescriptions()
    {
        return $this->getData(self::DESCRIPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function setModel(string $model)
    {
        return $this->setData(self::MODEL, $model);
    }

    /**
     * {@inheritdoc}
     */
    public function setBrand(string $brand): TabletsInterface
    {
        return $this->setData(self::BRAND, $brand);
    }

    /**
     * {@inheritdoc}
     */
    public function setTabSku(int $tabSku): TabletsInterface
    {
        return $this->setData(self::TABSKU, $tabSku);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescriptions(string $description): TabletsInterface
    {
        return $this->setData(self::DESCRIPTIONS, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): TabletsInterface
    {
        try {
            $createdAtObject = new \DateTime($createdAt);
            return $this->setData(self::CREATED_AT, $createdAtObject->format('Y-m-d H:i:s'));
        } catch (\Exception $e) {
            return $this->setData(self::CREATED_AT, null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice(float $price): TabletsInterface
    {
        return $this->setData(self::PRICE, $price);
    }
}