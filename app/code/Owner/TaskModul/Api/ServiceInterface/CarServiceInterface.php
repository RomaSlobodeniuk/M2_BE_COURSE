<?php

namespace Owner\TaskModul\Api\ServiceInterface;

use Owner\TaskModul\Api\Data\CarInterface;

/**
 * Interface CarServiceInterface
 * @package Owner\TaskModul\Api\ServiceInterface
 */
interface CarServiceInterface
{
    /**
     * @return mixed
     */
    public function getCarList();

    /**
     * @param int $carId
     * @return mixed
     */
    public function getCarById($carId);

    /**
     * @param int $carId
     * @return mixed
     */
    public function deleteCarById(int $carId);

    /**
     * @param CarInterface $car
     * @return mixed
     */
    public function saveOrUpdate(CarInterface $car);
}
