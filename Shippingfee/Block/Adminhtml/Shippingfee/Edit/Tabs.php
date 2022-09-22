<?php

namespace Custom\Shippingfee\Block\Adminhtml\Shippingfee\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
use Magento\Framework\Registry;
use Magento\Framework\View\LayoutFactory;

class Tabs extends WidgetTabs
{
    /**
     * @var Registry
     */
    protected $frameworkRegistry;

    /**
     * @var LayoutFactory
     */
    protected $viewLayoutFactory;

    public function __construct(
        Registry $frameworkRegistry,
        LayoutFactory $viewLayoutFactory,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $data = []
    ) {
        $this->frameworkRegistry = $frameworkRegistry;
        $this->viewLayoutFactory = $viewLayoutFactory;

        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    public function _construct()
    {
        parent::_construct();
        $this->setId('shippingfee_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Payment Fee Information'));
    }

    protected function _beforeToHtml()
    {

        $this->addTab('form_section', [
            'label'     => __('Fee Info'),
            'title'     => __('Fee Info'),
            'content'   => $this->getLayout()->createBlock('Custom\Shippingfee\Block\Adminhtml\Shippingfee\Edit\Tab\General')->toHtml(),
        ]);
        

        return parent::_beforeToHtml();
    }
}
