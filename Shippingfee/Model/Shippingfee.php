<?php
namespace Custom\Shippingfee\Model;


class Shippingfee extends \Magento\Framework\Model\AbstractModel 
{

	protected function _construct()
	{
		$this->_init('Custom\Shippingfee\Model\ResourceModel\Shippingfee');
	}
}