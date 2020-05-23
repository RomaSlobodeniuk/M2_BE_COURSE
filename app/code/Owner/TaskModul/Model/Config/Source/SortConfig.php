<?php

namespace Owner\TaskModul\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class SortConfig
 * @package Owner\TaskModul\Model\Config\Source
 */
class SortConfig implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'ASC', 'label' => 'ASC'],
            ['value' => 'DESC', 'label' => 'DESC']
        ];
    }
}