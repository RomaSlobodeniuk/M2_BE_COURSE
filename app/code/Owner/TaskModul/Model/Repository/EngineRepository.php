<?php

namespace Owner\TaskModul\Model\Repository;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Owner\TaskModul\Api\RepositoryInterface\EngineRepositoryInterface;
use Owner\TaskModul\Api\Data\EngineInterface;
use Owner\TaskModul\Model\EngineModel;
use Owner\TaskModul\Model\EngineModelFactory;
use Owner\TaskModul\Model\ResourceModel\Engine\Collection;
use Owner\TaskModul\Model\ResourceModel\Engine\CollectionFactory;
use Owner\TaskModul\Model\ResourceModel\EngineResource;

/**
 * Class EngineRepository
 * @package Owner\TaskModul\Model\Repository
 */
class EngineRepository implements EngineRepositoryInterface
{
    /**
     * @var EngineModelFactory
     */
    private $engineFactory;

    /**
     * @var CollectionFactory
     */
    private $engineCollectionFactory;

    /**
     * @var EngineResource
     */
    private $engineResource;

    /**
     * @type SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @type CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * EngineRepository constructor.
     * @param EngineResource $engineResource
     * @param EngineModelFactory $engineFactory
     * @param CollectionFactory $engineCollectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        EngineResource $engineResource,
        EngineModelFactory $engineFactory,
        CollectionFactory $engineCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->engineFactory = $engineFactory;
        $this->engineCollectionFactory = $engineCollectionFactory;
        $this->engineResource = $engineResource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(EngineInterface $engine): EngineInterface
    {
        try {
            /** @var EngineModel|EngineInterface $engine */
            $this->engineResource->save($engine);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $engine;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $engineId): EngineInterface
    {
        /** @var EngineModel|EngineInterface $engine */
        $engine = $this->engineFactory->create();
        $engine->load($engineId);
        if (!$engine->getId()) {
            throw new NoSuchEntityException(__('Car (`%1`) does not exist.', $engineId));
        }

        return $engine;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->engineCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(EngineInterface $engine): bool
    {
        try {
            /** @var EngineModel $engine */
            $this->engineResource->delete($engine);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete row. `%1` ',$exception->getMessage()));
        }
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $engineId): bool
    {
        return $this->delete($this->getById($engineId));
    }
}
