"use strict";

// Class definition
var KTClientes = function () {
    // Private properties
    return {
		init: function () {
		}
    }



    
}();


if (typeof module !== 'undefined') {
    module.exports = KTClientes;
}

function inicializarDataTables() {
    $('#tbl-clientes').DataTable({
        fixedHeader: {
            header: true,
            headerOffset: $('#kt_header').outerHeight() + $('#kt_subheader').outerHeight()
        },
        ordering: false,
        paging: false,
        searching: false,
        info: false
    });
}

function actualizarEstadoCliente(idReg, idEstado) {
    var view = $('#frmProg').attr("data-view");
    var context = $('#frmProg').attr("data-context");
    var metodo = "";
    switch (view) {
        case "clientes":
            metodo = 'actualizarEstado';
            break;
    }
    $.ajax({
        dataType: "json",
        data: {
            "idReg": idReg,
            "idEstado": idEstado
        },
        url: HOST_URL + view + '/' + metodo,
        type: 'post',
        success: function (data) {
            swal.fire({
                text: data.msj,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Aceptar",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function () {
                KTUtil.scrollTop();
            });
        },
        error: function (xhr, err) {
            location.reload();
        }
    });
}

jQuery(document).ready(function () {
    KTClientes.init();
    inicializarDataTables();
});

