<?php

namespace Roma\Game\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Game\Api\Data\GameInterface;

/**
 * Interface GameRepositoryInterface
 */
interface GameRepositoryInterface
{
    /**
     * Save Games entity
     *
     * @param GameInterface $game
     * @return GameInterface
     * @throws CouldNotSaveException
     */
    public function save(GameInterface $game): GameInterface;

    /**
     * Get Games by its id
     *
     * @param int $gameId
     * @return GameInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $gameId): GameInterface;

    /**
     * Get Games entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Games entity
     *
     * @param GameInterface $game
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(GameInterface $game): bool;

    /**
     * Delete Games entity by id
     *
     * @param int $gameId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $gameId): bool;
}