<?php

namespace Owner\TaskModul\Api\RepositoryInterface;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Owner\TaskModul\Api\Data\EngineInterface;

/**
 * Interface EngineRepositoryInterface
 * @package Owner\TaskModul\Api\RepositoryInterface
 */
interface EngineRepositoryInterface
{
    /**
     * Save Engine entity
     *
     * @param EngineInterface $engine
     * @return EngineInterface
     * @throws CouldNotSaveException
     */
    public function save(EngineInterface $engine): EngineInterface;

    /**
     * Get Engine by id
     *
     * @param int $engineId
     * @return EngineInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $engineId): EngineInterface;

    /**
     * Get Engines list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Engine entity
     *
     * @param EngineInterface $engine
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(EngineInterface $engine): bool;

    /**
     * Delete Engine by id
     *
     * @param int $engineId
     * @return mixed
     */
    public function deleteById(int $engineId);
}