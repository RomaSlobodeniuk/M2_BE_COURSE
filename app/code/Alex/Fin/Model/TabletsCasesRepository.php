<?php

namespace Alex\Fin\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\ResourceModel\TabletsCases\Collection;
use Alex\Fin\Model\ResourceModel\TabletsCases\CollectionFactory as TabletsCasesCollectionFactory;
use Alex\Fin\Model\ResourceModel\TabletsCasesResource;

/**
 * Class TabletsCasesRepository
 *
 * Загальні рекомендації:
 *
 * 1. Форматування коду!!!
 * 2. Doc Блоки!!!
 *
 */
class TabletsCasesRepository implements TabletsCasesRepositoryInterface
{
    private $logger;

    /**
     * @var EventManager
     *
     * `EventManager` немає в use!
     */
    private $eventManager;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsModelFactory // невірно! тут має бути об'єкт колекції
     */
    private $tabletsCasesCollection;

    /**
     * @var TabletsCasesCollectionFactory
     */
    private $TabletsCasesCollectionFactory;

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
     * @param SearchCriteriaBuilder $searchCriteriaBuilder ,
     * @param TabletsCasesModelFactory $TabletsCasesFactory
     * @param TabletsCasesCollectionFactory $TabletsCasesCollectionFactory
     *
     * @param TabletsCasesResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger, // винести в use, немає в описі в Doc блоці
        TabletsCasesModelFactory $TabletsCasesFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesCollectionFactory $TabletsCasesCollectionFactory,
        TabletsCasesResource $resource,
        \Magento\Framework\Event\Manager $eventManager, // винести в use, немає в описі в Doc блоці
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->logger = $logger;

        /**
         * Рекомендації:
         *
         * 1. Змінна створена на "льоту", свторити змінну в класі
         * 2. Змінна повинна бути camel case: `$this->tabletsCasesFactory`
         */
        $this->TabletsCasesFactory = $TabletsCasesFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->eventManager = $eventManager;
        $this->TabletsCasesCollectionFactory = $TabletsCasesCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(TabletsCasesInterface $TabletsCase): TabletsCasesInterface
    {
        try {
            $this->eventManager->dispatch('cases_before_save');
            /** @var TabletsCasesModel|TabletsCasesInterface $TabletsCase */
            $this->resource->save($TabletsCase);
            $this->eventManager->dispatch('cases_after_save');
        } catch (\Exception $exception) {
            /**
             * Лишні дужки!
             */
//            $this->logger->critical()($exception->getMessage());
            $this->logger->critical($exception->getMessage());
        }

        return $TabletsCase;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $TabletsCaseId): TabletsCasesInterface
    {
        /** @var TabletsCasesModel|TabletsCasesInterface $TabletsCase */
        $TabletsCase = $this->TabletsCasesFactory->create();
        $TabletsCase->load($TabletsCaseId);
        if (!$TabletsCase->getId()) {
            throw new NoSuchEntityException(__('entity with id `%1` does not exist.', $TabletsCaseId));
        }

        return $TabletsCase;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->TabletsCasesCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Тут має бути `{@inheritDoc}`
     *
     * @param int $caseSKU
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPresById(int $caseSKU): bool
    {
        /**
         * Роз'яснення:
         *
         * 1. Якщо називати метод getCasesCollection, то відповідно він повинен щось
         * повертати, а там просто сетиться навіть не колекція, а items
         *
         * Рекомендації:
         *
         * 1. Перейменувати цей метод в checkBySku;
         * 2. getCasesCollection видалити;
         * 3. використати getList метод з попередньо створеним фільтром `caseSKU`:
         *   ->addFilter(TabletsCasesInterface::CASESKU, $caseSKU)
         */
        $this->getCasesCollection();

        /** @var SearchCriteriaInterface $searchCriteria */
//        $searchCriteria = $this->searchCriteriaBuilder
//            ->addFilter(TabletsCasesInterface::CASESKU, $caseSKU)
//            ->create();

        /** @var SearchResults $searchResults */
//        $searchResults = $this->getList($searchCriteria);
//        return $searchResults->getTotalCount() > 0;

        /** @var TabletsCasesModel $case */
        try {
            foreach ($this->tabletsCasesCollection as $case) {
                if (($case->getCaseSku()) == $caseSKU) {
                    return true;
                }
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return false;
    }

    /**
     * Видалити цей метод!
     *
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCasesCollection()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        /** @var SearchResults $searchResults */
        $searchResults = $this->getList($searchCriteria);
        if ($searchResults->getTotalCount() > 0) {
            $this->tabletsCasesCollection = $searchResults->getItems();
        } else {
            $this->logger->error('collection does not found!');
        }
    }

    /**
     * Тут має бути `{@inheritDoc}`
     *
     * @param $tablet
     * @return int
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCasesQunatity($tablet) // виправити опечатку
    {
        /**
         * Роз'яснення:
         *
         * 1. Якщо називати метод getCasesCollection, то відповідно він повинен щось
         * повертати, а там просто сетиться навіть не колекція, а items;
         * 2. Не можна брати всю колекцію, а потім перебирати її в циклі!
         * По-перше, колекцію можна обмежити фільтром по тому самому SKU, по-друге
         * в колекції уже є getSize() метод, який і повертає розмір колекції
         *
         * Рекомендації:
         *
         * 1. Перейменувати цей метод в getCasesQuantity;
         * 2. getCasesCollection видалити;
         * 3. використати getList метод з попередньо створеним фільтром `forTabSKU`:
         *   ->addFilter(TabletsCasesInterface::FORTABSKU, $tablet)
         */

        /** @var SearchCriteriaInterface $searchCriteria */
//        $searchCriteria = $this->searchCriteriaBuilder
//            ->addFilter(TabletsCasesInterface::FORTABSKU, $tablet)
//            ->create();

        /** @var SearchResults $searchResults */
//        $searchResults = $this->getList($searchCriteria);
//        return $searchResults->getTotalCount();


        $this->getCasesCollection();
        $caseCount = 0;
        try {
            foreach ($this->tabletsCasesCollection as $case) {
                /** @var TabletsCasesModel $case */
                if ($case->getForTabSku() == $tablet) {
                    $caseCount++;
                }
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $caseCount;
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
     * Тут має бути `{@inheritDoc}`
     *
     * @param $casesku
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($casesku)
    {
        /**
         * empty($casesku) і так перевіряє чи змінна не 0
         * $casesku == 0 - лишнє
         */
        if (($casesku == 0) || (empty($casesku))) {
            /**
             * Цей метод повинен повертати bool
             */
              return 'NOT valid casesku!!!';
        }

        /**
         * Форматування коду !!!
         *
         * Назва методу не відповідає тому, що я бачу всередині -
         * це метод deleteBySku скоріше за все
         *
         * SearchCriteria - немає в use!
         *
         * Огорнути в try/catch таким чином, щоб тут не було ніяких виключень
         * а метод щоб повертав bool!
         *
         */
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(TabletsCasesInterface::CASESKU, $casesku)
                ->create();
            $searchResults = $this->getList($searchCriteria);
        if ($searchResults->getTotalCount() > 0) {
            $tempArray = $searchResults->getItems();
            $case = array_shift($tempArray);
            try {
                $this->delete($case);
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }

        /**
         * Цей метод повинен повертати bool, він взагалі нічого не повертає!
         */
    }
}
