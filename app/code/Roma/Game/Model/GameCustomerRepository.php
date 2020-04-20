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
use Roma\Game\Api\GameCustomerRepositoryInterface;
use Roma\Game\Api\Data\GameCustomerInterface;
use Roma\Game\Model\GameCustomerModelFactory;
use Roma\Game\Model\ResourceModel\GameCustomer\Collection;
use Roma\Game\Model\ResourceModel\GameCustomer\CollectionFactory as GameCustomerCollectionFactory;
use Roma\Game\Model\ResourceModel\GameCustomer as GameCustomerResource;

/**
 * Class GameCustomerRepository
 */

/**
 * Class GameCustomerRepository - форматування ^-^
 *
 * Навіщо тут ці TODO?
 */
class GameCustomerRepository implements GameCustomerRepositoryInterface
{
    /**
     * @var GameCustomerModelFactory
     */
    private $gameCustomerModelFactory;

    /**
     * @var GameCustomerCollectionFactory
     */
    private $gameCustomerCollectionFactory;

    /**
     * @var GameCustomerResource
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
     * @param GameCustomerModelFactory $gameCustomerModelFactory
     * @param GameCustomerCollectionFactory $gameCustomerCollectionFactory
     * @param GameCustomerResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        GameCustomerModelFactory $gameCustomerModelFactory,
        GameCustomerCollectionFactory $gameCustomerCollectionFactory,
        GameCustomerResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->gameCustomerModelFactory = $gameCustomerModelFactory;
        $this->gameCustomerCollectionFactory = $gameCustomerCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(GameCustomerInterface $gameCustomer): GameCustomerInterface
    {
        // TODO: Implement save() method.
        try {
            /** @var  GameModel|GameCustomerInterface $gameCustomer */
            $this->resource->save($gameCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $gameCustomer;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById(int $gameCustomerId): GameCustomerInterface
    {
        // TODO: Implement getById() method.
        /** @var  GameModel|GameCustomerInterface $gameCustomer */
        $gameCustomer = $this->gameCustomerModelFactory->create();
        $gameCustomer->load($gameCustomerId);
        if (!$gameCustomer->getId()) {
            throw new NoSuchEntityException(__('Games entity with id `%1` does not exist.', $gameCustomer));
        }

        return $gameCustomer;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->gameCustomerCollectionFactory->create();
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
     * @throws CouldNotDeleteException
     */
    public function delete(GameCustomerInterface $gameCustomer): bool
    {
        // TODO: Implement delete() method.
        try {
            /** @var GameModel $gameCustomer */
            $this->resource->delete($gameCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * @inheritDoc
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $gameCustomerId): bool
    {
        // TODO: Implement deleteById() method.
        try {
            $delete = $this->delete($this->getById($gameCustomerId));
        }catch (\Exception $exception){
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return $delete;
    }
}