<?php

namespace Custom\Shippingfee\Block\Adminhtml\Shippingfee\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\Form as DataForm;
use Magento\Framework\View\LayoutFactory;

class Form extends Generic
{
    /**
     * @var Config
     */
    protected $wysiwygConfig;

    /**
     * @var LayoutFactory
     */
    protected $viewLayoutFactory;

    public function __construct(
        Config $wysiwygConfig,
        LayoutFactory $viewLayoutFactory,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = [])
    {
        $this->wysiwygConfig = $wysiwygConfig;
        $this->viewLayoutFactory = $viewLayoutFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }


    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->wysiwygConfig->isEnabled() && $this->getLayout()->getBlock('head')) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' =>
                [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
