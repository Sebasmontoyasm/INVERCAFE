"use strict";

// Class definition
var KTModalBrokers = function () {
    // Private properties
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    var _initSelectPicker = function () {
        // minimum setup
        $('.live-search').selectpicker();
    }

    return {
		init: function () {
			_initSelectPicker();
		}
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTModalBrokers;
}

jQuery(document).ready(function () {
    KTModalBrokers.init();
});