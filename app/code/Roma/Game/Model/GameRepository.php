<?php

namespace Roma\Game\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Не використовується ніде
 */
use Magento\Framework\Exception\LocalizedException;

use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Game\Api\GameRepositoryInterface;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Model\GameModelFactory;
use Roma\Game\Model\ResourceModel\Game\Collection;
use Roma\Game\Model\ResourceModel\Game\CollectionFactory as GameCollectionFactory;
use Roma\Game\Model\ResourceModel\Game as GameResource;

/**
 * Class GameRepository
 */
/**
 * Class GameRepository - форматування ^-^
 *
 * Навіщо тут ці TODO?
 */
class GameRepository implements GameRepositoryInterface
{
    /**
     * @var GameModelFactory
     */
    private $gameModelFactory;

    /**
     * @var GameCollectionFactory
     */
    private $gameCollectionFactory;

    /**
     * @var GameResource
     */
    private $resource;

    /**
     * @type SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @type CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param GameModelFactory $gameModelFactory
     * @param GameCollectionFactory $gameCollectionFactory
     * @param GameResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        GameModelFactory $gameModelFactory,
        GameCollectionFactory $gameCollectionFactory,
        GameResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->gameModelFactory = $gameModelFactory;
        $this->gameCollectionFactory = $gameCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(GameInterface $game): GameInterface
    {
        // TODO: Implement save() method.
        try {
            /** @var  GameModel|GameInterface $game */
            $this->resource->save($game);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $game;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $gameId): GameInterface
    {
        // TODO: Implement getById() method.
        /** @var  GameModel|GameInterface $game */
        $game = $this->gameModelFactory->create();
        $game->load($gameId);
        if (!$game->getId()) {
            throw new NoSuchEntityException(__('Games entity with id `%1` does not exist.', $game));
        }

        return $game;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->gameCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(GameInterface $game): bool
    {
        // TODO: Implement delete() method.
        try {
            /** @var GameModel $game */
            $this->resource->delete($game);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $gameId): bool
    {
        // TODO: Implement deleteById() method.
        try {
            $delete = $this->delete($this->getById($gameId));
        }catch (\Exception $exception){
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return $delete;
    }
}