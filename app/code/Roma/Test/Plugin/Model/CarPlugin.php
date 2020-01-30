<?php

namespace Roma\Test\Plugin\Model;

use Roma\Test\Api\Data\CarInterface;

/**
 * Class CarPlugin
 */
class CarPlugin
{
    /**
     * @param CarInterface $subject
     * @return array
     */
    public function beforeGetDescription(CarInterface $subject)
    {
        echo "\r\n" . 'Before Get Decription' . "\r\n";
        return [];
    }

    /**
     * @param CarInterface $subject
     * @param string $result
     * @return string
     */
    public function afterGetDescription(CarInterface $subject, $result)
    {
        return $result . ' - after!';
    }
}
