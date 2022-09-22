<?php
namespace Custom\Shippingfee\Controller\Adminhtml\Shippingfee;

class Add extends \Magento\Backend\App\Action
{
   
    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->initLayout();
//        $this->_setActiveMenu($this->menuId);
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Shipping Fees'));

        return $resultPage;
    }

   
}