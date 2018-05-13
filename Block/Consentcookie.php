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

namespace Humanswitch\Consentcookie\Block;

/**
 * Class Consentcookie
 * @package Humanswitch\Consentcookie\Block
 */
class Consentcookie extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Humanswitch\Consentcookie\Helper\Config $helper
     */
    protected $helper;

    /**
     * Consentcookie constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Humanswitch\Consentcookie\Helper\Config $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Humanswitch\Consentcookie\Helper\Config $helper
    )
    {
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * Whether consentcookie is enabled.
     *
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->helper->isEnabled();
    }

    /**
     * @return bool
     */
    public function canOverrideAnalytics()
    {
        return $this->helper->getOverrideAnalytics();
    }

    /**
     * @return bool|mixed
     */
    public function getConsentCookieConfiguration()
    {
        return $this->helper->getConsentCookieConfiguration();
    }

    /**
     * Gets local or CDN script source
     *
     * @return mixed|string
     */
    public function getScriptSource()
    {
        $source = 'Humanswitch_Consentcookie/consentcookie/consentcookie';
        if ($this->helper->getConfiguration('method') === 'cdn') {
            $cdnUrl = $this->helper->getConfiguration('cdn_url');
            if(\strlen($cdnUrl) > 0){
                return $cdnUrl;
            }
        }
        return $source;
    }
}