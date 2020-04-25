<?php

namespace Slayer\Mobile\Model;

use Magento\Framework\Model\AbstractModel;
use Slayer\Mobile\Api\Data\PhoneInterface;
use Slayer\Mobile\Model\ResourceModel\Phone as PhoneResourceModel;

/**
 * Class PhoneModel
 */
class PhoneModel extends AbstractModel implements PhoneInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(PhoneResourceModel::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getManufacturerId()
    {
        return $this->getData(self::MANUFACTURER_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getModel()
    {
        return $this->getData(self::MODEL);
    }

    /**
     * {@inheritdoc}
     */
    public function getOs()
    {
        return $this->getData(self::OS);
    }

    /**
     * {@inheritdoc}
     */
    public function getResolution()
    {
        return $this->getData(self::RESOLUTION);
    }

    /**
     * {@inheritdoc}
     */
    public function getRam()
    {
        return $this->getData(self::RAM);
    }

    /**
     * {@inheritdoc}
     */
    public function getCpu()
    {
        return $this->getData(self::CPU);
    }

    /**
     * {@inheritdoc}
     */
    public function getBattery()
    {
        return $this->getData(self::BATTERY);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function getReleased()
    {
        return $this->getData(self::RELEASED);
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoto()
    {
        return $this->getData(self::PHOTO);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function setManufacturerId(int $manufacturerId): PhoneInterface
    {
        return $this->setData(self::MANUFACTURER_ID, $manufacturerId);
    }

    /**
     * {@inheritdoc}
     */
    public function setModel(string $model): PhoneInterface
    {
        return $this->setData(self::MODEL, $model);
    }

    /**
     * {@inheritdoc}
     */
    public function setOs(string $os): PhoneInterface
    {
        return $this->setData(self::OS, $os);
    }

    /**
     * {@inheritdoc}
     */
    public function setResolution(string $resolution): PhoneInterface
    {
        return $this->setData(self::RESOLUTION, $resolution);
    }

    /**
     * {@inheritdoc}
     */
    public function setRam(string $ram): PhoneInterface
    {
        return $this->setData(self::RAM, $ram);
    }

    /**
     * {@inheritdoc}
     */
    public function setCpu(string $cpu): PhoneInterface
    {
        return $this->setData(self::CPU, $cpu);
    }

    /**
     * {@inheritdoc}
     */
    public function setBattery(string $battery): PhoneInterface
    {
        return $this->setData(self::BATTERY, $battery);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription(string $description): PhoneInterface
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setReleased(string $released): PhoneInterface
    {
        return $this->setData(self::RELEASED, $released);
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoto(string $photo): PhoneInterface
    {
        return $this->setData(self::PHOTO, $photo);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice(float $price): PhoneInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): PhoneInterface
    {
        try {
            $createdAtObject = new \DateTime($createdAt);
            return $this->setData(self::CREATED_AT, $createdAtObject->format('Y-m-d H:i:s'));
        } catch (\Exception $exception) {
            $this->_logger->debug($exception);

            /**
             * В даному методі ти обіцяєш щось повернути, а саме `PhoneInterface`,
             * але коли в тебе вистрелює виключення, то тут ти ніц нічого не повертаєш.
             * А це сумно :(
             */
        }
    }
}
