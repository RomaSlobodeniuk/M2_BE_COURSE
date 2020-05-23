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
     * @inheritdoc
     */
    public function getCarList()
    {
        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->create();

        /** @var SearchResultsInterface $searchResult */
        $searchResult = $this->carRepository->getList($searchCriteria);
        $result = [];
        if ($searchResult->getTotalCount() > 0) {
            foreach ($searchResult->getItems() as $item) {
                /** @var CarInterface $item */
                $result[] = [
                    'entity_id' => $item->getId(),
                    'brand' => $item->getBrand(),
                    'model' => $item->getModel(),
                    'engine_id' => $item->getEngineId(),
                    'price' => $item->getPrice(),
                    'years' => $item->getYears(),
                    'created_at' => $item->getCreatedAt()
                ];
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getCarById($carId)
    {
        $result = [];
        if (empty($carId)) {
            return 'empty param';
        }

        try {
            /** @var CarInterface $item */
            $item = $this->carRepository->getById($carId);
            if ($item->getId()) {
                $result[] = [
                    'entity_id' => $item->getId(),
                    'brand' => $item->getBrand(),
                    'model' => $item->getModel(),
                    'engine_id' => $item->getEngineId(),
                    'price' => $item->getPrice(),
                    'years' => $item->getYears(),
                    'created_at' => $item->getCreatedAt()
                ];
            }
        } catch (\Exception $exception) {
            return sprintf('Could not get car, error: %s', $exception->getMessage());
        }

        if (empty($result)) {
            return sprintf('Could not find car (%s)', $carId);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function deleteCarById(int $carId)
    {
        try {
            $this->carRepository->deleteById($carId);
            $message = sprintf('Engine (%s) has been deleted!', $carId);
        } catch (\Exception $exception) {
            $message = sprintf('Could not delete engine (%s)', $carId);
        }

        return $message;
    }

    /**
     * @inheritdoc
     */
    public function saveOrUpdate(CarInterface $car)
    {
        try {
            $newCar = $this->carRepository->save($car);
            if ($car->getId() > 0) {
                $message = sprintf('Success, car has been found and updated, id is: %s', $newCar->getId());
            } else {
                $message = sprintf('Success, new car has been created, id is: %s', $newCar->getId());
            }
        } catch (\Exception $exception) {
            $message = sprintf('Could not save car: %s', $exception->getMessage());
        }

        return $message;
    }

}