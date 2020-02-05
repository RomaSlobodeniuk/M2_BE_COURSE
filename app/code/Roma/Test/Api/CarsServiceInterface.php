<?php

namespace Roma\Test\Api;

/**
 * Interface CarsServiceInterface
 */
interface CarsServiceInterface
{
    /**
     * @return mixed
     */
    public function getCarsList();

    /**
     * @param int $userId
     * @return mixed
     */
    public function getCarsListByUserId($userId);
}
