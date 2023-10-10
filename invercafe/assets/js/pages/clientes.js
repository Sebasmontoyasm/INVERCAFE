"use strict";

// Class definition
var KTClientes = function () {
    // Private properties

    return {
		init: function () {
		}
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTClientes;
}

function actualizarEstadoCliente(idReg, idEstado){
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var metodo = "";
	//var context = (context == "diario") ? "verModalDiario" : "verModalFuturo";
    switch(view) {
        case "clientes":
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
/**
jQuery(document).ready(function () {
    KTClientes.init();
});

 */