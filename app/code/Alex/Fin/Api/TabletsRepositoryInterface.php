<?php

namespace Alex\Fin\Api;

/**
 * Тут має бути все за алфавітом
 */
use Alex\Fin\Api\Data\TabletsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface TabletsRepositoryInterface
 */
interface TabletsRepositoryInterface
{
    /**
     * Save entity
     *
     * @param TabletsInterface $tablet
     * @return TabletsInterface
     * @throws CouldNotSaveException
     */
    public function save(TabletsInterface $tablet): TabletsInterface;

    /**
     * Get Tablet by id
     *
     * @param int $tabletId
     * @return TabletsInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $tabletId): TabletsInterface;

    /**
     * Get entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete entity
     *
     * @param TabletsInterface $tablet
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(TabletsInterface $tablet): bool;

    /**
     * @param int $tabletSKU
     * @return bool
     */
    public function getPresById(int $tabletSKU): bool;
}