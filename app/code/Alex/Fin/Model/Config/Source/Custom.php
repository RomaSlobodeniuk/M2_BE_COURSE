<?php

namespace Alex\Fin\Model\Config\Source;

/**
 * Class Custom
 * @package Alex\Fin\Model\Config\Source
 *
 * @deprecated 102.0.1 please use \Magento\Framework\Data\OptionSourceInterface instead.
 *
 * - так пише, якщо зайти в Magento\Framework\Option\ArrayInterface
 *
 * Винести в use інтерфейс, від якого будеш імплементувати клас
 */
class Custom implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve Custom Option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => '1'],
            ['value' => 3, 'label' => '3'],
            ['value' => 5, 'label' => '5'],
            ['value' => 10, 'label' => '10'],
            ['value' => 100, 'label' => '100']
        ];
    }
}