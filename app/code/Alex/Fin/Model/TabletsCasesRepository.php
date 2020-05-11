<?php

namespace Alex\Fin\Model;

use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\ResourceModel\TabletsCases\Collection as TabletsCasesCollection;
use Alex\Fin\Model\ResourceModel\TabletsCases\CollectionFactory as TabletsCasesCollectionFactory;
use Alex\Fin\Model\ResourceModel\TabletsCasesResource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Event\Manager as EventManager;
use Psr\Log\LoggerInterface;

/**
 * Class TabletsCasesRepository
 */
class TabletsCasesRepository implements TabletsCasesRepositoryInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Manager
     */
    private $eventManager;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsCasesCollection
     */
    private $tabletsCasesCollection;

    /**
     * @var TabletsCasesCollectionFactory
     */
    private $tabletsCasesCollectionFactory;

    /**
     * @var TabletsCasesResource
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
     * @type TabletsCasesModelFactory
     */
    private $tabletsCasesFactory;

    /**
     * @param LoggerInterface $logger
     * @param SearchCriteriaBuilder $searchCriteriaBuilder ,
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     * @param TabletsCasesCollectionFactory $tabletsCasesCollectionFactory
     * @param TabletsCasesResource $resource
     * @param EventManager $eventManager
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        LoggerInterface $logger,
        TabletsCasesModelFactory $tabletsCasesFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesCollectionFactory $tabletsCasesCollectionFactory,
        TabletsCasesResource $resource,
        EventManager $eventManager,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->logger = $logger;
        $this->tabletsCasesFactory = $tabletsCasesFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->eventManager = $eventManager;
        $this->tabletsCasesCollectionFactory = $tabletsCasesCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(TabletsCasesInterface $tabletsCase): TabletsCasesInterface
    {
        try {
            $this->eventManager->dispatch('cases_before_save');
            /** @var TabletsCasesModel|TabletsCasesInterface $tabletsCase */
            $this->resource->save($tabletsCase);
            $this->eventManager->dispatch('cases_after_save');
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }

        return $tabletsCase;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $tabletsCaseId): TabletsCasesInterface
    {
        /** @var TabletsCasesModel|TabletsCasesInterface $tabletsCase */
        $tabletsCase = $this->tabletsCasesFactory->create();
        $tabletsCase->load($tabletsCaseId);
        if (!$tabletsCase->getId()) {
            throw new NoSuchEntityException(__('entity with id `%1` does not exist.', $tabletsCaseId));
        }

        return $tabletsCase;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var TabletsCasesCollection $collection */
        $collection = $this->tabletsCasesCollectionFactory->create();
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
    public function checkBySku(int $caseSKU): bool
    {
        /** @var SearchCriteriaInterface $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(TabletsCasesInterface::CASESKU, $caseSKU)
            ->create();

        /** @var SearchResults $searchResults */
        $searchResults = $this->getList($searchCriteria);
        return $searchResults->getTotalCount() > 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getCasesQuantity($tablet)
    {
        /** @var SearchCriteriaInterface $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(TabletsCasesInterface::FORTABSKU, $tablet)
            ->create();

        /** @var SearchResults $searchResults */
        $searchResults = $this->getList($searchCriteria);
        return $searchResults->getTotalCount();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(TabletsCasesInterface $case): bool
    {
        try {
            $this->eventManager->dispatch('cases_before_delete');
            /** @var TabletsCasesModel $case */
            $this->resource->delete($case);
            $this->eventManager->dispatch('cases_after_delete');
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteBySku($caseSku)
    {
        if (empty($caseSku)) {
            return false;
        }

        $result = false;
        try {
            /** @var SearchCriteriaInterface $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(TabletsCasesInterface::CASESKU, $caseSku)
                ->create();
            $searchResults = $this->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                $tempArray = $searchResults->getItems();
                $case = array_shift($tempArray);
                $this->delete($case);
                $result = true;
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $result;
    }
}