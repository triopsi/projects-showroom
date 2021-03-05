jQuery(document).ready(function () {
        if (jQuery.isFunction(jQuery.fn.wpColorPicker)) {
                jQuery('input.psr-main-color-field').wpColorPicker();
                jQuery('input.psr-hover-color-field').wpColorPicker();
        }
});