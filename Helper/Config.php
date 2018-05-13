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
     * ConsentCookie general settings path
     */
    const CONFIG_GENERAL = 'consentcookie/general';

    /**
     * ConsentCookie configurator settings path
     */
    const CONFIG_CONFIGURATOR = 'consentcookie/configurator_settings';

    /**
     * Get extension configurations
     *
     * @param $field
     * @param string $area
     * @param null $scopeCode
     * @return mixed
     */
    public function getConfiguration($field, $area = self::CONFIG_GENERAL, $scopeCode = null)
    {
        return $this->scopeConfig->getValue($area . ($field ? '/' . $field : ''), \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $scopeCode);
    }

    /**
     * Checks whether consentcookie is enabled.
     *
     * @param string $area
     * @param null $scopeCode
     * @return mixed
     */
    public function isEnabled($area = self::CONFIG_GENERAL, $scopeCode = null)
    {
        return $this->getConfiguration('enable', $area, $scopeCode);
    }

    /**
     * Gets if Analytics can be overridden
     *
     * @return bool
     */
    public function getOverrideAnalytics()
    {
        return $this->getConfiguration('override_analytics');
    }

    /**
     * Get CC configuration from system config
     *
     * @param bool $validateJson
     * @param null $scopeCode
     * @return bool|mixed
     */
    public function getConsentCookieConfiguration($validateJson = true, $scopeCode = null)
    {
        $configuration = $this->getConfiguration('configuration', self::CONFIG_CONFIGURATOR, $scopeCode);

        if ($validateJson && !$this->validateConsentCookieConfiguration($configuration)) {
            return false;
        }

        return $configuration;
    }

    /**
     * Validates JSON format
     *
     * @todo validate schema
     *
     * @param null $configuration
     * @return bool|mixed|null
     */
    public function validateConsentCookieConfiguration($configuration = null)
    {
        if ($configuration === null) {
            $configuration = $this->getConsentCookieConfiguration(false);
        }

        json_decode($configuration);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $configuration;
        }

        $this->_logger->error('The ConsentCookie JSON configuration is invalid.');
        return false;
    }

    /**
     * Validate the configuration against the schema
     *
     * @todo add schema validation using JsonSchema\Validator
     *
     * @return bool
     */
    public function validateSchema()
    {
        return true;
    }
}
