<?php

namespace Roma\Test\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Test\Model\ResourceModel\CarCustomer as CarResourceModel;

/**
 * Class CarCustomerModel
 */
class CarCustomerModel extends AbstractModel
{
    const ENTITY_ID = 'entity_id';

    const EMAIL = 'email';

    const SOME_ID = 'some_id';

    const NAME = 'name';

    const CREATED_AT = 'created_at';

    /**
     * {@inheritdoc}
     */
    public function _construct()
    {
        $this->_init(CarResourceModel::class);
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
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function getSomeId()
    {
        return (int)$this->getData(self::SOME_ID);
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
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * {@inheritdoc}
     */
    public function setSomeId($someId)
    {
        return $this->setData(self::SOME_ID, $someId);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt->format('Y-m-d H:i:s'));
    }

    /**
     * {@inheritdoc}
     */
    public function getDateArray()
    {
        $dateArray = [
            'month' => '',
            'day' => '',
            'date' => '',
            'year' => '',
        ];
        if ($date = $this->getCalendarDate()) {
            $dateArray['month'] = date('F', strtotime($date));
            $dateArray['day'] = date('l', strtotime($date));
            $dateArray['date'] = date('d', strtotime($date));
            $dateArray['year'] = date('Y', strtotime($date));
        }

        return $dateArray;
    }
}