<?php

namespace Owner\TaskModul\Model\Service;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Owner\TaskModul\Api\Data\CarInterface;
use Owner\TaskModul\Api\RepositoryInterface\CarRepositoryInterface;
use Owner\TaskModul\Api\ServiceInterface\CarServiceInterface;

/**
 * Class CarService
 * @package Owner\TaskModul\Model\Service
 */
class CarService implements CarServiceInterface
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
     * @(@inheritDoc)
     */
    public function getCarList()
    {

    }

    /**
     * @(@inheritDoc)
     */
    public function getCarListByEngineId($engineId)
    {
    }

    /**
     * @(@inheritDoc)
     */
    public function deleteCarById(int $carId)
    {
        // TODO: Implement deleteCarById() method.
    }


    /**
     * @param int|null $engineId
     * @return array
     */
    private function prepareList($engineId = null)
    {
        $resultArray = [];
        try {

            /** @var SearchCriteria $searchCriteria */
            if ($engineId > 0) {
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter(
                        CarInterface::ENGINE_ID,
                        $engineId,
                        'eq'
                    )
                    ->create();
            } else {
                $searchCriteria = $this->searchCriteriaBuilder->create();
            }

            /** @var SearchResultsInterface $searchResults */
            $searchResults = $this->carRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                foreach ($searchResults->getItems() as $item) {

                    /** @var CarInterface $item */
                    $resultArray[] = [
                        'id' => $item->getId(),
                        'brand' => $item->getBrand(),
                        'model' => $item->getModel(),
                        'engine_id' => $item->getEngineId(),
                        'price' => $item->getPrice(),
                        'years' => $item->getYears(),
                        'created_at' => $item->getCreatedAt()
                    ];
                }
            }
        } catch (\Exception $exception) {
            // logging
        }

        return $resultArray;
    }

}