<?php
/**
 *    Copyright 2018 Humanswitch
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */

namespace Humanswitch\Consentcookie\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class RemoveBlock
 * @package Humanswitch\Consentcookie\Model\Observer
 */
class ReplaceTemplate implements ObserverInterface
{

    /**
     * @var \Humanswitch\Consentcookie\Helper\Config
     */
    private $helper;

    /**
     * ReplaceTemplate constructor.
     * @param \Humanswitch\Consentcookie\Helper\Config $helper
     */
    public function __construct(
        \Humanswitch\Consentcookie\Helper\Config $helper
    ) {
    
        $this->helper = $helper;
    }

    /**
     * Replace GA template
     *
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        if ($this->helper->isEnabled() && $this->helper->getOverrideAnalytics()) {
            $block = $observer->getLayout()->getBlock('google_analytics');

            if ($block) {
                $block->setTemplate('Humanswitch_Consentcookie::ga.phtml');
            }
        }
    }
}
