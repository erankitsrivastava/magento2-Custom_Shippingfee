<?php
namespace Custom\Shippingfee\Controller\Adminhtml\Shippingfee;


class NewAction extends \Magento\Backend\App\Action
{

    protected $resultPageFactory = false;

    protected $_messageManager;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_messageManager = $context->getMessageManager();
    }

    public function execute()
    {
        $this->_forward('edit');
    }
}
