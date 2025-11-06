/**
 * This file is part of the Sample_CheckoutCheckbox package.
 *
 * @copyright Copyright (c) 2025 Nurs
 * @author    Nurs
 * @license   MIT
 */

define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    return function (payloadExtenderFunction) {
        return wrapper.wrap(payloadExtenderFunction, function (originalPayloadExtenderFunction, payload) {
            originalPayloadExtenderFunction(payload);
            var sampleCheckbox = $('input[name="sample_checkbox"]').val();

            if (sampleCheckbox == null) {
                return;
            }

            payload.addressInformation['extension_attributes']['sampleCheckbox'] = sampleCheckbox;
        });
    };
});
