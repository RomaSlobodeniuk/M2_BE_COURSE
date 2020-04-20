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
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getSurname();

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $email
     * @return GameCustomerInterface
     */
    public function setEmail($email): GameCustomerInterface;

    /**
     * @param $name
     * @return GameCustomerInterface
     */
    public function setName($name): GameCustomerInterface;

    /**
     * @param $surname
     * @return GameCustomerInterface
     */
    public function setSurname($surname): GameCustomerInterface ;

    /**
     * @param \DateTime $createdAt
     * @return GameCustomerInterface
     */
    public function setCreatedAt(\DateTime $createdAt): GameCustomerInterface;
}