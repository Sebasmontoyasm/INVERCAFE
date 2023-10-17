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

    var _guardarBroker = function () {
        var el = document.getElementById("btn-guardar-broker");
        if (!el) {
            return;
        }
        KTUtil.addEvent(el, 'click', function(e) {
			var view = $('#frmProg').attr("data-view");
			var context = $('#frmProg').attr("data-context");
			validarCamposForm('#frmProg');
			if(valMessage.isValid){
				$.ajax({
					dataType: "json",
					data: "context=" + context + "&" + $("form").serialize(),
					url:   HOST_URL + view + '/guardarBroker',
					type:  'post',
					beforeSend: function(){
					//Lo que se hace antes de enviar el formulario
					},
					success: function(data, status, xhr){
						location.reload();
					},
					error:	function(xhr,err){ 
						location.reload();
					}
				});					
			} else {
				swal.fire({
					text: valMessage.msj,
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					//KTUtil.scrollTop();
				});		
			}
        });			
    }

    return {
		init: function () {
            _guardarBroker();
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