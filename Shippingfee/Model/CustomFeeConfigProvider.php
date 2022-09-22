<?php
namespace Custom\Shippingfee\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class CustomFeeConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Custom\Shippingfee\Helper\Data
     */
    protected $dataHelper;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \Custom\Shippingfee\Helper\Data $dataHelper
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        // \Custom\Shippingfee\Helper\Data $dataHelper,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger

    )
    {
        // $this->dataHelper = $dataHelper;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $customFeeConfig = [];

        $customFeeConfig['fee_label'] = __('Extra Shipping Fee');
        $quote = $this->checkoutSession->getQuote();

        $customFeeConfig['custom_fee'] = $quote->getFee();

        $customFeeConfig['show_hide_customfee_block'] = ($quote->getFee() > 0) ? true : false;

        return $customFeeConfig;
    }
}
