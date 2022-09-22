<?php
namespace Custom\Shippingfee\Model\ResourceModel;


class Shippingfee extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('shippingcharge', 'id');
	}
	
}