define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'Magento_Checkout/js/model/totals'

], function (ko, Component, quote, priceUtils, totals) {
    'use strict';
    var show_hide_customfee_blockConfig = window.checkoutConfig.show_hide_customfee_block;
    var fee_label = window.checkoutConfig.fee_label;
    var custom_fee = window.checkoutConfig.custom_fee;

    return Component.extend({
        totals: quote.getTotals(),
        getFormattedPrice: function() {
            return priceUtils.formatPrice(this.getValue(), quote.getPriceFormat());
        },
        isDisplayed: function () {
            return this.getValue() != 0;
        },
        getValue: function() {
            var price = 0;
            if (this.totals() && totals.getSegment('fee')) {
                price = totals.getSegment('fee').value;
            }
            return price;
        },
        getFeeLabel: function() {
            var title = 0;
            if (this.totals() && totals.getSegment('fee')) {
                title = totals.getSegment('fee').title;
            }
            return title;
        },
    });
});
