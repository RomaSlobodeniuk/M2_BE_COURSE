<?php

namespace Roma\Game\Block;

use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Game\Model\GameModel;
use Roma\Game\Model\ResourceModel\Game\Collection as GameCollection;
use Roma\Game\Model\ResourceModel\Game\CollectionFactory as GameCollectionFactory;
use Roma\Game\ViewModel\CreateEvents;

/**
 * For getting game collection from database
 *
 * Class Games
 */
class Games extends Template
{
    /**
     * @var GameCollectionFactory
     */
    private $gameCollectionFactory;

    /**
     * @var GameCollection|null
     */
    private $gameCollection;

    /**
     * @var CreateEvents
     */
    private $eventMaker;

    /**
     * @param Context $context
     * @param CreateEvents $createEvents
     * @param GameCollectionFactory $gameCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CreateEvents $createEvents,
        GameCollectionFactory $gameCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->eventMaker=$createEvents;
        $this->gameCollectionFactory = $gameCollectionFactory;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var Http $request */
        $request = $this->getRequest();
        $gameCustomerId = (int)$request->getParam(GameModel::GAME_CUSTOMER_ID);
        if ($gameCustomerId > 0 && $this->gameCollection === null) {
            $this->gameCollection = $this->gameCollectionFactory->create();
            $this->gameCollection->addFieldToFilter(
                GameModel::GAME_CUSTOMER_ID,
                ['eq' => $gameCustomerId]
            );
        }

        return parent::_prepareLayout();
    }

    /**
     * @return GameCollection|null
     */
    public function getGameCollection()
    {
        $this->eventMaker->getGetGameCollection($this->gameCollection);
        return $this->gameCollection;
    }
}