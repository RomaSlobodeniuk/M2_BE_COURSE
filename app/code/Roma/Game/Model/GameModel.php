<?php

namespace Roma\Game\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Model\ResourceModel\Game as GameResourceModel;

/**
 * Class GameModel - форматування ^-^
 *
 * де Doc блоки?
 *
 * Навіщо тут ці TODO?
 */
class GameModel extends AbstractModel implements GameInterface
{

    public function _construct()
    {
        $this->_init(GameResourceModel::class);
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getGameCustomerId()
    {
        // TODO: Implement getGameCustomerId() method.
        return $this->getData(self::GAME_CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getGameId()
    {
        // TODO: Implement getGameId() method.
        return $this->getData(self::GAME_ID);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        // TODO: Implement getDescription() method.
        return $this->getData(self::DESCRIPTION);
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
    public function getPrice()
    {
        // TODO: Implement getPrice() method.
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setGameCustomerId(int $customerId): GameInterface
    {
        // TODO: Implement setGameCustomerId() method.
        return $this->setData(self::GAME_CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function setGameId(int $gameId): GameInterface
    {
        // TODO: Implement setGameId() method.
        return $this->setData(self::GAME_ID, $gameId);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): GameInterface
    {
        // TODO: Implement setTitle() method.
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): GameInterface
    {
        // TODO: Implement setDescription() method.
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function setPrice(int $price): GameInterface
    {
        // TODO: Implement setPrice() method.
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(\DateTime $createdAt): GameInterface
    {
        // TODO: Implement setCreatedAt() method.
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
