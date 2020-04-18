<?php

namespace Slayer\Mobile\Model;

use Magento\Framework\Model\AbstractModel;
use Slayer\Mobile\Api\Data\ManufacturerInterface;
use Slayer\Mobile\Model\ResourceModel\Manufacturer as ManufacturerResourceModel;

/**
 * Class ManufacturerModel
 */
class ManufacturerModel extends AbstractModel implements ManufacturerInterface
{
    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(ManufacturerResourceModel::class);
    }

    /**
     * GETTERS - це не обов'язково
     */

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
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getDirector()
    {
        return $this->getData(self::DIRECTOR);
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * {@inheritdoc}
     */
    public function getFoundationDate()
    {
        return $this->getData(self::FOUNDATION_DATE);
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
    public function setName(string $name): ManufacturerInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function setDirector(string $director): ManufacturerInterface
    {
        return $this->setData(self::DIRECTOR, $director);
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber(string $phoneNumber): ManufacturerInterface
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail(string $email): ManufacturerInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress(string $address): ManufacturerInterface
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * {@inheritdoc}
     */
    public function setFoundationDate(string $foundationDate): ManufacturerInterface
    {
        return $this->setData(self::FOUNDATION_DATE, $foundationDate);
    }
}
