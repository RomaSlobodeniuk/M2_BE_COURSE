<?php

namespace Alex\Fin\Model;

use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\ResourceModel\Tablets\Collection as TabletsCollection;
use Alex\Fin\Model\ResourceModel\Tablets\CollectionFactory as TabletsCollectionFactory;
use Alex\Fin\Model\ResourceModel\TabletsResource as TabletsResource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Event\Manager as EventManager;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Class TabletsRepository
 */
class TabletsRepository implements TabletsRepositoryInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsModelFactory
     */
    private $tabletsFactory;

    /**
     * @var TabletsCollectionFactory
     */
    private $tabletsCollectionFactory;

    /**
     * @var TabletsResource
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
     * @param LoggerInterface $logger
     * @param TabletsModelFactory $tabletsFactory
     * @param TabletsCollectionFactory $tabletsCollectionFactory
     * @param TabletsResource $resource
     * @param EventManager $eventManager
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        LoggerInterface $logger,
        TabletsModelFactory $tabletsFactory,
        TabletsCollectionFactory $tabletsCollectionFactory,
        TabletsResource $resource,
        EventManager $eventManager,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->logger = $logger;
        $this->tabletsFactory = $tabletsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->tabletsCollectionFactory = $tabletsCollectionFactory;
        $this->resource = $resource;
        $this->eventManager = $eventManager;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(TabletsInterface $tablet): TabletsInterface
    {
        try {
            $this->eventManager->dispatch('new_tablet_before_save');
            /** @var TabletsModel|TabletsInterface $tablet */
            $this->resource->save($tablet);
            $this->eventManager->dispatch('new_tablet_after_save');
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $tablet;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $tabletId): TabletsInterface
    {
        /** @var TabletsModel|TabletsInterface $tablet */
        $tablet = $this->tabletsFactory->create();
        $tablet->load($tabletId);
        if (!$tablet->getId()) {
            throw new NoSuchEntityException(__('entity with id `%1` does not exist.', $tabletId));
        }

        return $tablet;
    }

    /**
     * @inheritDoc
     */
    public function checkBySku(int $tabletSKU): bool
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(TabletsInterface::TABSKU, $tabletSKU)
            ->create();

        /** @var SearchResults $searchResults */
        $searchResults = $this->getList($searchCriteria);
        return $searchResults->getTotalCount() > 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var TabletsCollection $collection */
        $collection = $this->tabletsCollectionFactory->create();
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
    public function delete(TabletsInterface $tablet): bool
    {
        try {
            $this->eventManager->dispatch('tablet_before_delete');
            /** @var TabletsModel $tablet */
            $this->resource->delete($tablet);
            $this->eventManager->dispatch('tablet_after_delete');
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}