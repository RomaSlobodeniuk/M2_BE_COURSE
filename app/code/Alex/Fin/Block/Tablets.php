<?php

namespace Alex\Fin\Block;

use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\ResourceModel\Tablets\Collection as TabletsCollection;
use Alex\Fin\Model\ResourceModel\Tablets\CollectionFactory as TabletsCollectionFactory;
use Alex\Fin\Model\TabletsModel;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;

/**
 * Class Tablets
 */
class Tablets extends Template
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var TabletsCollectionFactory
     */
    private $tabletsCollectionFactory;

    /**
     * @var TabletsCollection|null
     */
    private $tabletsCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param LoggerInterface $logger
     * @param TabletsCollectionFactory $tabletsCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param ManagerInterface $messageManager
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger,
        TabletsCollectionFactory $tabletsCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        ManagerInterface $messageManager,
        TabletsRepositoryInterface $tabletsRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
        $this->tabletsCollectionFactory = $tabletsCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->tabletsRepository = $tabletsRepository;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * Preparing global layout
     * @return $this
     */
    protected function _prepareLayout()
    {
        $request = $this->getRequest();
        $sortId = (int)$request->getParam(TabletsModel::SORT);
        if ($this->tabletsCollection === null) {
            try {
                /** @var SortOrder $sortOrder */
                if ($sortId != 1) {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(TabletsInterface::PRICE)
                        ->setDirection(SortOrder::SORT_ASC)
                        ->create();
                } else {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(TabletsInterface::PRICE)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }

                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addSortOrder($sortOrder)
                    ->create();

                /** @var SearchResults $searchResults */
                $searchResults = $this->tabletsRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->tabletsCollection = $searchResults->getItems();
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                $this->_logger->debug($error);
            }
        }

        return $this;
    }

    /**
     * @return TabletsCollection|null
     */
    public function getTabletsCollection()
    {
        return $this->tabletsCollection;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        $this->_eventManager->dispatch('tablet_applyFilter_before');
        return $this->scopeConfig->getValue(
            'alex_fin/settings/quantity',
            $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            $scopeCode = null
        );
    }

    /**
     * @return int
     */
    public function getSortParam()
    {
        $param = (int)$this->getRequest()->getParam(TabletsModel::SORT);
        if ($param === 1) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * @param int $tablet
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCasesQuantity($tablet)
    {
        return $this->tabletsCasesRepository->getCasesQuantity($tablet);
    }

    /**
     * @return mixed
     */
    public function getTabletActionUrl()
    {
        return $this->getUrl('fin-route/index/newtabletcreation');
    }
}