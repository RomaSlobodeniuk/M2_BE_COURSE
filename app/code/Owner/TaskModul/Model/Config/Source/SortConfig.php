<?php

namespace Owner\TaskModul\Model\Config\Source;

class SortConfig implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'ASC', 'label' => 'ASC'],
            ['value' => 'DESC', 'label' => 'DESC']
        ];
    }
}