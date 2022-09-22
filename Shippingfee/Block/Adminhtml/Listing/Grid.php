<?php

namespace Custom\Shippingfee\Block\Adminhtml\Listing;

use Custom\Shippingfee\Model\ShippingfeeFactory;
use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var ShippingfeeFactory
     */
    protected $shippingfeeFactory;

    public function __construct(
        ShippingfeeFactory $shippingfeeFactory,
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Backend\Helper\Data $backendHelper, 
        array $data = []
        )
    {
        $this->shippingfeeFactory = $shippingfeeFactory;
        parent::__construct($context, $backendHelper, $data);
    }



    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('shippingfee');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);

    }
    protected function _prepareCollection()
    {
       
            $collection = $this->shippingfeeFactory->create()->getCollection();
            $this->setCollection($collection);
            return parent::_prepareCollection();
        

    }


    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
    $this->addColumn('entity_id',
            [
                'index' => 'id',
                'type'    => 'checkbox',
            ]);

   //  $this->addColumn('in_group_vendors', array(
   // 87         'header_css_class' => 'a-center',
   // 88:        'type'      => 'checkbox',
   // 89         'onclick'  =>   'vendorvalidate()',
   // 90         'values'    => $this->getVendors(),

    $this->addColumn('id', [
            'header'    => __('ID'),
            'align'     =>'right',
            'index'     => 'id',
            'width'     => '80px',
            'type'    => 'text',
            'is_system' => true
        ]
    );
   $this->addColumn('fee_label', [
        'header'    => __('Fee Name'),
        'align'     =>'left',
        'index'     => 'fee_label',
    ]);
    $this->addColumn('fee_amount', [
        'header'    => __('Fee Amount'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'fee_amount',
    ]);
    $this->addColumn('fee_type', [
        'header'    => __('Fee Type'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'fee_type',
    ]);
    $this->addColumn('allowed_shipping_methods', [
        'header'    => __('Shipping Methods'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'allowed_shipping_methods',
    ]);
    $this->addColumn('store_views', [
        'header'    => __('Store Views'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'store_views',
    ]);
    $this->addColumn('customer_group', [
        'header'    => __('Customer Group'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'customer_group',
    ]);
    $this->addColumn('active', [
        'header'    => __('Status'),
        'align'     =>'left',
        'width'     => '80px',
        'index'     => 'active',
        'renderer' => 'Custom\Shippingfee\Block\Adminhtml\Renderer\Status'
    ]);
   //  $this->addColumn('status', [

   //      'header'    => __('Status'),
   //      'align'     => 'left',
   //      'width'     => '80px',
   //      'index'     => 'status',
   //      'type'      => 'options',
   //      'options'   => [
   //          1 => 'Active',
   //          0 => 'Inactive',
   //      ],
   //  ]);

   //  $this->addColumn('action',
   //      [
   //          'header' => __('Action'),
   //          'width' => '100',
   //          'type' => 'action',
   //          'getter' => 'getId',
   //          'actions' => [
   //              [
   //                  'caption' => __('Edit'),
   //                  'url' => ['base'=> '*/*/edit'],
   //                  'field' => 'id'
   //              ]],
   //          'filter' => false,
   //          'sortable' => false,
   //          'index' => 'stores',
   //          'is_system' => true,
   //      ]);



    $block = $this->getLayout()->getBlock('grid.bottom.links');
    if ($block) {
        $this->setChild('grid.bottom.links', $block);
    }

    return parent::_prepareColumns();
}

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current'=>true]);
    }


}
