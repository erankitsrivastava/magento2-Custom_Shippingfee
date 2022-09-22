<?php

namespace Custom\Shippingfee\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Listing extends Container
{
    /**
     * @var string
     */
    protected $_template = 'Custom_Shippingfee::getgrid.phtml';

    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        $this->_controller = 'adminhtml_shippingfee';
        $this->_blockGroup = 'shippingfee';
        $this->_headerText = __('Manage Shipping Fees');
        $this->_addButtonLabel = __('Add New Fee');
        parent::__construct($context, $data);
    }

    
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock(
                'Custom\Shippingfee\Block\Adminhtml\Listing\Grid',
                'custom.shippingfee.grid'
            )
        );
        return parent::_prepareLayout();
    }

   

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
