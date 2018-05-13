<?php

namespace Humanswitch\Consentcookie\Model\Config\Source;

/**
 * Class Source
 * @package Humanswitch\Consentcookie\Model\Config\Source
 */
class Source implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'local', 'label' => __('Local')],
            ['value' => 'cdn', 'label' => __('CDN')]
        ];
    }
}