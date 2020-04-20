<?php

namespace Roma\Game\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Game\Api\Data\GameCustomerInterface;
use Roma\Game\Model\ResourceModel\GameCustomer as GameCustomerResourceModel;

/**
 * Class GameCustomerModel - форматування ^-^
 *
 * Де Doc блоки?
 *
 * Навіщо тут ці TODO
 */
class GameCustomerModel extends AbstractModel implements GameCustomerInterface
{

    public function _construct()
    {
        $this->_init(GameCustomerResourceModel::class);
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        // TODO: Implement getEmail() method.
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function getSurname()
    {
        // TODO: Implement getSurname() method.
        return $this->getData(self::SURNAME);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        // TODO: Implement getCreatedAt() method.
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email): GameCustomerInterface
    {
        // TODO: Implement setEmail() method.
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function setName($name): GameCustomerInterface
    {
        // TODO: Implement setName() method.
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function setSurname($surname): GameCustomerInterface
    {
        // TODO: Implement setSurname() method.
        return $this->setData(self::SURNAME, $surname);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(\DateTime $createdAt): GameCustomerInterface
    {
        // TODO: Implement setCreatedAt() method.
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}