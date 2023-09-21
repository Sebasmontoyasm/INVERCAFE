"use strict";

// Class definition
var KTContratos = function () {
    // Private properties
	var _tipiAsideEl;
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

    var _initSelect2 = function () {
        // minimum setup
        $('#cmbPais').select2({
            placeholder: 'Seleccionar'
        });
	}
		
    var _initSelectPicker = function () {
        // minimum setup
        $('.live-search').selectpicker();
    }

    var _initDtpickerComex = function () {
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
            orientation: "auto bottom",
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

    var _guardarContrato = function () {
        var el = document.getElementById("btn-guardar-contrato");

        if (!el) {
            return;
        }
        KTUtil.addEvent(el, 'click', function(e) {
			if($("#table-detalle-venta tr").length <= 1) {
				swal.fire({
					text: "No ha ingresado información del detalle de la venta",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					//KTUtil.scrollTop();
				});		
			} else {
				almacenarContrato();
			}
        });			
    }

	function almacenarContrato() {
		var view = $('#frmProg').attr("data-view");
		var context = $('#frmProg').attr("data-context");
		validarCamposForm('#divEncabezado');
		if(valMessage.isValid){
			$.ajax({
				dataType: "json",
				data: "context=" + context + "&cantLotesEmbarque=" + $("#txtLostesFijar").val() + "&itemsVenta=" + JSON.stringify(tblDetalleVenta) + "&" + $("form").serialize(),
				url:   HOST_URL + view + '/guardarContrato',
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
						location.reload();
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

	var _adicionarDetalleVenta = function () {
        var el = document.getElementById("btn-detalle-venta");

        if (!el) {
            return;
        }
        KTUtil.addEvent(el, 'click', function(e) {
			validarCamposForm('#divDetalleVenta');	
			if(valMessage.isValid){
				if($("#cmbTipoContrato").val() == 1) { // si es convencional
					if(Number.isInteger(parseFloat($("#txtLostesFijar").val()))) {
						if(parseFloat($("#txtLostesFijar").val()) > 0) {
							var cantLotesFijar = parseFloat($("#txtLostesFijar").val());
							var cantLotesAdicionales = parseFloat($("#txtLotesAdicionales").val());
							var cantItemsActuales = tblDetalleVenta.length;
							//eliminar los que hayan de más
							for (var i = cantItemsActuales-1; i >= (cantLotesFijar + cantLotesAdicionales); i--) {
								editRowDataTable(i, "delete", "");
							}
							//adicionar o actualizar los lotes de embarque
							for (var i = 0; i < cantLotesFijar; i++) {
								if (tblDetalleVenta[i] == null)
									addRowDataTable("firme");
								else
									editRowDataTable(i,"update", "firme");
							}
							//adicionar lo lotes adicionales en bolsa
							for (var i = cantLotesFijar; i < (cantLotesFijar + cantLotesAdicionales); i++) {
								if (tblDetalleVenta[i] == null)
									addRowDataTable("bolsa");
								else
									editRowDataTable(i,"update", "bolsa");
							}
							almacenarContrato();
						} else {
							swal.fire({
								text: "La cantidad de lotes a embarcar debe ser un número entero mayor a cero (0)",
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
					} else {
						swal.fire({
							text: "La cantidad de lotes a embarcar debe ser un número entero mayor a cero (0)",
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
				} else {
					var eqKilos = parseInt($("#cmbKilosUnidad option:selected").text().replace(" kg", "")) * parseInt($("#txtCantidadUnid").val());
					var addTr = '<tr>';
					var addTd = '<td class="text-muted font-weight-bolder">' + ($("#hidIndice").val() == "" ? (tblDetalleVenta.length + 1) : (parseInt($("#hidIndice").val()) + 1)) + '</td>';
					addTd += '<td class="text-dark font-weight-bolder">' + $("#txtCantidadUnid").val() + '</td>';
					addTd += '<td class="text-dark font-weight-bolder">' + $("#cmbKilosUnidad option:selected").text() + '</td>';
					addTd += '<td class="text-dark font-weight-bolder">' + eqKilos + '</td>';
					addTd += '<td><span class="text-dark font-weight-bolder">' + ($("#cmbCalidad").val() == "" ? "" : $("#cmbCalidad option:selected").text()) + '</span><span class="text-muted font-weight-bold d-block">' + $("#txtDescEspecial").val() + '</span><span class="text-muted font-weight-bold d-block">' + ($("#cmbCertificacion").val() == "" ? "" : $("#cmbCertificacion option:selected").text()) + '</span></td>';
					addTd += '<td class="text-dark font-weight-bolder">' + $("#txtCentLbs").val() + '</td>';
					addTd += '<td class="text-dark font-weight-bolder">' + ($("#cmbRequerimiento").val() == "" ? "" : $("#cmbRequerimiento option:selected").text()) + '</td>';
					addTd += '<td>';
					addTd += '<a href="#!" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm btn-modal-prog" onclick="ModificarDetalleVenta(' + ($("#hidIndice").val() == "" ? tblDetalleVenta.length : $("#hidIndice").val()) + ')">';
					addTd += '<span class="svg-icon svg-icon-md svg-icon-primary">';
					addTd += '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
					addTd += '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
					addTd += '<rect x="0" y="0" width="24" height="24"/>';
					addTd += '<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>';
					addTd += '<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>';
					addTd += '</g>';
					addTd += '</svg>';
					addTd += '</span>';
					addTd += '</a>&nbsp;';
					addTd += '<a href="#!" class="btn btn-icon btn-light-danger btn-hover-danger btn-sm btn-modal-prog" onclick="EliminarDetalleVenta(this, ' + ($("#hidIndice").val() == "" ? tblDetalleVenta.length : $("#hidIndice").val()) + ')">';
					addTd += '<span class="svg-icon svg-icon-md svg-icon-danger">';
					addTd += '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">';
					addTd += '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
					addTd += '<rect x="0" y="0" width="24" height="24"/>';
					addTd += '<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>';
					addTd += '<path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>';
					addTd += '</g>';
					addTd += '</svg>';
					addTd += '</span>';
					addTd += '</a>';
					addTd += '</td>';
					addTr += addTd + '</tr>';
					//si esta vacio el indice, se debe adicionar
					if ($("#hidIndice").val() == "") {
						addRowDataTable("firme");
						$('#table-detalle-venta tbody').append(addTr);
					//si esta lleno el indice, se debe modificar
					} else {
						editRowDataTable($("#hidIndice").val(), "update", "firme");
						$("#table-detalle-venta tr:eq(" + (parseInt($("#hidIndice").val()) + 1) + ")").html(addTd);
					}
					
					limpiarCamposForm('#divDetalleVenta', 'partial');
					$("#txtCantidadUnid").val("275");
					$("#txtUnidadesLote").val("275");
					$("#txtLostesFijar").val("1");
					$("#cmbKilosUnidad").val("52");
					$("#cmbKilosUnidad").val("52");
					$("#cmbKilosUnidad").change();
				}
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

	var _modificarContratoComex = function () {
        var el = document.getElementById("btn-contrato-comex");

        if (!el) {
            return;
        }
        KTUtil.addEvent(el, 'click', function(e) {
			var view = $('#frmProg').attr("data-view");
			var context = $('#frmProg').attr("data-context");
			validarCamposForm('#divContratoComex');
			if(valMessage.isValid){
				$.ajax({
					dataType: "json",
					data: {
						"context": context,
						"idContrato": $("#hidIdContrato").val(),
						"txtRefBuyer": $("#txtRefBuyer").val(),
						"cmbBroker": $("#cmbBroker").val(),
						"txtRefBroker": $("#txtRefBroker").val(),
						"txtComisionBroker": $("#txtComisionBroker").val()
					},
					url:   HOST_URL + view + '/modificarContratoComex',
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
							//location.reload();
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
		});	
	}

    return {
		init: function () {
			//_initSelect2();
			_initSelectPicker();
			_initDtpickerComex();
			_guardarContrato();
			_adicionarDetalleVenta();
			_modificarContratoComex();
		},

		initTipif: function () {
			_tipiAsideEl = KTUtil.getById('mdlForward');

			// Init aside and user list
			_initTipif();
			//_repaintDashboard2();
			//_initTimeOut();
		}		
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTContratos;
}

function VerComex(idProg = "") {
/*	$("#idLote").val(idProg);
    $("form").attr("action", HOST_URL + 'comex');
    $("form").attr("method", "POST");
    $("form").submit();	*/
	
	
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var metodo = 'verModalComex';

	$.ajax({
		dataType: "text",
		data: $("frmProg").serialize(),
		url:   HOST_URL + view + '/' + metodo + '/' + idProg,
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			$('#mdlGestion .modal-dialog').html(data);
			$('#mdlGestion').modal();
			/*if (context == "contratos"){
				$('.ocultar-convencional').show();
				$('.ocultar-especial').show();
				$('.ocultar-mixto').show();
				$('.detalle-venta').show();
				$('#btn-detalle-venta span:eq(1)').html("Adicionar");
				$('#btn-guardar-contrato').show();

				$("#cmbCalidad").removeAttr("required");
				$("#cmbCalidad").parent().find("small").html("")
				$("#txtUnidadesLote").removeAttr("required");
				$("#txtUnidadesLote").parent().find("small").html("")
				
				//si la modalidad es esta vacía
				if($("#cmbTipoContrato").val() == "") {
					$('.detalle-venta').hide();
				}
				//si la modalidad es convencional
				if($("#cmbTipoContrato").val() == 1) {
					$('#btn-guardar-contrato').hide();
					$('#btn-detalle-venta span:eq(1)').html("Almacenar");
					$('.ocultar-convencional').hide();
					$("#cmbCalidad").parent().find("small").html(" (*)")
					$("#cmbCalidad").attr("required","required");
					$("#txtUnidadesLote").parent().find("small").html(" (*)")
					$("#txtUnidadesLote").attr("required","required");
				}
				//si la modalidad es especial
				if($("#cmbTipoContrato").val() == 2) {
					$('.ocultar-especial').hide();
				}
				//si la modalidad es mixto
				if($("#cmbTipoContrato").val() == 3) {
					$('.ocultar-mixto').hide();
					$("#cmbCalidad").parent().find("small").html(" (*)")
					$("#cmbCalidad").attr("required","required");
				}				
			}	*/

		},
		error:	function(xhr,err){ 
			swal.fire({
				text: xhr.responseText,
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Aceptar",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
			
			//$('#mdlGestion').modal();
			//location.reload();
		}
	});
}

function addRowDataTable(tipo) {
	tblDetalleVenta.push({
		"id": "",
		"unidades": ($("#cmbTipoContrato").val() == "1" ? $("#txtUnidadesLote").val() : $("#txtCantidadUnid").val()),
		"kilos": {
			"id": (tipo == "firme" ? $("#cmbKilosUnidad").val() : ""),
			"desc": $("#cmbKilosUnidad option:selected").text()
		},
		"calidad": {
			"id": (tipo == "firme" ? $("#cmbCalidad").val() : ""),
			"desc": ($("#cmbCalidad").val() == "" ? "" : $("#cmbCalidad option:selected").text())
		},
		"descEspecial": $("#txtDescEspecial").val(),
		"certificacion": {
			"id": (tipo == "firme" ? $("#cmbCertificacion").val() : ""),
			"desc": ($("#cmbCertificacion").val() == "" ? "" : $("#cmbCertificacion option:selected").text())
		},
		"asociacion": {
			"id": (tipo == "firme" ? $("#cmbAsociacion").val() : ""),
			"desc": ($("#cmbAsociacion").val() == "" ? "" : $("#cmbAsociacion option:selected").text())
		},
		"tipoPrecio": (tipo == "firme" ? $("#cmbTipoPrecio").val() : ""),
		"centLbs": (tipo == "firme" ? $("#txtCentLbs").val() : ""),
		"requerimientos": {
			"id": (tipo == "firme" ? $("#cmbRequerimiento").val() : ""),
			"desc": ($("#cmbRequerimiento").val() == "" ? "" : $("#cmbRequerimiento option:selected").text())
		},
		"observaciones": (tipo == "firme" ? $("#txtObervaciones").val() : ""),
		"accion": "add"
	});
}

function editRowDataTable(index, action, tipo) {
	//es un delete sin id
	if (action == "delete" && tblDetalleVenta[index].id == "")
		tblDetalleVenta.splice(index,1);
	//es un delete con id
	else { 
		if (action == "delete" && tblDetalleVenta[index].id != "")
			tblDetalleVenta[index].accion = action;
		//es un update con id
		else {
			tblDetalleVenta[index] = {
				"id": tblDetalleVenta[index].id,
				"unidades": ($("#cmbTipoContrato").val() == "1" ? $("#txtUnidadesLote").val() : $("#txtCantidadUnid").val()),
				"kilos": {
					"id": (tipo == "firme" ? $("#cmbKilosUnidad").val() : ""),
					"desc": $("#cmbKilosUnidad option:selected").text()
				},
				"calidad": {
					"id": (tipo == "firme" ? $("#cmbCalidad").val() : ""),
					"desc": ($("#cmbCalidad").val() == "" ? "" : $("#cmbCalidad option:selected").text())
				},
				"descEspecial": $("#txtDescEspecial").val(),
				"certificacion": {
					"id": (tipo == "firme" ? $("#cmbCertificacion").val() : ""),
					"desc": ($("#cmbCertificacion").val() == "" ? "" : $("#cmbCertificacion option:selected").text())
				},
				"asociacion": {
					"id": (tipo == "firme" ? $("#cmbAsociacion").val() : ""),
					"desc": ($("#cmbAsociacion").val() == "" ? "" : $("#cmbAsociacion option:selected").text())
				},
				"tipoPrecio": (tipo == "firme" ? $("#cmbTipoPrecio").val() : ""),
				"centLbs": (tipo == "firme" ? $("#txtCentLbs").val() : ""),
				"requerimientos": {
					"id": (tipo == "firme" ? $("#cmbRequerimiento").val() : ""),
					"desc": ($("#cmbRequerimiento").val() == "" ? "" : $("#cmbRequerimiento option:selected").text())
				},
				"observaciones": (tipo == "firme" ? $("#txtObervaciones").val() : ""),
				"accion": action
			};
		}
	}
}

function EliminarDetalleVenta(e, indice) {
	var rowActual = parseInt($(e).parent().parent().index()) + 1;

	$("#table-detalle-venta tr:eq(" + rowActual + ")").remove();	
	editRowDataTable(indice, "delete", "");	
}

function ModificarDetalleVenta(indice) {
	$("#hidIndice").val(indice);
	$("#txtCantidadUnid").val(tblDetalleVenta[indice].unidades);
	$("#txtUnidadesLote").val(tblDetalleVenta[indice].unidades);
	$("#cmbKilosUnidad").val(tblDetalleVenta[indice].kilos.id);
	$("#cmbCalidad").val(tblDetalleVenta[indice].calidad.id);
	$("#txtDescEspecial").val(tblDetalleVenta[indice].descEspecial);
	$("#cmbCertificacion").val(tblDetalleVenta[indice].certificacion.id);
	$("#cmbAsociacion").val(tblDetalleVenta[indice].asociacion.id);
	$("#cmbTipoPrecio").val(tblDetalleVenta[indice].tipoPrecio);
	$("#txtCentLbs").val(tblDetalleVenta[indice].centLbs);
	$("#cmbRequerimiento").val(tblDetalleVenta[indice].requerimientos.id);
	$("#txtObervaciones").val(tblDetalleVenta[indice].observaciones);
}

function GenerarLote(e, id) {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var rowActual = parseInt($(e).parent().parent().parent().parent().parent().parent().index()) + 1;

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
			$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").html(data.idLote);	
			$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").addClass("table-success");	

			var menu = '<li class="navi-item">';
			menu += '<a href="#" class="navi-link" onclick="LiberarLote(this, ' + id + ')">';
			menu += '<span class="navi-icon">';
			menu += '<i class="flaticon-delete"></i>';
			menu += '</span>';
			menu += '<span class="navi-text">Liberar número lote</span>';
			menu += '</a>';
			menu += '</li>';
			menu += '<li class="navi-item">';
			menu += '<span class="navi-link">';
			menu += '<span class="navi-icon">';
			menu += '<i class="flaticon2-edit"></i>';
			menu += '</span>';
			menu += '<span class="navi-text">';
			menu += '<input id="txtNewLot" name="txtNewLot" class="form-control form-control-sm col-sm-10 mask" data-mask="Nro" value="' + data.idLote + '">';
			menu += '</span>';
			menu += '<span class="navi-link-badge">';
			menu += '<a href="#" class="label label-light-warning label-inline font-weight-bold" onclick="ModificarLote(this, ' + id + ')">modificar</a>';
			menu += '</span>';
			menu += '</span>';
			menu += '</li>';

			$("#table-fijacion-lotes tr:eq(" + rowActual + ")").find("#menu-lote").html(menu);
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function LiberarLote(e, id) {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var rowActual = parseInt($(e).parent().parent().parent().parent().parent().parent().index()) + 1;

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
			$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").html("");	
			$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").removeClass("table-success");
			
			var menu = '<li class="navi-item">';
			menu += '<a href="#" class="navi-link" onclick="GenerarLote(this, ' + id + ')">';
			menu += '<span class="navi-icon">';
			menu += '<i class="flaticon2-add"></i>';
			menu += '</span>';
			menu += '<span class="navi-text">Generar número lote</span>';
			menu += '</a>';
			menu += '</li>';

			$("#table-fijacion-lotes tr:eq(" + rowActual + ")").find("#menu-lote").html(menu);
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function ModificarLote(e, id) {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var rowActual = parseInt($(e).parent().parent().parent().parent().parent().parent().parent().parent().index()) + 1;
	var valNewLot = $(e).parent().parent().find("#txtNewLot").val();

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
				$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").html(valNewLot);	
				$("#table-fijacion-lotes tr:eq(" + rowActual + ") td:eq(1)").addClass("table-success");	
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
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function FijarPrecio(e, id) {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var rowActual = parseInt($(e).parent().parent().index()) + 1;
	var txtCtoCertificado = ($(e).parent().parent().find("#txtCtoCertificado").val() == undefined ? "0.00" : $(e).parent().parent().find("#txtCtoCertificado").val());
	var txtPrecioFijacion = $(e).parent().parent().find("#txtPrecioFijacion").val();
	var hidFechaProg = $(e).parent().parent().find("#hidFechaProg").val();
		
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
					//location.reload();
				});
				$(e).parent().parent().find("#span-precio-fijacion").addClass("table-success");
			},
			error:	function(xhr,err){ 
				//location.reload();
			}
		});
	}
}

function CalcularDiferencial(e) {
	var valCtoCertificado = parseFloat($(e).val());
	var comisionBroker = parseFloat($("#txtComisionBroker").val());
	var PrecioFix = parseFloat($(e).parent().parent().find("#span-precio-fix").text());

	$(e).parent().parent().find("#span-dif-neto").html((PrecioFix - valCtoCertificado - comisionBroker).formatMoney(2, '.', ','));
}

function VerForward(idLote = "") {
	var view = $('#frmCmx').attr("data-view");
	var context = "VerModalForward";
	
	alert(view);

	$('#kt_quick_cart .card-custom').html("");
	$.ajax({
		dataType: "text",
		data: $("form").serialize(),
		url:   HOST_URL + view + '/' + context + '/' + idLote,
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			//$('#mdlForward .card-custom').html(data);
			//$('#mdlForward').parent().append('<div class="offcanvas-overlay"></div>');
			//$('#mdlForward').removeClass("d-none");
			//KTContratos.initTipif();
			$('#mdlForward .card-custom').html(data);
			$('#mdlForward').modal();

		/*	$("#tr" + idLote).addClass("bg-light-primary");
			$('#kt_tipif_aside .card-custom').html(data);
			if($('#hidBloqueado').val() == ""){
				$('#kt_tipif_aside').parent().append('<div class="offcanvas-overlay"></div>');
				$('#kt_tipif_aside').removeClass("d-none");
				KTWidgets.initTipif();
			} else {
				swal.fire({
					text: "Esta cita actualmente se encuentra siendo gestionada por otro agente, por favor seleccione otro registro",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Aceptar",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					//KTUtil.scrollTop();
				});
			}	*/
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function CerrarTipificador(idLote = "") {
	var view = $('#frmView').attr("data-view");
	var context = "cerrarModalTipificador";
	$('#kt_quick_cart .card-custom').html("");
	$.ajax({
		dataType: "text",
		async: false,
		data: $("form").serialize(),
		url:   HOST_URL + view + '/' + context + '/' + idLote,
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			/*$('.offcanvas-overlay').remove();
			$('#kt_tipif_aside').addClass("d-none");
			$("#tr" + idLote).removeClass("bg-light-primary").removeClass("bg-light-warning");*/
		},
		error:	function(xhr,err){ 
			location.reload();
		}
	});
}

$(function() {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");

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
	
	var settings = {
		url: HOST_URL + view + '/cargarDocumento',
		dragDrop:true,
		showPreview:false,
		showDownload:true,
		fileName: "myfile",
		returnType:"json",
		maxFileSize: 5240000, // 5MB
		onSuccess: function(files,data,xhr){
		},
		showDone:false,
		doneStr: "<strong>Correcto!</strong> Enviar a Revisión...",
		showDelete:true,
		deletelStr: "Eliminar",
		maxFileCount:1,
		onLoad: function(obj){
			$.ajax({
				cache: false,
				url: HOST_URL + view + '/listarDocumentos',
				data: {
					"id": $('#hidIdContrato').val()
				},
				dataType: "json",
				type:  'post',
				success: function(data){
					for(var i=0;i<data.length;i++){
						if(data[i].name.includes("broker")) {
							if($(obj).attr('id') === "MFUpldBroker"){
								obj.createProgress(data[i].name , data[i].path, data[i].size);
							}
						}
						if(data[i].name.includes("cliente")) {
							if($(obj).attr('id') === "MFUpldCliente"){
								obj.createProgress(data[i].name , data[i].path, data[i].size);
							}
						}
					}
				}
			});
		},
		deleteCallback: function(data,pd) {
			var nameDest = (data.fileNameDest == undefined ? data[0] : data.fileNameDest);
			
			$.post(HOST_URL + view + '/eliminarDocumento', { id: $('#hidIdContrato').val(), nameDest: nameDest },
			function(resp, textStatus, jqXHR){

			});

			pd.statusbar.hide(); //You choice to hide/not.
		},
		downloadCallback:function(data,pd){
			var nameDest = (data.fileNameDest == undefined ? data[0] : data.fileNameDest);

			location.href=HOST_URL + view + "/descargarDocumento/" + $('#hidIdContrato').val() + "?filename=" + nameDest;
		}
	}                    
	
	$(".upload").each(function (e) {
		$(this).uploadFile(settings,$(this).attr('data-filename'),'doc,docx,pdf','CARGAR DOCUMENTO');
	});

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
		if (inptMask.attr("data-mask") == "$") {
			inptMask.maskMoney(setMask2Decimal);
		}
		else {
			if (inptMask.attr("data-mask") == "Nro"){
				inptMask.maskMoney(setMaskInteger);
			} else {
				setMaskNumber.suffix = " " + inptMask.attr("data-mask");
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

    $(".calcular-lotes-fijar").change(function() {
		var nroLotesFijar = parseFloat(parseInt($("#txtCantidadUnid").val()) / parseInt($("#txtUnidadesLote").val()));
		if(Number.isNaN(nroLotesFijar))
			$("#txtLostesFijar").val("");
		else
			$("#txtLostesFijar").val(nroLotesFijar.round(2));
    });
	
    $("#cmbMesEmbarque").change(function(e) {
		var valPosicion = $(this).find("option:selected").attr("data-posicion");
		$("#cmbMesPosicion").val(valPosicion);
		if($("#cmbMesEmbarque").val() == 50) //si es diciembre cambio de año
			$("#cmbAnioPosicion").val(parseInt($("#cmbAnioEmbarque").val())+1);
		else
			$("#cmbAnioPosicion").val($("#cmbAnioEmbarque").val());
    });
	
    $("#cmbKilosUnidad").change(function(e) {
		$("#cmbRequerimiento option").removeAttr("disabled");
		var valPosicion = $(this).find("option:selected").attr("data-requerimiento");
		var arrPosicion =  valPosicion.split(",");
		
		$("#cmbRequerimiento option").each(function (e) {
			if ($(this).val() != "") {
				if($.inArray($(this).val(), arrPosicion) == -1)
					$(this).attr("disabled","");
			}
		});
    });

    $("#cmbTipoContrato").change(function(e) {
		$('.ocultar-convencional').show();
		$('.ocultar-especial').show();
		$('.ocultar-mixto').show();
		$('.detalle-venta').show();
		$('#btn-detalle-venta span:eq(1)').html("Adicionar");
		$('#btn-guardar-contrato').show();

		$("#cmbCalidad").removeAttr("required");
		$("#cmbCalidad").parent().find("small").html("")
		$("#txtUnidadesLote").removeAttr("required");
		$("#txtUnidadesLote").parent().find("small").html("")
		
		limpiarCamposForm('#divDetalleVenta', 'all');
		$("#txtCantidadUnid").val("275");
		$("#txtUnidadesLote").val("275");
		$("#txtLostesFijar").val("1");
		$("#cmbKilosUnidad").val("52");
		
		//si la modalidad es esta vacía
		if($("#cmbTipoContrato").val() == "") {
			$('.detalle-venta').hide();
		}
		//si la modalidad es convencional
		if($("#cmbTipoContrato").val() == 1) {
			$('#btn-guardar-contrato').hide();
			$('#btn-detalle-venta span:eq(1)').html("Almacenar");
			$('.ocultar-convencional').hide();
			$("#cmbCalidad").parent().find("small").html(" (*)")
			$("#cmbCalidad").attr("required","required");
			$("#txtUnidadesLote").parent().find("small").html(" (*)")
			$("#txtUnidadesLote").attr("required","required");
		}
		//si la modalidad es especial
		if($("#cmbTipoContrato").val() == 2) {
			$('.ocultar-especial').hide();
		}
		//si la modalidad es mixto
		if($("#cmbTipoContrato").val() == 3) {
			$('.ocultar-mixto').hide();
			$("#cmbCalidad").parent().find("small").html(" (*)")
			$("#cmbCalidad").attr("required","required");
		}
		
		var view = $('#frmProg').attr("data-view");
/*		var context = $('#frmProg').attr("data-context");
		$.ajax({
			dataType: "json",
			data: "context=" + context + "&cmbTipoContrato=" + $("#cmbTipoContrato").val(),
			url:   HOST_URL + view + '/cargarCalidades',
			type:  'post',
			beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
			success: function(data, status, xhr){
				var addOption = "<option value=''>[Seleccionar]</option>";
				for (var i = 0; i < data.calidades.length; i++) {
					var calidad = data.calidades[i];
					addOption += "<option value='" + calidad.OPCId + "'>" + calidad.OPCNombre + "</option>";
				}
				$('#cmbCalidad').html(addOption);
				
				
			},
			error:	function(xhr,err){ 
				//location.reload();
			}
		});	*/
    });
});


jQuery(document).ready(function () {
    KTContratos.init();
});
