<?php

namespace Slayer\Mobile\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slayer\Mobile\Api\Data\ManufacturerInterface;
use Slayer\Mobile\Api\ManufacturerRepositoryInterface;
use Slayer\Mobile\Model\ResourceModel\Manufacturer as ManufacturerResource;
use Slayer\Mobile\Model\ResourceModel\Manufacturer\Collection;
use Slayer\Mobile\Model\ResourceModel\Manufacturer\CollectionFactory as ManufacturerCollectionFactory;

/**
 * Class ManufacturerRepository
 */
class ManufacturerRepository implements ManufacturerRepositoryInterface
{
    /**
     * @var ManufacturerModelFactory
     */
    private $manufacturerFactory;

    /**
     * @var ManufacturerCollectionFactory
     */
    private $manufacturerCollectionFactory;

    /**
     * @var ManufacturerResource
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
     * @param ManufacturerModelFactory $manufacturerFactory
     * @param ManufacturerCollectionFactory $manufacturerCollectionFactory
     * @param ManufacturerResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ManufacturerModelFactory $manufacturerFactory,
        ManufacturerCollectionFactory $manufacturerCollectionFactory,
        ManufacturerResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->manufacturerFactory = $manufacturerFactory;
        $this->manufacturerCollectionFactory = $manufacturerCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ManufacturerInterface $manufacturer): ManufacturerInterface
    {
        try {
            /** @var ManufacturerModel|ManufacturerInterface $manufacturer */
            $this->resource->save($manufacturer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $manufacturer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $manufacturerId): ManufacturerInterface
    {
        /** @var ManufacturerModel|ManufacturerInterface $manufacturer */
        $manufacturer = $this->manufacturerFactory->create();
        $manufacturer->load($manufacturerId);
        if (!$manufacturer->getId()) {
            throw new NoSuchEntityException(__('Manufacturer entity with id `%1` does not exist.', $manufacturerId));
        }

        return $manufacturer;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->manufacturerCollectionFactory->create();
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
    public function delete(ManufacturerInterface $manufacturer): bool
    {
        try {
            /** @var ManufacturerModel $manufacturer */
            $this->resource->delete($manufacturer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $manufacturerId): bool
    {
        return $this->delete($this->getById($manufacturerId));
    }
}