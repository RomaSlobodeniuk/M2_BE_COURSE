<?php

namespace Roma\Game\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Ці класи ніде тут в інтерфейсі не використовуються, видалити або добавити
 * туди, де ці виключення викидуються
 */
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

use Roma\Game\Api\Data\GameCustomerInterface;

/**
 * Interface GameCustomerRepositoryInterface
 */
interface GameCustomerRepositoryInterface{
    /**
     * @param GameCustomerInterface $customer
     * @return GameCustomerInterface
     */
    public function save(GameCustomerInterface $customer): GameCustomerInterface;

    /**
     * @param int $customerId
     * @return GameCustomerInterface
     */
    public function getById(int $customerId): GameCustomerInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * @param GameCustomerInterface $customer
     * @return bool
     */
    public function delete(GameCustomerInterface $customer): bool;

    /**
     * @param int $customerId
     * @return bool
     */

    public function deleteById(int $customerId): bool;
}