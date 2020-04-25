<?php

namespace Owner\TaskModul\Api\ServiceInterface;

/**
 * Interface CarServiceInterface
 * @package Owner\TaskModul\Api\ServiceInterface
 *
 * До даного інтерфейсу немає відповідної йому реалізації, звідки знаю? -
 * А це видно в di.xml - там тільки 4 преференса, на цей немає
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
