<?php

namespace Roma\Test\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Test\Model\ResourceModel\CarResource as CarResourceModel;

/**
 * Class CarModel
 */
class CarModel extends AbstractModel
{
    const ENTITY_ID = 'entity_id';

    const USER_ID = 'user_id';

    const CAR_ID = 'car_id';

    const DESCRIPTION = 'description';

    const CREATED_AT = 'created_at';

    const PRICE = 'entity_id';

    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(CarResourceModel::class);
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
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getCarId()
    {
        return (int)$this->getData(self::CAR_ID);
    }

    /**
     * {@inheritdoc}
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
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * {@inheritdoc}
     */
    public function setCarId($carId)
    {
        return $this->setData(self::CAR_ID, $carId);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt->format('Y-m-d H:i:s'));
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }
}
