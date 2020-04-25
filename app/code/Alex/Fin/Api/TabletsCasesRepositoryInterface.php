<?php

namespace Alex\Fin\Api;

use Alex\Fin\Api\Data\TabletsCasesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface TabletsCasesRepositoryInterface
 */
interface TabletsCasesRepositoryInterface
{
    /**
     * Save entity
     *
     * @param TabletsCasesInterface $tabletsCases
     * @return TabletsCasesInterface
     * @throws CouldNotSaveException
     */
    public function save(TabletsCasesInterface $tabletsCases): TabletsCasesInterface;

    /**
     * Get case by ID
     *
     * @param int $id
     * @return TabletsCasesInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): TabletsCasesInterface;

    /**
     * Get entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * @param int $caseSKU
     * @return bool
     */
    public function getPresById(int $caseSKU): bool;

    /**
     * @param $tablet // який тип змінної?
     * @return mixed
     */
    public function getCasesQunatity($tablet); // Qunatity (опечатка): Quantity

    /**
     * @return mixed
     */
    public function getCasesCollection();

    /**
     * camel case ?
     * $caseSku - виглядає ліпше
     *
     * @param $casesku // який тип змінної?
     * @return mixed
     */
    public function deleteById($casesku);
}