<?php

namespace Alex\Fin\Api\Data;

/**
 * Interface TabletsCasesInterface
 */
interface TabletsCasesInterface
{
    const ENTITY_ID = 'entity_id';

    const BRAND = 'brand';

    const COLOR = 'color';

    const CASESKU = 'caseSKU';

    const FORTABSKU = 'forTabSKU';

    const DESCRIPTION = 'description';

    const CREATED_AT = 'created_at';

    const PRICE = 'price';

    const SORT = 'sort';

    const SORTPARAM = 'sortparam';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get caseSKU
     *
     * @return int
     */
    public function getForTabSku();

    /**
     * Get forTabSKU
     *
     * @return int
     */
    public function getCaseSku();

    /**
     * Get id
     *
     * @return string
     */
    public function getBrand();

    /**
     * Get color
     *
     * @return string
     */
    public function getColor();

    /**
     * Get description
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
     * Get price
     *
     * @return float
     */
    public function getPrice();

    ///Setters - це лишнє

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set setBrand
     *
     * @param string $brand
     * @return TabletsCasesInterface
     */
    public function setBrand(string $brand): TabletsCasesInterface;

    /**
     * Set caseSKU
     *
     * @param int $caseSku
     * @return TabletsCasesInterface
     */
    public function setCaseSku(int $caseSku): TabletsCasesInterface;

    /**
     * Set forTabSKU
     *
     * @param int $tabSku
     * @return TabletsCasesInterface
     */
    public function setForTabSku(int $tabSku): TabletsCasesInterface;

    /**
     * Set color
     *
     * @param string $color
     * @return TabletsInterface - тип не співпадає
     */
    public function setColor(string $color):TabletsCasesInterface;


    /**
     * Set description
     *
     * @param string $description
     * @return TabletsInterface - тип не співпадає
     */
    public function setDescription(string $description):TabletsCasesInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return TabletsCasesInterface
     */
    public function setCreatedAt(string $createdAt): TabletsCasesInterface;

    /**
     * Set price
     *
     * @param float $price
     * @return TabletsCasesInterface
     */
    public function setPrice(float $price): TabletsCasesInterface;
}