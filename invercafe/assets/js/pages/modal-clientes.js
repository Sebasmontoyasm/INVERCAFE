"use strict";

// Class definition
var KTModalClientes = function () {
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

    var _guardarCliente = function () {
        var el = document.getElementById("btn-guardar-cliente");
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
					url:   HOST_URL + view + '/guardarCliente',
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
            _guardarCliente();
		}
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTModalClientes;
}

jQuery(document).ready(function () {
    KTModalClientes.init();
});