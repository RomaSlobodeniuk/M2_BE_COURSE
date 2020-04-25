<?php

namespace Owner\TaskModul\Api\Data;

/**
 * Interface EngineInterface
 * @package Owner\TaskModul\Api\Data
 */
interface EngineInterface
{
    const ENTITY_ID = 'entity_id';

    const MANUFACTURER = 'manufacturer';

    const WIN = 'win';

    const POWER = 'power';

    const VOLUME = 'volume';

    const YEARS = 'years';

    const CREATED_AT = 'created_at';

    /**
     * Get engine entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get engine manufacturer
     *
     * @return string
     */
    public function getManufacturer();

    /**
     * Get engine win
     *
     * @return string
     */
    public function getWin();

    /**
     * Get engine power
     *
     * @return float
     */
    public function getPower();

    /**
     * Get engine volume
     *
     * @return float
     */
    public function getVolume();

    /**
     * Get engine years
     *
     * @return string
     */
    public function getYears();

    /**
     * Get created at date
     *
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * Set entity id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set engine manufacturer
     *
     * @param string $manufacturer
     * @return EngineInterface
     */
    public function setManufacturer(string $manufacturer): EngineInterface;

    /**
     * Set engine win
     *
     * @param string $win
     * @return EngineInterface
     */
    public function setWin(string $win): EngineInterface;

    /**
     * Set engine power
     *
     * @param float $power
     * @return EngineInterface
     */
    public function setPower(float $power): EngineInterface;

    /**
     * Set engine volume
     *
     * @param float $volume
     * @return EngineInterface
     */
    public function setVolume(float $volume): EngineInterface;

    /**
     * Set engine years
     *
     * @param string $years
     * @return EngineInterface
     */
    public function setYears(string $years): EngineInterface;

    /**
     * Set created at date
     *
     * @param string $createdAt
     * @return EngineInterface
     */
    public function setCreatedAt(string $createdAt): EngineInterface;
}
