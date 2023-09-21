"use strict";

// Class definition
var KTModalLotes = function () {
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

    var _initDtpicker = function () {
        if ($('.select-dtpicker').length == 0) {
            return;
        }
				
        var picker = $('.select-dtpicker');
		var fechaIni = new Date();
		var fechaFin = new Date();
		fechaIni.setDate(fechaIni.getDate() + parseInt($('#hidIntervalo').val()));
		fechaFin.setDate(fechaFin.getDate() + 15);
        picker.datepicker({
            rtl: KTUtil.isRTL(),
			format: "yyyy-mm-dd",
			autoclose: true,
            todayHighlight: true,
			minYear: 2020,
			//startDate: fechaIni,
			//endDate: fechaFin,
            orientation: "top left",
            templates: arrows
        }).on('changeDate', function(e) {			
			var fecha = moment($(this).find("input:eq(0)").val());
						
            //title
            $(this).find("span:eq(0)").html("");
            //date
			$(this).find("span:eq(1)").html(fecha.format('DD/MM/yyyy'));
			//$("#kt_programar_dtpicker input:eq(0)").val(fecha.format('yyyy-M-D'));
		});
    }

    return {
		init: function () {
			_initSelectPicker();
			_initDtpicker();
		}
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTModalLotes;
}

function GenerarLote(e, id) {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");

	$.ajax({
		dataType: "json",
		data: {
			"idDetalle": id
		},
		url:   HOST_URL + view + '/generarLote',
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			$("#tr" + id + " td:eq(5)").html(data.idLote.padStart(6, '0'));	
			$("#tr" + id + " td:eq(5)").addClass("table-success");	
			CerrarAside(id);
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function LiberarLote(e, id) {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");

	$.ajax({
		dataType: "json",
		data: {
			"idDetalle": id
		},
		url:   HOST_URL + view + '/liberarLote',
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			$("#tr" + id + " td:eq(5)").html("000000");
			$("#tr" + id + " td:eq(5)").removeClass("table-success");	
			CerrarAside(id);
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function ModificarLote(e, id) {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");
	var valNewLot = $(e).parent().parent().find(".txtNewLot").val();

	$.ajax({
		dataType: "json",
		data: {
			"idDetalle": id,
			"newLot": valNewLot
		},
		url:   HOST_URL + view + '/modificarLote',
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			if(data.idMsj == 1){
				$("#tr" + id + " td:eq(5)").html(valNewLot.padStart(6, '0'));
				$("#tr" + id + " td:eq(5)").addClass("table-success");
			} else {
				swal.fire({
					text: data.msj,
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					//location.reload();
				});
			}
			CerrarAside(id);
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function CalcularDiferencial(e) {
	var valCtoCertificado = parseFloat($(e).val());
	var comisionBroker = $("#span-comision-broker").text();
	var PrecioFix = $("#span-precio-fix").text();

	$("#span-dif-neto").html((PrecioFix - valCtoCertificado - parseFloat(comisionBroker)).formatMoney(2, '.', ','));
}

function ActualizarForward(e, id) {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");
	validarCamposForm('#divForward');
	if(valMessage.isValid){
		$.ajax({
			dataType: "json",
			data: "idDetalle=" + id + "&" + $("#frmMdl").serialize(),
			url:   HOST_URL + view + '/actualizarForward',
			type:  'post',
			beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
			success: function(data, status, xhr){
				swal.fire({
					text: data.msj,
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					$("#tr" + id + " td:eq(17)").html($("#cmbBanco option:selected").text());
					$("#tr" + id + " td:eq(18)").html($("#cmbTipoForward option:selected").text());
					$("#tr" + id + " td:eq(19)").html($("#txtTasaSpot").val());
					$("#tr" + id + " td:eq(20)").html($("#txtPuntosFwd").val());
					$("#tr" + id + " td:eq(21)").html($("#txtTasaFinal").val());
					$("#tr" + id + " td:eq(22)").html($("#hidFechaFutura").parent().find("span:eq(1)").text());
					$("#tr" + id + " td:eq(23)").html($("#txtMontoFwd").val());
					$("#tr" + id + " td:eq(23)").addClass("table-success");	
					CerrarAside(id);
				});
			},
			error:	function(xhr,err){ 
				//location.reload();
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
}

function FijarPrecio(e, id) {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");
	//var rowActual = parseInt($(e).parent().parent().index()) + 1;
	var txtCtoCertificado = ($("#txtCtoCertificado").val() == undefined ? "0.00" : $("#txtCtoCertificado").val());
	var txtPrecioFijacion = $("#txtPrecioFijacion").val();
	var hidFechaProg = $("#hidFechaProg").val();
		
	if (txtCtoCertificado == "" || txtPrecioFijacion == "" || hidFechaProg == "") {
		swal.fire({
			text: "Se detectaron campos vacíos para la fijación de este lote: Costo del certificado, Precio de fijación o Fecha de fijación",
			icon: "error",
			buttonsStyling: false,
			confirmButtonText: "Aceptar",
			customClass: {
				confirmButton: "btn font-weight-bold btn-light-primary"
			}
		}).then(function() {
			//location.reload();
		});
		
	} else {
		$.ajax({
			dataType: "json",
			data: {
				"idDetalle": id,
				"ctoCertificado": txtCtoCertificado,
				"precioFijacion": txtPrecioFijacion,
				"fechaFijacion": hidFechaProg
			},
			url:   HOST_URL + view + '/fijarPrecio',
			type:  'post',
			beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
			success: function(data, status, xhr){
				swal.fire({
					text: data.msj,
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					$("#tr" + id + " td:eq(15)").html(txtPrecioFijacion);
					$("#tr" + id + " td:eq(15)").addClass("table-success");	
					$("#tr" + id + " td:eq(16)").html($("#hidFechaProg").parent().find("span:eq(1)").text());
					CerrarAside(id);
				});
			},
			error:	function(xhr,err){ 
				//location.reload();
			}
		});
	}
}

$(function() {

    Number.prototype.formatMoney = function (c, d, t) {
        var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

	Number.prototype.round = function(n) {
	  const d = Math.pow(10, n);
	  return Math.round((this + Number.EPSILON) * d) / d;
	}
	
	var setMask2Decimal = {
		prefix: "",
		suffix: "",
		allowNegative: false, 
		thousands: ",",
		decimal: ".", 
		precision: 2,
		allowZero: true,
		affixesStay: true
	}
	
	var setMaskInteger = {
		prefix: "",
		suffix: "",
		allowNegative: false, 
		thousands: "",
		decimal: ".", 
		precision: 0,
		allowZero: true,
		affixesStay: true
	}

	Number.prototype.round = function(n) {
	  const d = Math.pow(10, n);
	  return Math.round((this + Number.EPSILON) * d) / d;
	}

	function SeleccionarMascara(inptMask){
		if (inptMask.attr("data-mascara") == "$") {
			inptMask.maskMoney(setMask2Decimal);
		}
		else {
			if (inptMask.attr("data-mascara") == "Nro"){
				inptMask.maskMoney(setMaskInteger);
			} else {
				setMaskNumber.suffix = " " + inptMask.attr("data-mascara");
				inptMask.maskMoney(setMaskNumber);
			}
		}
	}

	//funciones para validacion de mascara tipo numero
	$(".mask").each(function (e) {
		SeleccionarMascara($(this));
	});
	
	$(".mask").keyup(function (e) {
		$(e.target).maskMoney("destroy");
		SeleccionarMascara($(e.target));
	});
	$(".mask").focus(function (e) {
		$(e.target).maskMoney("destroy");
		SeleccionarMascara($(e.target));
	});
	
});


jQuery(document).ready(function () {
    KTModalLotes.init();
});