<?php

namespace Roma\Game\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Game\Api\Data\GameCustomerInterface;
use Roma\Game\Model\ResourceModel\GameCustomer as GameCustomerResourceModel;

/**
 * Class GameCustomerModel
 */
class GameCustomerModel extends AbstractModel implements GameCustomerInterface
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(GameCustomerResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function getSurname()
    {
        return $this->getData(self::SURNAME);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email): GameCustomerInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function setName($name): GameCustomerInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function setSurname($surname): GameCustomerInterface
    {
        return $this->setData(self::SURNAME, $surname);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt): GameCustomerInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}