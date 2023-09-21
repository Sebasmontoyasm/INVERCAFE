"use strict";

// Class definition
var KTUsuarios = function () {
    // Private properties

    var _guardarUsuario = function () {
        var el = document.getElementById("btn-guardar-usuario");

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
					url:   HOST_URL + view + '/guardarUsuario',
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
			//_initSelect2();
			_guardarUsuario();
			_guardarPerfilCuenta();
		}
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTUsuarios;
}

function actualizarEstadoUsuario(idReg, idEstado){
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var metodo = "";
	//var context = (context == "diario") ? "verModalDiario" : "verModalFuturo";
    switch(view) {
        case "usuarios":
            metodo = 'actualizarEstado';
            break;
    }
	//alert("Id=" + IdCadena + "Estado=" + Estado);
	$.ajax({
	  dataType: "json",
	  data: {
		  "idReg": idReg,
		  "idEstado": idEstado
	  },
	  url:   HOST_URL + view + '/' + metodo,
	  type:  'post',
	  success: function(data){
		swal.fire({
			text: data.msj,
			icon: "success",
			buttonsStyling: false,
			confirmButtonText: "Aceptar",
			customClass: {
				confirmButton: "btn font-weight-bold btn-light-primary"
			}
		}).then(function() {
			KTUtil.scrollTop();
		});
	  },
	  error:	function(xhr,err){
		location.reload();
	  }
	});	
}

jQuery(document).ready(function () {
    KTUsuarios.init();
});
