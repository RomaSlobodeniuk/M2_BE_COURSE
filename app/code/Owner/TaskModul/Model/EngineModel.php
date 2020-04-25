<?php


namespace Owner\TaskModul\Model;

/**
 * Форматування коду! Як у CarModel
 */
use Magento\Framework\Model\AbstractModel;
use Owner\TaskModul\Api\Data\EngineInterface;
use Owner\TaskModul\Model\ResourceModel\EngineResource;

/**
 * Class EngineModel
 * @package Owner\TaskModul\Model
 */
class EngineModel extends AbstractModel implements EngineInterface
{
    /**
     * {@inheritDoc}
     */
    public function _construct()
    {
        $this->_init(EngineResource::class);
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
    public function getManufacturer()
    {
        return $this->getData(self::MANUFACTURER);
    }

    /**
     * {@inheritDoc}
     */
    public function getWin()
    {
        return $this->getData(self::WIN);
    }

    /**
     * {@inheritDoc}
     */
    public function getPower()
    {
        return $this->getData(self::POWER);
    }

    /**
     * {@inheritDoc}
     */
    public function getVolume()
    {
        return $this->getData(self::VOLUME);
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
    public function setManufacturer(string $manufacturer) :EngineInterface
    {
        return $this->setData(self::MANUFACTURER, $manufacturer);
    }

    /**
     * {@inheritDoc}
     */
    public function setWin(string $win) :EngineInterface
    {
        return $this->setData(self::WIN, $win);
    }

    /**
     * {@inheritDoc}
     */
    public function setPower(float $power) :EngineInterface
    {
        return $this->setData(self::POWER, $power);
    }

    /**
     * {@inheritDoc}
     */
    public function setVolume(float $volume) :EngineInterface
    {
        return $this->setData(self::VOLUME, $volume);
    }

    /**
     * {@inheritDoc}
     */
    public function setYears(string $years) :EngineInterface
    {
        return $this->setData(self::YEARS, $years);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(string $created_At) :EngineInterface
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
