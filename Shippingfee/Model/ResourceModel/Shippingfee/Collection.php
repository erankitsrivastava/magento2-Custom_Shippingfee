<?php
namespace Custom\Shippingfee\Model\ResourceModel\Shippingfee;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Custom\Shippingfee\Model\Shippingfee', 'Custom\Shippingfee\Model\ResourceModel\Shippingfee');
	}

}
