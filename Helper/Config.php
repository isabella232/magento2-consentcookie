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

namespace Humanswitch\Consentcookie\Helper;

/**
 * Class Config
 * @package Humanswitch\Consentcookie\Helper
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * Consentcookie configuration path
     */
    CONST CONFIG_CC = 'consentcookie/general';

    /**
     * Gets settings from system configuration
     *
     * @param bool $field
     * @param null $scopeCode
     * @return mixed
     */
    public function getSettings($field = false, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::CONFIG_CC . ($field ? '/' . $field : ''), \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    /**
     * Checks whether consentcookie is enabled.
     *
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->getSettings('enable');
    }

    /**
     * Gets the configuration.
     *
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->getSettings('configuration');
    }

    /**
     * Gets if Analytics can be overridden
     *
     * @return bool
     */
    public function getOverrideAnalytics()
    {
        return $this->getSettings('override_analytics');
    }

    /**
     * Validates whether the configuration is proper JSON.
     *
     * @todo validate against JSON schema
     *
     * @param null $configuration
     * @return bool
     */
    public function validateJSONConfiguration($configuration = null)
    {
        if ($configuration === null) {
            $configuration = $this->getConfiguration();
        }

        if ($configuration) {
            json_decode($this->getConfiguration());
            if (json_last_error() === JSON_ERROR_NONE) {
                return true;
            }
            $this->_logger->error('The ConsentCookie JSON configuration is invalid.');
        }
        return false;
    }

}