<?php

namespace Custom\Shippingfee\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class Status extends AbstractRenderer
{
    private $_storeManager;
   
    public function __construct(
        \Magento\Backend\Block\Context $context, 
        array $data = [])
    {
       
        parent::__construct($context, $data);
    }
    
    public function render(DataObject $row)
    {

        if($this->getColumn()->getIndex()=='active'){
            $value = $row->getData($this->getColumn()->getStatus());
            return '<p style="text-align:center;padding: 5px 10px; color:#FFF;font-weight:bold;background:#10a900;border-radius:5px;width:100%" >Active</p>';
        }else{
            $value = $row->getData($this->getColumn()->getIndex());
            return '<p style="text-align:center;padding: 5px 10px; color:#FFF;font-weight:bold;background:#ff031b;border-radius:5px;width:100%" >Inactive</p>';
        }
        
    }
}