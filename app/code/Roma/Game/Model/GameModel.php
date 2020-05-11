<?php

namespace Roma\Game\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Model\ResourceModel\Game as GameResourceModel;

/**
 * Class GameModel
 */
class GameModel extends AbstractModel implements GameInterface
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(GameResourceModel::class);
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
    public function getGameCustomerId()
    {
        return $this->getData(self::GAME_CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getGameId()
    {
        return $this->getData(self::GAME_ID);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
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
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setGameCustomerId(int $customerId): GameInterface
    {
        return $this->setData(self::GAME_CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function setGameId(int $gameId): GameInterface
    {
        return $this->setData(self::GAME_ID, $gameId);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): GameInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): GameInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function setPrice(int $price): GameInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt): GameInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
