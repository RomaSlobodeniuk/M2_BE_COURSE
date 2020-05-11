<?php

namespace Roma\Game\Api\Data;

/**
 * Interface GameInterface
 */
interface GameInterface
{
    const ENTITY_ID = 'entity_id';

    const GAME_CUSTOMER_ID = 'game_customer_id';

    const GAME_ID = 'game_id';

    const TITLE = 'title';

    const DESCRIPTION = 'description';

    const PRICE = 'price';

    const CREATED_AT = 'created_at';


    /**
     * Get game entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get customer id
     *
     * @return int
     */
    public function getGameCustomerId();

    /**
     * Get game Id
     *
     * @return mixed
     */
    public function getGameId();

    /**
     * Get title
     *
     * @return int
     */
    public function getTitle();

    /**
     * Get game description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Get Price
     *
     * @return mixed
     */
    public function  getPrice();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set customer id
     *
     * @param int $customerId
     * @return GameInterface
     */
    public function setGameCustomerId(int $customerId): GameInterface;

    /**
     * Set game id
     *
     * @param int $gameId
     * @return GameInterface
     */
    public function setGameId(int $gameId): GameInterface;

    /**
     * Set game title
     *
     * @param string $title
     * @return GameInterface
     */
    public function setTitle(string $title): GameInterface;

    /**
     * Set game description
     *
     * @param string $description
     * @return GameInterface
     */
    public function setDescription(string $description): GameInterface;

    /**
     * Set game price
     *
     * @param int $price
     * @return GameInterface
     */
    public function setPrice(int $price): GameInterface;

    /**
     * Set created at date
     *
     * @param $createdAt
     * @return GameInterface
     */
    public function setCreatedAt($createdAt): GameInterface;
}