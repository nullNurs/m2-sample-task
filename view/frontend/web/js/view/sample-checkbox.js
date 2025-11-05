/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

define([
    'Magento_Ui/js/form/element/single-checkbox'
], function (SingleCheckbox) {
    'use strict';

    var checkoutConfig = window.checkoutConfig;

    return SingleCheckbox.extend({
        defaults: {
            template: 'Sample_CheckoutCheckbox/sample-checkbox'
        },
        isVisible: checkoutConfig.isSampleCheckboxEnabled
    });
});
