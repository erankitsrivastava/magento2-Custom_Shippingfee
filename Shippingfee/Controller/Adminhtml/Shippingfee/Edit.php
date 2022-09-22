<?php
namespace Custom\Shippingfee\Controller\Adminhtml\Shippingfee;


class Edit extends \Magento\Backend\App\Action
{

	public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    )
    {
        
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
    	$resultPage = $this->resultPageFactory->create();
    	$resultPage->getConfig()->getTitle()->prepend(__('Edit Item'));
    	return $resultPage;
    }

}