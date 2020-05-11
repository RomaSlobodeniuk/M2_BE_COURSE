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
     * Save game entity
     *
     * @param GameInterface $game
     * @return GameInterface
     * @throws CouldNotSaveException
     */
    public function save(GameInterface $game): GameInterface;

    /**
     * Get game by its id
     *
     * @param int $gameId
     * @return GameInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $gameId): GameInterface;

    /**
     * Get games entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete game entity
     *
     * @param GameInterface $game
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(GameInterface $game): bool;

    /**
     * Delete game entity by id
     *
     * @param int $gameId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $gameId): bool;
}