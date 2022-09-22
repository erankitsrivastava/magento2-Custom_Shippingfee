<?php

namespace Custom\Shippingfee\Block\Adminhtml\Shippingfee\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Catalog\Model\Product;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Eav\Model\ConfigFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Form as DataForm;
use Magento\Framework\Registry;

class General extends Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var Config
     */
    protected $wysiwygConfig;

    /**
     * @var Registry
     */
    protected $frameworkRegistry;

    /**
     * @var ConfigFactory
     */
    protected $modelConfigFactory;

    public function __construct(
        Config $wysiwygConfig,
        Registry $frameworkRegistry,
        ConfigFactory $modelConfigFactory,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupCollection,  
        \Magento\Shipping\Model\Config\Source\Allmethods $allShippingMethods,
        \Magento\Store\Model\System\Store $systemStore,
        \Custom\Shippingfee\Model\ShippingfeeFactory $shippingfeeFactory,
        array $data = []
    ) {
        $this->wysiwygConfig = $wysiwygConfig;
        $this->frameworkRegistry = $frameworkRegistry;
        $this->modelConfigFactory = $modelConfigFactory;
        $this->customerGroupCollection = $customerGroupCollection;   
        $this->allShippingMethods = $allShippingMethods;   
        $this->systemStore = $systemStore;   
        $this->shippingfeeFactory = $shippingfeeFactory;   
        parent::__construct($context, $registry, $formFactory, $data);
    }


    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm(){



        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $this->setForm($form);
        $fieldset = $form->addFieldset('package_form', ['legend'=>__('Payment Fee Information')]);

        $fieldset->addField('fee_label', 'text', [
            'label'     => __('Fee Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'fee_label',
        ]);


        $fieldset->addField('active', 'select', [
            'label'     => __('Status'),
            'name'      => 'active',
            'class'     => 'required-entry',
            'required'  => true,
            'values'    => [

                [
                    'value'     => 0,
                    'label'     => __('Inactive'),
                ],
                [
                    'value'     => 1,
                    'label'     => __('Active'),
                ],

            ],
        ]);

        $fieldset->addField('fee_amount', 'text', [
            'label'     => __('Amount'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'fee_amount',
        ]);

        $fieldset->addField('fee_type', 'select', [
            'label'     => __('Fee Type'),
            'name'      => 'fee_type',
            'class'     => 'required-entry',
            'required'  => true,
            'values'    => [

                [
                    'value'     => 'percent',
                    'label'     => __('Percent'),
                ],
                [
                    'value'     => 'fixed',
                    'label'     => __('Fixed'),
                ],

            ],
        ]);

         $fieldset->addField('allowed_shipping_methods', 'multiselect', [
            'label'     => __('Shipping Methods'),
            'name'      => 'allowed_shipping_methods',
            'class'     => 'required-entry',
            'required'  => true,
            'values'  => $this->getAllShippingMethods(),
           
        ]);

         $fieldset->addField(
                'store',
                'multiselect',
                [
                    'name' => 'store[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->systemStore->getStoreValuesForForm(false, true)
                ]
            );

        $fieldset->addField('customer_group', 'multiselect', [
            'label'     => __('Customer Group'),
            'name'      => 'customer_group',
            'class'     => 'required-entry',
            'required'  => true,
            'values'  => $this->getAllCustomerGroups(),
           
        ]);

       

        $shippingId = $this->getRequest()->getParam('id');

        if($shippingId){
            $model = $this->shippingfeeFactory->create()->load($shippingId);
            $form->setValues($model->getData());
            $this->setForm($form);
        }

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
    public function getAvailableStatuses()
    {
        return [1 => __('Enabled'), 2 => __('Disabled')];
    }
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getAllCustomerGroups() {
        return $this->customerGroupCollection->toOptionArray();
        
    }

     public function getAllShippingMethods()
    {
        return $this->allShippingMethods->toOptionArray();
    }
}
