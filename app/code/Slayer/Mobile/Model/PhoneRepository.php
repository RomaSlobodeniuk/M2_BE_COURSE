<?php

namespace Slayer\Mobile\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slayer\Mobile\Api\PhoneRepositoryInterface;
use Slayer\Mobile\Api\Data\PhoneInterface;
use Slayer\Mobile\Model\PhoneModelFactory;
use Slayer\Mobile\Model\ResourceModel\Phone as PhoneResource;
use Slayer\Mobile\Model\ResourceModel\Phone\Collection;
use Slayer\Mobile\Model\ResourceModel\Phone\CollectionFactory as PhoneCollectionFactory;

/**
 * Class PhoneRepository
 */
class PhoneRepository implements PhoneRepositoryInterface
{
    /**
     * @var PhoneModelFactory
     */
    private $phoneFactory;

    /**
     * @var PhoneCollectionFactory
     */
    private $phoneCollectionFactory;

    /**
     * @var PhoneResource
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
     * @param PhoneModelFactory $phoneFactory
     * @param PhoneCollectionFactory $phoneCollectionFactory
     * @param PhoneResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        PhoneModelFactory $phoneFactory,
        PhoneCollectionFactory $phoneCollectionFactory,
        PhoneResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->phoneFactory = $phoneFactory;
        $this->phoneCollectionFactory = $phoneCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(PhoneInterface $phone): PhoneInterface
    {
        try {
            /** @var PhoneModel|PhoneInterface $phone */
            $this->resource->save($phone);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $phone;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $phoneId): PhoneInterface
    {
        /** @var PhoneModel|PhoneInterface $phone */
        $phone = $this->phoneFactory->create();
        $phone->load($phoneId);
        if (!$phone->getId()) {
            throw new NoSuchEntityException(__('Phone entity with id `%1` does not exist.', $phoneId));
        }

        return $phone;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->phoneCollectionFactory->create();
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
    public function delete(PhoneInterface $phone): bool
    {
        try {
            /** @var PhoneModel $phone */
            $this->resource->delete($phone);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $phoneId): bool
    {
        return $this->delete($this->getById($phoneId));
    }
}