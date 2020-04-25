<?php

namespace Slayer\Mobile\Api\Data;

/**
 * Interface ManufacturerInterface
 */
interface ManufacturerInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const DIRECTOR = 'director';
    const PHONE_NUMBER = 'phone';
    const EMAIL = 'email';
    const ADDRESS = 'address';
    const FOUNDATION_DATE = 'foundation_date';
    const SORT = 'sort';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get manufacturer name
     *
     * @return string
     */
    public function getName();

    /**
     * Get  manufacturer director name & surname
     *
     * @return string
     */
    public function getDirector();

    /**
     * Get manufacturer phone number
     *
     * @return int
     */
    public function getPhoneNumber();

    /**
     * Get manufacturer email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get manufacturer address
     *
     * @return string
     */
    public function getAddress();

    /**
     * Get manufacturer foundation date
     *
     * @return string
     */
    public function getFoundationDate();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set manufacturer name
     *
     * @param string $name
     * @return ManufacturerInterface
     */
    public function setName(string $name): ManufacturerInterface;

    /**
     * Set manufacturer director name & surname
     *
     * @param string $director
     * @return ManufacturerInterface
     */
    public function setDirector(string $director): ManufacturerInterface;

    /**
     * Set manufacturer phone
     *
     * @param string $phoneNumber
     * @return ManufacturerInterface
     */
    public function setPhoneNumber(string $phoneNumber): ManufacturerInterface;

    /**
     * Set manufacturer email
     *
     * @param string $email
     * @return ManufacturerInterface
     */
    public function setEmail(string $email): ManufacturerInterface;

    /**
     * Set manufacturer email
     *
     * @param string $address
     * @return ManufacturerInterface
     */
    public function setAddress(string $address): ManufacturerInterface;

    /**
     * Set manufacturer surname
     *
     * @param string $foundationDate
     * @return ManufacturerInterface
     */
    public function setFoundationDate(string $foundationDate): ManufacturerInterface;
}
