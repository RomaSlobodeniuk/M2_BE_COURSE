<?php

namespace Slayer\Mobile\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slayer\Mobile\Api\Data\PhoneInterface;

/**
 * Interface PhoneRepositoryInterface
 */
interface PhoneRepositoryInterface
{
    /**
     * Save Phone entity
     *
     * @param PhoneInterface $phone
     * @return PhoneInterface
     * @throws CouldNotSaveException
     */
    public function save(PhoneInterface $phone): PhoneInterface;

    /**
     * Get Phone by its id
     *
     * @param int $phoneId
     * @return PhoneInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $phoneId): PhoneInterface;

    /**
     * Get Phone entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Phone entity
     *
     * @param PhoneInterface $phone
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PhoneInterface $phone): bool;

    /**
     * Delete Phone entity by id
     *
     * @param int $phoneId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $phoneId): bool;
}
