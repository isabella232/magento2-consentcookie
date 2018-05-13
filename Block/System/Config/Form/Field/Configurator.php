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

namespace Humanswitch\Consentcookie\Block\System\Config\Form\Field;

use Magento\Backend\Block\AbstractBlock;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Backend\Block\Context;

/**
 * Class Configurator
 * @package Humanswitch\Consentcookie\Block\System\Config\Form\Field
 */
class Configurator extends AbstractBlock implements RendererInterface
{

    private $template = 'Humanswitch_Consentcookie::configurator.phtml';

    /**
     * @var LayoutFactory
     */
    private $viewLayoutFactory;

    /**
     * Configurator constructor.
     * @param Context $context
     * @param LayoutFactory $viewLayoutFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        LayoutFactory $viewLayoutFactory,
        array $data = []
    ) {
    
        $this->viewLayoutFactory = $viewLayoutFactory;

        parent::__construct($context, $data);
    }

    /**
     * Render form element as HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->viewLayoutFactory->create()->createBlock('Humanswitch\Consentcookie\Block\Configurator')
            ->setTemplate($this->template)
            ->toHtml();
    }
}
