<?php

namespace Slayer\Mobile\Api\Data;

/**
 * Interface PhoneInterface
 */
interface PhoneInterface
{
    const ENTITY_ID = 'entity_id';
    const MANUFACTURER_ID = 'manufacturer_id';
    const MODEL = 'model';
    const OS = 'os';
    const RESOLUTION = 'resolution';
    const RAM = 'ram';
    const CPU = 'cpu';
    const BATTERY = 'battery';
    const DESCRIPTION = 'description';
    const RELEASED = 'released';
    const PHOTO = 'photo';
    const PRICE = 'price';
    const CREATED_AT = 'created_at';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get manufacturer id
     *
     * @return int
     */
    public function getManufacturerId();

    /**
     * Get phone model
     *
     * @return string
     */
    public function getModel();

    /**
     * Get phone os
     *
     * @return string
     */
    public function getOs();

    /**
     * Get phone resolution
     *
     * @return string
     */
    public function getResolution();

    /**
     * Get ram
     *
     * @return string
     */
    public function getRam();

    /**
     * Get cpu
     *
     * @return string
     */
    public function getCpu();

    /**
     * Get phone battery
     *
     * @return string
     */
    public function getBattery();

    /**
     * Get phone description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get phone release
     *
     * @return string
     */
    public function getReleased();

    /**
     * Get phone photo
     *
     * @return string
     */
    public function getPhoto();
    /**
     * Get phone price
     *
     * @return float
     */
    public function getPrice();
    
    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set manufacturer id
     *
     * @param int $manufacturerId
     * @return PhoneInterface
     */
    public function setManufacturerId(int $manufacturerId): PhoneInterface;

    /**
     * Set phone model
     *
     * @param string $model
     * @return PhoneInterface
     */
    public function setModel(string $model): PhoneInterface;

    /**
     * Set phone os
     *
     * @param string $os
     * @return PhoneInterface
     */
    public function setOs(string $os): PhoneInterface;

    /**
     * Set phone resolution
     *
     * @param string $resolution
     * @return PhoneInterface
     */
    public function setResolution(string $resolution): PhoneInterface;

    /**
     * Set ram
     *
     * @param string $ram
     * @return PhoneInterface
     */
    public function setRam(string $ram): PhoneInterface;

    /**
     * Set cpu
     *
     * @param string $cpu
     * @return PhoneInterface
     */
    public function setCpu(string $cpu): PhoneInterface;

    /**
     * Set phone battery
     *
     * @param string $battery
     * @return PhoneInterface
     */
    public function setBattery(string $battery): PhoneInterface;

    /**
     * Set phone description
     *
     * @param string $description
     * @return PhoneInterface
     */
    public function setDescription(string $description): PhoneInterface;

    /**
     * Set phone released date
     *
     * @param string $released
     * @return PhoneInterface
     */
    public function setReleased(string $released): PhoneInterface;

    /**
     * Set phone photo
     *
     * @param string $photo
     * @return PhoneInterface
     */
    public function setPhoto(string $photo): PhoneInterface;

    /**
     * Set phone price
     *
     * @param float $price
     * @return PhoneInterface
     */
    public function setPrice(float $price): PhoneInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return PhoneInterface
     */
    public function setCreatedAt(string $createdAt): PhoneInterface;
}
