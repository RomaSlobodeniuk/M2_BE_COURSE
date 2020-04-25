<?php

namespace Owner\TaskModul\Model;

/**
 * Форматування коду!
 */
use Magento\Framework\Model\AbstractModel;
use Owner\TaskModul\Api\Data\CarInterface;
use Owner\TaskModul\Model\ResourceModel\CarResource;

/**
 * Class CarModel
 * @package Owner\TaskModul\Model
 */
class CarModel extends AbstractModel implements CarInterface
{
    /**
     * {@inheritDoc}
     */
    public function _construct()
    {
        $this->_init(CarResource::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrand()
    {
        return $this->getData(self::BRAND);
    }

    /**
     * {@inheritDoc}
     */
    public function getModel()
    {
        return $this->getData(self::MODEL);
    }

    /**
     * {@inheritDoc}
     */
    public function getEngineId()
    {
        return $this->getData(self::ENGINE_ID);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * {@inheritDoc}
     */
    public function getYears()
    {
        return $this->getData(self::YEARS);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }


    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritDoc}
     */
    public function setBrand(string $brand): CarInterface
    {
        return $this->setData(self::BRAND, $brand);
    }

    /**
     * {@inheritDoc}
     */
    public function setModel(string $model): CarInterface
    {
        return $this->setData(self::MODEL, $model);
    }

    /**
     * {@inheritDoc}
     */
    public function setEngineId(int $engine_id): CarInterface
    {
        return $this->setData(self::ENGINE_ID, $engine_id);
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice(float $price): CarInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritDoc}
     */
    public function setYears(string $years): CarInterface
    {
        return $this->setData(self::YEARS, $years);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(string $created_At): CarInterface
    {
        /**
         * В даному методі може бути викинуте виключення, рекомендації:
         *
         * 1. Або добавити @throws (а тут тип виключення) в опис до інтерфейсу;
         * 2. Або огорнути в try/catch при цьому дотримуючись повернення правильного
         * типу даних
         *
         * {@inheritdoc}
         */
        $created_date = new \DateTime($created_At);
        return $this->setData(self::CREATED_AT, $created_date->format('Y-m-d H:i:s'));
    }
}
