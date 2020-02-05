<?php

namespace Roma\Test\Model;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Roma\Test\Api\CarRepositoryInterface;
use Roma\Test\Api\CarsServiceInterface;
use Roma\Test\Api\Data\CarInterface;

/**
 * Class CarsService
 */
class CarsService implements CarsServiceInterface
{
    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param CarRepositoryInterface $carRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CarRepositoryInterface $carRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->carRepository = $carRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getCarsList()
    {
        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->create();
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->carRepository->getList($searchCriteria);
        $resultArray = [];
        if ($searchResults->getTotalCount() > 0) {
            foreach ($searchResults->getItems() as $item) {
                /** @var CarInterface $item */
                $resultArray[] = [
                      'id' => $item->getId(),
                      'car_id' => $item->getCarId(),
                      'description' => $item->getDescription(),
                      'user_id' => $item->getUserId(),
                      'created_at' => $item->getCreatedAt(),
                      'price' => $item->getPrice()
                ];
            }
        }

        return $resultArray;
    }

    /**
     * @inheritdoc
     */
    public function getCarsListByUserId($userId)
    {
        if (empty($userId)) {
            return false;
        }

        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CarInterface::USER_ID, $userId)
            ->create();
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->carRepository->getList($searchCriteria);
        $resultArray = [];
        if ($searchResults->getTotalCount() > 0) {
            foreach ($searchResults->getItems() as $item) {
                /** @var CarInterface $item */
                $resultArray[] = [
                    'id' => $item->getId(),
                    'car_id' => $item->getCarId(),
                    'description' => $item->getDescription(),
                    'user_id' => $item->getUserId(),
                    'created_at' => $item->getCreatedAt(),
                    'price' => $item->getPrice()
                ];
            }
        }

        return $resultArray;
    }
}
