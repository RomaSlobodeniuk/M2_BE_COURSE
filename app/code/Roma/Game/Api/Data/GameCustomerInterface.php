<?php

namespace Roma\Game\Api\Data;

/**
 * Interface GameCustomerInterface
 */
interface GameCustomerInterface
{
    const ENTITY_ID ='entity_id';
    const EMAIL ='email';
    const NAME ='name';
    const SURNAME ='surname';
    const CREATED_AT ='created_at';

    /**
     * Get customer id
     *
     * @return mixed
     */
    public function getId();

    /**
     * Get customer email
     *
     * @return mixed
     */
    public function getEmail();

    /**
     * Get customer name
     *
     * @return mixed
     */
    public function getName();

    /**
     * Get customer surname
     *
     * @return mixed
     */
    public function getSurname();

    /**
     * Get created at data
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Set customer email
     *
     * @param $email
     * @return GameCustomerInterface
     */
    public function setEmail($email): GameCustomerInterface;

    /**
     * Set customer name
     *
     * @param $name
     * @return GameCustomerInterface
     */
    public function setName($name): GameCustomerInterface;

    /**
     * Set customer surname
     *
     * @param $surname
     * @return GameCustomerInterface
     */
    public function setSurname($surname): GameCustomerInterface ;

    /**
     * Set created at
     *
     * @param $createdAt
     * @return GameCustomerInterface
     */
    public function setCreatedAt($createdAt): GameCustomerInterface;
}