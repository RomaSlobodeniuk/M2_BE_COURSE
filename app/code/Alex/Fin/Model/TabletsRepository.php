<?php

namespace Alex\Fin\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\ResourceModel\Tablets\Collection as TabletsCollection;
use Alex\Fin\Model\ResourceModel\Tablets\CollectionFactory as TabletsCollectionFactory;
use Alex\Fin\Model\ResourceModel\TabletsResource as TabletsResource;

/**
 * Class TabletsRepository
 *
 * Тут в загальному всі ті ж помилки, що були в TabletsCasesRepository!
 *
 * Відрефакторити, виправити методи і логіку в них!
 */
class TabletsRepository implements TabletsRepositoryInterface
{
    private $logger;
    /**
     * @var EventManager
     */
    private $eventManager;
    /**
     * @var TabletsCollection|null
     */
    private $tabletsCollection;
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
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsModelFactory $tabletsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder,
     * @param TabletsCollectionFactory $tabletsCollectionFactory
     * @param TabletsResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        TabletsModelFactory $tabletsFactory,
        TabletsCollectionFactory $tabletsCollectionFactory,
        TabletsResource $resource,
        \Magento\Framework\Event\Manager $eventManager,
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
     * @param int $tabletSKU
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPresById(int $tabletSKU): bool    //to check, is tablet exist
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        /** @var SearchResults $searchResults */
        $searchResults = $this->getList($searchCriteria);
        if ($searchResults->getTotalCount() > 0) {
            $tabletsCollection = $searchResults->getItems();
        }
        /** @var TabletsModel $tablet */
        try {
            foreach ($tabletsCollection as $tablet) {
                if ($tablet->getTabSku() == $tabletSKU) {
                    return true;
                }
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
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
            $this->_eventManager->dispatch('tablet_before_delete');
            /** @var TabletsModel $tablet */
            $this->resource->delete($tablet);
            $this->_eventManager->dispatch('tablet_after_delete');
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
}
