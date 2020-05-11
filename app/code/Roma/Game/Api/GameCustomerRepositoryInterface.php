<?php

namespace Roma\Game\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Game\Api\Data\GameCustomerInterface;

/**
 * Interface GameCustomerRepositoryInterface
 */
interface GameCustomerRepositoryInterface{
    /**
     * Save customer entity
     *
     * @param GameCustomerInterface $customer
     * @return GameCustomerInterface
     * @throws CouldNotSaveException
     */
    public function save(GameCustomerInterface $customer): GameCustomerInterface;

    /**
     * Get customers by its id
     *
     * @param int $customerId
     * @return GameCustomerInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $customerId): GameCustomerInterface;

    /**
     * Get customers entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete customer entity
     *
     * @param GameCustomerInterface $customer
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(GameCustomerInterface $customer): bool;

    /**
     * Delete customer entity by its id
     *
     * @param int $customerId
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $customerId): bool;
}