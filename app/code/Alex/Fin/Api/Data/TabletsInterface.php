<?php

namespace Alex\Fin\Api\Data;

/**
 * Interface TabletsInterface
 */
interface TabletsInterface
{
    const ENTITY_ID = 'entity_id';

    const BRAND = 'brand';

    const TABSKU = 'tabSKU';

    const DESCRIPTIONS = 'descriptions';

    const CREATED_AT = 'created_at';

    const PRICE = 'price';

    const MODEL = 'model';

    const SORT = 'sort';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get SKU
     *
     * @return int
     */
    public function getTabSku();

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand();

    /**
     * Get descriptions
     *
     * @return string
     */
    public function getModel();

    /**
     * Get descriptions
     *
     * @return string
     */
    public function getDescriptions();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice();

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
     * @return TabletsInterface
     */
    public function setBrand(string $brand): TabletsInterface;

    /**
     * Set SKU
     *
     * @param int $tabSku
     * @return TabletsInterface
     */
    public function setTabSku(int $tabSku): TabletsInterface;

    /**
     * Set descriptions
     *
     * @param string $descriptions
     * @return TabletsInterface
     */
    public function setDescriptions(string $descriptions):TabletsInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return TabletsInterface
     */
    public function setCreatedAt(string $createdAt): TabletsInterface;

    /**
     * Set price
     *
     * @param float $price
     * @return TabletsInterface
     */
    public function setPrice(float $price): TabletsInterface;

    /**
     * @param string $model
     * @return TabletsInterface
     */
    public function setModel(string $model);
}