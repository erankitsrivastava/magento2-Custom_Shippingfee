<?php


namespace Custom\Shippingfee\Block\Adminhtml\Shippingfee;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * @var Registry
     */
    protected $frameworkRegistry;

    public function __construct(Registry $frameworkRegistry,\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        parent::__construct($context, $data);

        $this->frameworkRegistry = $frameworkRegistry;
    }

    public function _construct()
    {
        parent::_construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'Custom_Shippingfee';
        $this->_controller = 'adminhtml_shippingfee';


        $this->buttonList->update('save', 'label', __('Save Item'));
        $this->buttonList->update('delete', 'label', __('Delete Item'));
    }

    public function getHeaderText()
    {
        if ($this->frameworkRegistry->registry('shipping_data')->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($this->frameworkRegistry->registry('shipping_data')->getTitle()));
        } else {
            return __('New Item');
        }
    }
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'content');
                }
            };
        ";
        return parent::_prepareLayout();
    }
}
