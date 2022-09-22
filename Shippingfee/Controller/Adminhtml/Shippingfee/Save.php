<?php
namespace Custom\Shippingfee\Controller\Adminhtml\Shippingfee;


class Save extends \Magento\Backend\App\Action
{
	protected $frameworkFilesystem;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Custom\Shippingfee\Model\ShippingfeeFactory $shippingfeeFactory
    )
    {
        parent::__construct($context);
        $this->shippingfeeFactory = $shippingfeeFactory;
    }

    public function execute()
    { 
    	try {
    		if ($this->getRequest()->getPost()) {

    		$postData = $this->getRequest()->getPost();
    		$shippingFeeId = $this->getRequest()->getParams('id');
    		if($shippingFeeId && false){
    			//edit fee
	    		$modelShipping = $this->shippingfeeFactory->create();
				$modelShipping->addData($postData);
				$modelShipping->load($shippingFeeId);
		        $modelShipping->save();
    		}else{
    			$fee_label = $this->getRequest()->getParam('fee_label');
    			$active = $this->getRequest()->getParam('active');
    			$fee_amount = $this->getRequest()->getParam('fee_amount');
    			$fee_type = $this->getRequest()->getParam('fee_type');

    			//create new fee
	    		$modelShipping = $this->shippingfeeFactory->create();
				$modelShipping->setData('fee_label',$fee_label);
				$modelShipping->setData('active',$active);
				$modelShipping->setData('fee_amount',$fee_amount);
				$modelShipping->setData('fee_type',$fee_type);
		        $modelShipping->save();
			}
    	}

    	   $this->messageManager->addSuccessMessage('Fee has been created Successfully');
    	   $this->_redirect('*/*/edit', ['id' => $modelShipping->getId]);
            return;
    	} catch (\Exception $e) {
    		$this->messageManager->addError($e->getMessage());
    		$this->_redirect('customshipping/shippingfee/add');
            return;
    	}
    }

}
