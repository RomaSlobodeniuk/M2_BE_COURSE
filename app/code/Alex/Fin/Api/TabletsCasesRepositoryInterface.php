<?php

namespace Alex\Fin\Api;

use Alex\Fin\Api\Data\TabletsCasesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotDeleteException;
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
    public function checkBySku(int $caseSKU): bool;

    /**
     * @param int $tablet
     * @return mixed
     * @throws LocalizedException
     */
    public function getCasesQuantity(int $tablet);

    /**
     * @param TabletsCasesInterface $case
     * @return mixed
     * @throws CouldNotDeleteException
     */
    public function delete(TabletsCasesInterface $case);

    /**
     * @param int $caseSku
     * @return mixed
     */
    public function deleteBySku(int $caseSku);
}