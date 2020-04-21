<?php

namespace Alex\Fin\Model;

use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\ResourceModel\TabletsCasesResource as TabletsCasesResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class TabletsCasesModel
 */
class TabletsCasesModel extends AbstractModel implements TabletsCasesInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(TabletsCasesResourceModel::class);
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
    public function getForTabSku()
    {
        return $this->getData(self::FORTABSKU);
    }

    /**
     *
     * @return int
     */
    public function getCaseSku()
    {
        return $this->getData(self::CASESKU);
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
    public function getColor()
    {
        return $this->getData(self::COLOR);
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    //setters - це линшє

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
    public function setBrand(string $brand): TabletsCasesInterface
    {
        return $this->setData(self::BRAND, $brand);
    }

    /**
     * {@inheritdoc}
     */
    public function setColor(string $color): TabletsCasesInterface
    {
        return $this->setData(self::COLOR, $color);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): TabletsCasesInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice(float $price): TabletsCasesInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function setCaseSku(int $caseSKU): TabletsCasesInterface
    {
        return $this->setData(self::CASESKU, $caseSKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setForTabSku(int $SKU): TabletsCasesInterface
    {
        return $this->setData(self::FORTABSKU, $SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): TabletsCasesInterface
    {
        /**
         * $createdAt - строка! а тут іде звертання як до об'єкта!
         * зробити так, щоб не було ніяких помилок:
         *
         * Якщо строка - то зберігати строку, якщо об'єкт \DateTime() - то відповідно
         * внести зміни сюди
         */
        return $this->setData(self::CREATED_AT, $createdAt->format('Y-m-d H:i:s'));
    }
}