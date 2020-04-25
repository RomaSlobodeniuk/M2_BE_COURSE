<?php

namespace Owner\TaskModul\Model\Config\Source;

/**
 * Class SortConfig
 *
 * @deprecated 102.0.1 please use \Magento\Framework\Data\OptionSourceInterface instead.
 *
 * - так пише, якщо зайти в Magento\Framework\Option\ArrayInterface
 *
 * Винести в use інтерфейс, від якого будеш імплементувати клас
 */
class SortConfig implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Що тут повинно бути?
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'ASC', 'label' => 'ASC'],
            ['value' => 'DESC', 'label' => 'DESC']
        ];
    }
}