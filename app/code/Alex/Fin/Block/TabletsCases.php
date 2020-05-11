<?php

namespace Alex\Fin\Block;

use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Model\ExternalApi;
use Alex\Fin\Model\TabletsCasesModelFactory;
use Alex\Fin\Model\TabletsCasesModel;
use Alex\Fin\Model\ResourceModel\TabletsCases\CollectionFactory as TabletsCasesCollectionFactory;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class TabletsCases
 */
class TabletsCases extends Template
{
    public $request;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Alex\Fin\Model\ExternalApi|null
     */
    protected $externalApi;

    /**
     * @var TabletsCasesFactory
     */
    private $tabletsCasesFactory;

    /**
     * @var TabletsCasesCollectionFactory
     */
    private $tabletsCasesCollectionFactory;

    /**
     * @var \Alex\Fin\Model\ResourceModel\TabletsCases\Collection|null
     */
    private $tabletsCasesCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param ExternalApi $externalApi
     * @param Context $context
     * @param LoggerInterface $logger
     * @param TabletsCasesCollectionFactory $tabletsCasesCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param ManagerInterface $messageManager
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        ExternalApi $externalApi,
        LoggerInterface $logger,
        Context $context,
        TabletsCasesCollectionFactory $tabletsCasesCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        ManagerInterface $messageManager,
        TabletsRepositoryInterface $tabletsRepository,
        TabletsCasesModelFactory $tabletsCasesFactory,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->externalApi = $externalApi;
        $this->tabletsCasesCollectionFactory = $tabletsCasesCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
        $this->tabletsCasesFactory = $tabletsCasesFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->tabletsRepository = $tabletsRepository;
    }

    /**
     * Preparing global layout
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $request = $this->getRequest();
        $caseId = $request->getParam(TabletsCasesModel::FORTABSKU);
        $sortId = $request->getParam(TabletsCasesModel::SORT);
        $sortParam = $request->getParam(TabletsCasesModel::SORTPARAM);

        $isInArray = in_array($sortParam, ['color', 'price', 'casesku']);
        if (!$isInArray) {
            $sortParam = 'price';
        }

        if ($this->tabletsCasesCollection === null) {
            /** @var SortOrder $sortOrder */
            try {
                if ($sortId != 1) {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField($sortParam)
                        ->setDirection(SortOrder::SORT_ASC)
                        ->create();
                } else {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField($sortParam)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }

                if ($caseId != 0) {
                    /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                    $searchCriteria = $this->searchCriteriaBuilder
                        ->addFilter(TabletsCasesModel::FORTABSKU, $caseId, 'eq')
                        ->addSortOrder($sortOrder)
                        ->create();
                } else {
                    /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                    $searchCriteria = $this->searchCriteriaBuilder->addSortOrder($sortOrder)->create();
                }

                /** @var SearchResults $searchResults */
                $searchResults = $this->tabletsCasesRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->tabletsCasesCollection = $searchResults->getItems();
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                $this->_logger->debug($error);
            }
        }

        return $this;
    }

    /**
     * @return float
     */
    public function getExternalCurrency()
    {
        return $this->externalApi->getExternalCurrency();
    }

    /**
     * @return \Alex\Fin\Model\ResourceModel\TabletsCases\Collection|null
     */
    public function getTabletsCasesCollection()
    {
        return $this->tabletsCasesCollection;
    }

    /**
     * @param string $key
     *
     * @return int
     */
    public function getSortParam(string $key)
    {
        $param = (int)$this->getRequest()->getParam($key);
        if ($param === 1) {
            return 0;
        }

        return 1;
    }

    /**
     * @param int $caseSku
     * @return bool
     */
    public function getCasePresent(int $caseSku)
    {
        return $this->tabletsCasesRepository->checkBySku($caseSku);
    }

    /**
     * @param int $tabSku
     * @return bool
     */
    public function getTabPresent(int $tabSku)
    {
        return $this->tabletsRepository->checkBySku($tabSku);
    }

    /**
     * @return string
     */
    public function getDeleteCaseAction()
    {
        return $this->getUrl('fin-route/index/deletecaseaction');
    }
}