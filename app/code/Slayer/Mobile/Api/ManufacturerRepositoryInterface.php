<?php

namespace Slayer\Mobile\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slayer\Mobile\Api\Data\ManufacturerInterface;

/**
 * Interface ManufacturerRepositoryInterface
 */
interface ManufacturerRepositoryInterface
{
    /**
     * Save Manufacturer entity
     *
     * @param ManufacturerInterface $manufacturer
     * @return ManufacturerInterface
     * @throws CouldNotSaveException
     */
    public function save(ManufacturerInterface $manufacturer): ManufacturerInterface;

    /**
     * Get Manufacturer by its id
     *
     * @param int $manufacturerId
     * @return ManufacturerInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $manufacturerId): ManufacturerInterface;

    /**
     * Get Manufacturer entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Manufacturer entity
     *
     * @param ManufacturerInterface $manufacturer
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(ManufacturerInterface $manufacturer): bool;

    /**
     * Delete Manufacturer entity by id
     *
     * @param int $manufacturerId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $manufacturerId): bool;
}
