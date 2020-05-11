<?php

namespace Roma\Game\ViewModel;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Api\GameRepositoryInterface;

/**
 * Verification of game with its game id
 *
 * Class GameLicense
 */
class GameLicense implements ArgumentInterface
{
    /**
     * @var GameRepositoryInterface
     */
    protected $gameList;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param GameRepositoryInterface $gameList
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        GameRepositoryInterface $gameList,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->gameList = $gameList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param $id
     * @return string
     */
    public function checkLicenseGame($id)
    {
        if ($id === null) {
            $answer = 'Something wrong. Try latter';
        } else {
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(GameInterface::GAME_ID, $id)
                ->create();

            $data = $this->gameList->getList($searchCriteria);
            $answer = 'Your game is a pirate copy. You can buy a licensed game in this store';
            if ($data->getTotalCount() > 0) {
                $answer = 'Your game is licensed and purchased from this store';
            }
        }

        return $answer;
    }
}