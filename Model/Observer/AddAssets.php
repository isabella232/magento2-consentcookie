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
 * Class AddAssets
 * @package Humanswitch\Consentcookie\Model\Observer
 */
class AddAssets implements ObserverInterface
{

    /**
     * @var \Humanswitch\Consentcookie\Helper\Config
     */
    private $helper;

    /**
     * addAssets constructor.
     * @param \Humanswitch\Consentcookie\Helper\Config $helper
     */
    public function __construct(
        \Humanswitch\Consentcookie\Helper\Config $helper
    ) {

        $this->helper = $helper;
    }

    /**
     * Add CDN or local assets for the configurator
     *
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        if ($this->helper->isEnabled($this->helper::CONFIG_CONFIGURATOR)) {

            /** @var \Magento\Framework\View\Layout $layout */
            $layout = $observer->getLayout();

            if (\in_array('adminhtml_system_config_edit', $layout->getUpdate()->getHandles(), true)) {
                if ($this->helper->getConfiguration('method', $this->helper::CONFIG_CONFIGURATOR) === 'cdn') {
                    $layout->getUpdate()->addUpdate('<head>
        <css src="//cdn.humanswitch.services/cc/configurator/configurator-app.css" src_type="url"/>
        <script src="//cdn.humanswitch.services/cc/configurator/configurator-manifest.js" src_type="url"/>
        <script src="//cdn.humanswitch.services/cc/configurator/configurator-vendor.js" src_type="url"/>
        <script src="//cdn.humanswitch.services/cc/configurator/configurator-app.js" src_type="url"/>
        </head>');
                } else {
                    $layout->getUpdate()->addUpdate('<head>
        <css src="Humanswitch_Consentcookie::consentcookie/configurator-app.css"/>
        <script src="Humanswitch_Consentcookie::consentcookie/configurator-manifest.js"/>
        <script src="Humanswitch_Consentcookie::consentcookie/configurator-vendor.js"/>
        <script src="Humanswitch_Consentcookie::consentcookie/configurator-app.js"/>
        </head>');
                }
            }
        }
    }
}
