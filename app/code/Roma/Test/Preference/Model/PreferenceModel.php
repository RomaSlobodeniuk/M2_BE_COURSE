<?php

namespace Roma\Test\Preference\Model;

use Roma\Test\Model\CarCustomerModel;

/**
 * Class PreferenceModel
 */
class PreferenceModel extends CarCustomerModel
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'FromPreference: ' . $this->getData(self::NAME);
    }
}