<?php

namespace Roma\Game\Block;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Api\GameCustomerRepositoryInterface;
use Roma\Game\Model\ResourceModel\GameCustomer\Collection as GameCustomerCollection;
use Roma\Game\Model\ResourceModel\GameCustomer\CollectionFactory as GameCustomerCollectionFactory;
use Roma\Game\ViewModel\CreateEvents;
use Roma\Game\ViewModel\GetConfig;

/**
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
     * А тут що ?
     */
    private $logger;

    /**
     * @var CreateEvents $event
     */
    private $event;

    const GAME_ACTION_ROUTE = 'game_route/index/games';

    /**
     * Game Customer constructor. - не критично, але лишнє
     * @param Context $context
     * @param GameCustomerCollectionFactory $gameCustomerCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GameCustomerRepositoryInterface $gameCustomerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param \Psr\Log\LoggerInterface $logger - це треба було винести в use
     * @param GetConfig $config
     * @param CreateEvents $event
     * @param array $data
     */
    public function __construct(Context $context,
        GameCustomerCollectionFactory $gameCustomerCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        GameCustomerRepositoryInterface $gameCustomerRepository,
        SortOrderBuilder $sortOrderBuilder, \Psr\Log\LoggerInterface $logger, // форматування
        GetConfig $config,
        CreateEvents $event,
        array $data = []
    ) {
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
        /**
         * Форматування ріже мені очі
         */
        $gameCustomerSortDirection=Null; // використовуй просто null, а то тут то Null, то NULL
        $gameCustomerSortFiled=Null;
        try {
            /** @var \Magento\Framework\App\Request\Http $request */
            // http like it: http://magento2.test/game-route/index/index/sortDirection/ASC/sortField/name
            $request = $this->getRequest();
            $gameCustomerSortDirection = $request->getParam('sortDirection');
            $gameCustomerSortFiled = $request->getParam('sortField');
            if($gameCustomerSortDirection==NULL) $gameCustomerSortDirection=$this->config->getSortOrder();;
            if($gameCustomerSortFiled==NULL)$gameCustomerSortFiled=$this->config->getSortFiled();
        } catch (\Exception $e) {
        $this->logger->critical($e->getMessage());
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
        $this->event->get_game_customer_collection($this->gameCustomerCollection);
        return $this->gameCustomerCollection;
    }

    /**
     * @param $customerId
     * @return string
     */
    public function getGameCustomerUrl($customerId)
    {
        $this->event->see_customer_games_event();
        return $this->getUrl(
            self::GAME_ACTION_ROUTE,
            [
                GameInterface::GAME_CUSTOMER_ID => $customerId
            ]
        );
    }
}