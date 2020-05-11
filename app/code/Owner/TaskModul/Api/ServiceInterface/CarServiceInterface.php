<?php

namespace Owner\TaskModul\Api\ServiceInterface;

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
     * @param int $engineId
     * @return mixed
     */
    public function getCarListByEngineId($engineId);

    /**
     * @param int $carId
     * @return mixed
     */
    public function deleteCarById(int $carId);
}
