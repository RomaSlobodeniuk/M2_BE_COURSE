<?php

namespace Owner\TaskModul\Api\Data;

/**
 * Interface CarInterface
 * @package Owner\TaskModul\Api\Data
 */
interface CarInterface
{

    const ENTITY_ID = 'entity_id';

    const BRAND = 'brand';

    const MODEL = 'model';

    const ENGINE_ID = 'engine_id';

    const PRICE = 'price';

    const YEARS = 'years';

    const CREATED_AT = 'created_at';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get car brand
     *
     * @return string
     */
    public function getBrand();

    /**
     * Get car model
     *
     * @return string
     */
    public function getModel();

    /**
     * Get car engine ID
     *
     * @return int
     */
    public function getEngineId();

    /**
     * Get car price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Get car years of issue
     *
     * @return string
     */
    public function getYears();

    /**
     * Get car created at
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
     * Set brand
     *
     * @param string $brand
     * @return CarInterface
     */
    public function setBrand(string $brand);

    /**
     * Set model
     *
     * @param string $model
     * @return CarInterface
     */
    public function setModel(string $model);

    /**
     * Set engine id
     *
     * @param int $engineId
     * @return CarInterface
     */
    public function setEngineId(int $engineId): CarInterface;

    /**
     * Set price
     *
     * @param float $price
     * @return CarInterface
     */
    public function setPrice(float $price): CarInterface;

    /**
     * Set car years of issue
     *
     * @param string $years
     * @return CarInterface
     */
    public function setYears(string $years): CarInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return CarInterface
     */
    public function setCreatedAt(string $createdAt): CarInterface;
}