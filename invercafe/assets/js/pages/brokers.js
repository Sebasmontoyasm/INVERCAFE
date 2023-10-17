"use strict";

// Class definition
var KTBrokers = function () {
    // Private properties

    return {
        init: function () {
        }
    };
}();

if (typeof module !== 'undefined') {
    module.exports = KTBrokers;
}

function inicializarDataTables() {
    $('#tbl-brokers').DataTable({
        fixedHeader: {
            header: true,
			//Pendiente cambiar esto por un headerOffset: $('#kt_header').outerHeight()
			//headerOffset: $('#kt_header').outerHeight()
            headerOffset: 119
        },
        ordering: false,
        paging: false,
        searching: false,
        info: false
    });
}

function actualizarEstadoBroker(idReg, idEstado) {
    var view = $('#frmProg').attr("data-view");
    var context = $('#frmProg').attr("data-context");
    var metodo = "actualizarEstado";

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

function cargarContenido() {
    inicializarDataTables();
    KTBrokers.init();
}
$(document).ready(cargarContenido);
