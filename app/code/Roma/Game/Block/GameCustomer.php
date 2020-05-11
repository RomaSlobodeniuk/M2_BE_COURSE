<?php

namespace Roma\Game\Block;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Psr\Log\LoggerInterface;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Api\GameCustomerRepositoryInterface;
use Roma\Game\Model\ResourceModel\GameCustomer\Collection as GameCustomerCollection;
use Roma\Game\Model\ResourceModel\GameCustomer\CollectionFactory as GameCustomerCollectionFactory;
use Roma\Game\ViewModel\CreateEvents;
use Roma\Game\ViewModel\GetConfig;

/**
 * For getting customers collection from database
 *
 * Class GameCustomer
 */
class GameCustomer extends Template
{
    /**
     * @var GameCustomerCollectionFactory
     */
    private $gameCustomerCollectionFactory;

    /**
     * @var GameCustomerCollection|null
     */
    private $gameCustomerCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var GetConfig
     */
    private $config;

    /**
     * @var GameCustomerRepositoryInterface
     */
    private $gameCustomerRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CreateEvents $event
     */
    private $event;

    const GAME_ACTION_ROUTE = 'game_route/index/games';

    /**
     * @param Context $context
     * @param GameCustomerCollectionFactory $gameCustomerCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GameCustomerRepositoryInterface $gameCustomerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param LoggerInterface $logger
     * @param GetConfig $config
     * @param CreateEvents $event
     * @param array $data
     */
    public function __construct(Context $context,
                                GameCustomerCollectionFactory $gameCustomerCollectionFactory,
                                SearchCriteriaBuilder $searchCriteriaBuilder,
                                GameCustomerRepositoryInterface $gameCustomerRepository,
                                SortOrderBuilder $sortOrderBuilder,
                                LoggerInterface $logger,
                                GetConfig $config,
                                CreateEvents $event,
                                array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->gameCustomerCollectionFactory = $gameCustomerCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->gameCustomerRepository = $gameCustomerRepository;
        $this->event = $event;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        $gameCustomerSortDirection = null;
        $gameCustomerSortFiled = null;
        try {
            /** @var Http $request */
            // http like it: http://magento2.test/game-route/index/index/sortDirection/ASC/sortField/name
            $request = $this->getRequest();
            $gameCustomerSortDirection = $request->getParam('sortDirection');
            $gameCustomerSortFiled = $request->getParam('sortField');
            if ($gameCustomerSortDirection === null) {
                $gameCustomerSortDirection = $this->config->getSortOrder();
            }

            if ($gameCustomerSortFiled === null) {
                $gameCustomerSortFiled = $this->config->getSortFiled();
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot get sort direction and sort filed, message: "' . $exception->getMessage() . '"');
        }
        
        if ($this->gameCustomerCollection === null) {
            $sortOrder = $this->sortOrderBuilder
                ->setField($gameCustomerSortFiled)
                ->setDirection($gameCustomerSortDirection)
                ->create();

            /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addSortOrder($sortOrder)
                ->create();

            /** @var SearchResults $searchResults */
            $searchResults = $this->gameCustomerRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                $this->gameCustomerCollection = $searchResults->getItems();
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return GameCustomerCollection|null
     */
    public function getGameCustomersCollection()
    {
        $this->event->getGameCustomerCollection($this->gameCustomerCollection);
        return $this->gameCustomerCollection;
    }

    /**
     * @param $customerId
     * @return string
     */
    public function getGameCustomerUrl($customerId)
    {
        $this->event->getGameCustomerId($customerId);
        return $this->getUrl(
            self::GAME_ACTION_ROUTE,
            [
                GameInterface::GAME_CUSTOMER_ID => $customerId
            ]
        );
    }
}