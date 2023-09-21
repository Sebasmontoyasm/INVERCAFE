"use strict";

var valMessage = [];
var categorias = ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
var series = [{
	name: 'Net Profit',
	data: [44, 55, 57, 56, 61, 58]
}, {
	name: 'Revenue',
	data: [76, 85, 101, 98, 87, 105]
}];
/*
// Class definition
var KTAdmin = function () {
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

    // General Controls
    var _initDtpickerReportes = function () {
        if ($('#kt_reporte_dtpicker').length == 0) {
            return;
        }

        var picker = $('#kt_reporte_dtpicker');

        picker.datepicker({
            rtl: KTUtil.isRTL(),
			format: "yyyy-mm-dd",
			autoclose: true,
            todayHighlight: true,
            orientation: "auto bottom",
            templates: arrows
        }).on('changeDate', function(e) {
			var fecha = moment($(this).find("input:eq(0)").val());
			var fechaIni = moment($(this).find("input:eq(1)").val());
            $('#kt_reporte_dtpicker_date').html(fecha.format('MMM D'));
            $('#kt_reporte_dtpicker_title').html("Fecha");
			
			var view = $('#frmView').attr("data-view");
			filtrarCitas();
		});
    }	
	
    var _initDateRangeExportar = function () {
        if ($('#btn-exportar-fechas').length == 0) {
            return;
        }

        var picker = $('#btn-exportar-fechas');
        var start = moment($("#btn-exportar-fechas input:eq(0)").val());
        var end = moment($("#btn-exportar-fechas input:eq(0)").val());

        function cb(start, end, label) {
			$("#btn-exportar-fechas input:eq(0)").val(start.format('yyyy-M-D'));
			$("#btn-exportar-fechas input:eq(1)").val(end.format('yyyy-M-D'));
			var fecha = start;
			var fechaIni = end;
			ExportarExcel(1, $('#cmbIpsActiva').val(), $('#hidExpFechaIni').val(), $('#hidExpFechaFin').val());
        }		

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
			autoUpdateInput: false,
            startDate: start,
            endDate: end,
            opens: 'right',
            applyClass: 'btn-primary',
            cancelClass: 'btn-light-primary',
			autoclose: true,
            ranges: {
                'Hoy': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                'Este mes': [moment().startOf('month'), moment().endOf('month')],
                'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Mañana': [moment().add(1, 'days'), moment().add(1, 'days')],
                //'Proximos 7 días': [moment(), moment().add(6, 'days')],
                //'Mes siguiente': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            }
		}).on('apply.daterangepicker', function(e, picker) {
			cb(picker.startDate, picker.endDate, '');
		})
		
    }

    var _initDatepicker = function () {
        if ($('#kt_dashboard_datepicker').length == 0) {
            return;
        }

        var picker = $('#kt_dashboard_datepicker');

        picker.datepicker({
            rtl: KTUtil.isRTL(),
			format: "yyyy-mm-dd",
			autoclose: true,
            todayHighlight: true,
            //orientation: "right",
            templates: arrows
        }).on('changeDate', function(e) {
			var fecha = moment($(this).find("input").val());
			var fechaIni = moment($(this).find("input").val());
			var view = $('#frmView').attr("data-view");
            $('#kt_dashboard_datepicker_date').html(fecha.format('MMM D'));
            $('#kt_dashboard_datepicker_title').html("Fecha");
			$.ajax({
				dataType: "json",
				data: $("form").serialize(),
				url:   HOST_URL + view + '/index/' + fecha.format('yyyy-M-D'),
				type:  'post',
				beforeSend: function(){
				//Lo que se hace antes de enviar el formulario
				},
				success: function(data, status, xhr){
					if(view == "admin")
						PintarDashboard(data, fecha, fechaIni);
					if(view == "reportes")
						PintarReportes(data, fecha, fechaIni);
				},
				error:	function(xhr,err){ 
					location.reload();
				}
			});					
			
		});
    }

    var _repaintDashboard1 = function () {
        var el = document.getElementById("kt_dashboard_reload");
        var e2 = document.getElementById("cmbEstado");
        var e3 = document.getElementById("cmbEstadoWapp");
        var e4 = document.getElementById("cmbEspecialidad");

        if (!(el || e2 || e3 || e4)) {
            return;
        }
		
        KTUtil.addEvent(el, 'click', function(e) {
			filtrarCitas();
        });

        KTUtil.addEvent(e2, 'change', function(e) {
			filtrarCitas();
        });

        KTUtil.addEvent(e3, 'change', function(e) {
			filtrarCitas();
        });
		
        KTUtil.addEvent(e4, 'change', function(e) {
			filtrarCitas();
        });
		
    }

	function PintarDashboard(data, fecha, fechaIni) {
		//panel de totales de hoy
		$('#panel-totales-hoy div h3').html(fecha.format('D') + ' de ' + fecha.format('MMMM'));
		$('#span-total-dia').html(data.total_dia.TotalDia);
		$('#span-total-pendiente').html((data.total_dia.Pendiente == null ? 0 : data.total_dia.Pendiente));
		$('#span-porcen-pendiente').html((data.total_dia.Pendiente == null ? 0 : Math.round(data.total_dia.Pendiente/data.total_dia.TotalDia*100))+'%');
		$('#span-total-error').html((data.total_dia.Error == null ? 0 : data.total_dia.Error));
		$('#span-porcen-error').html((data.total_dia.Error == null ? 0 : Math.round(data.total_dia.Error/data.total_dia.TotalDia*100))+'%');
		$('#span-total-enviada').html((data.total_dia.Enviada == null ? 0 : data.total_dia.Enviada));
		$('#span-porcen-enviada').html((data.total_dia.Enviada == null ? 0 : Math.round(data.total_dia.Enviada/data.total_dia.TotalDia*100))+'%');
		$('#span-total-confirmada').html((data.total_dia.Confirmada == null ? 0 : data.total_dia.Confirmada));
		$('#span-porcen-confirmada').html((data.total_dia.Confirmada == null ? 0 : Math.round(data.total_dia.Confirmada/data.total_dia.TotalDia*100))+'%');
		$('#span-total-cancelada').html((data.total_dia.Cancelada == null ? 0 : data.total_dia.Cancelada));
		$('#span-porcen-cancelada').html((data.total_dia.Cancelada == null ? 0 : Math.round(data.total_dia.Cancelada/data.total_dia.TotalDia*100))+'%');
		//panel reporte de efectividasd asistencias
		$('#kt_mixed_widget_14_chart').attr("data-porcen", (data.total_dia.Confirmada == null ? 0 : Math.round(data.total_dia.Confirmada/data.total_dia.TotalDia*100)));
		$('#kt_mixed_widget_14_chart').html("");
		_initMixedWidget14();					
		//panel reporte de citas preliminar
		$('#panel-reporte-citas h3 span:eq(0) span').html(fecha.format('D') + ' de ' + fecha.format('MMMM'));
		$('#panel-reporte-citas h3 span:eq(2)').html("Cantidad de agendas encontradas: " + data.citas.length);
		//tabla reporte de citas de hoy
		var addTr = "";
		for (var i = 0; i < data.citas.length; i++) {
			var cita = data.citas[i];
			addTr += '<tr>';
			addTr += '<td class="pl-0">';
			addTr += '<span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' + cita.CITPaciente + '</span>';
			addTr += '<div><span class="text-muted font-weight-bold">' + cita.CITCedulaPaciente + '</span></div>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-muted font-weight-bold">' + cita.CITTelefono + '</span>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">' + cita.CITSede + '</span>';
			addTr += '<div><span class="font-weight-bolder">' + cita.CITMedico + '</span></div>';
			addTr += '<div><span class="text-muted font-weight-500">' + cita.CITEspecialidad + '</span></div>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-muted font-weight-500">' + cita.CITHoraCita + '</span>';
			addTr += '</td>';
			addTr += '<td class="text-right">';
			addTr += '<span class="' + (cita.ESTDescripcion == null ? "" : 'label label-lg label-inline label-light-' + cita.ESTColor) + '">' + (cita.ESTDescripcion == null ? "" : cita.ESTDescripcion) + '</span>';
			addTr += '</td>';
			addTr += '</tr>';
			
			if(i >= 9)
				break; 
		}
		$('#tbl-reporte-citas tbody').html(addTr);
		//consolidado semanal
		addTr = "";
		categorias = [];
		series = [];
		series = data.series;
		$('#kt_charts_widget_1_chart').html("");
		_initChartsWidget1();
		for (var i = 0; i < data.total_semana.length; i++) {
			//para cargar la gráfica
			var estado = data.total_semana[i];
			var dia = moment(estado.CITFechaCita);
			if (categorias.indexOf(dia.format('ddd D')) == -1)
				categorias.push(dia.format('ddd D'));
			addTr += '<tr>';
			addTr += '<td class="pl-0">';
			addTr += '<span class="text-text-dark-75 font-weight-bolder mb-1 font-size-lg text-uppercase">' + dia.format('dddd D') + '</span>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-' + estado.ESTColor + ' font-weight-bolder mb-1 font-size-lg">' + estado.ESTDescripcion + '</span>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-muted font-weight-500">' + estado.Cantidad + '</span>';
			addTr += '</td>';
			addTr += '<td>';
			addTr += '<span class="text-muted font-weight-500">' + estado.TotalDia + '</span>';
			addTr += '</td>';
			addTr += '<td class="text-right">';
			addTr += '<div class="d-flex align-items-center pt-2"><div class="progress progress-xs mt-2 mb-2 w-100">';
			addTr += '<div class="progress-bar bg-' + estado.ESTColor + '" role="progressbar" style="width: ' + estado.Porcentaje + '%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
			addTr += '<span class="ml-3 text-muted font-weight-500">' + estado.Porcentaje + '%</span>';
			addTr += '</div>';																	
			addTr += '</td>';
			addTr += '</tr>';
		}
		$('#tbl-reporte-semana tbody').html(addTr);
		$('#panel-reporte-semana span:eq(1)').html("Período del " + fechaIni.subtract(7, 'days').format('D MMM') + " al " + fecha.format('D MMM YYYY'));
	}
	
	function PintarReportes(data, fecha, fechaIni) {
		//panel reporte de citas preliminar
		$('#panel-reporte-citas h3 span:eq(0) span').html(fecha.format('D') + ' de ' + fecha.format('MMMM'));
		$('#panel-reporte-citas h3 span:eq(2)').html("Cantidad de agendas encontradas: " + data.cant_citas);
				
		var table = $('#dt-tbl-reporte-citas').DataTable();
		table.clear();
		table.draw();
		table.destroy();

		$('#dt-tbl-reporte-citas tbody').html(data.citas);
		table = _initDTCitas();
		
	}

    var _guardarPerfilCuenta = function () {
        var e1 = document.getElementById("btn-guardar-perfil-cuenta");
        var e2 = document.getElementById("btn-guardar-perfil-contrasena");
        if (!(e1 || e2)) {
            return;
        }
		
        KTUtil.addEvent(e1, 'click', function(e) {
			GuardarPerfilCredenciales('#kt_user_edit_tab_2', 'guardarCuenta');
        });

        KTUtil.addEvent(e2, 'click', function(e) {
			GuardarPerfilCredenciales('#kt_user_edit_tab_3', 'guardarContrasena');
        });

    }

	function GuardarPerfilCredenciales(contenedor, metodo) {
		validarCamposForm(contenedor);
		if(valMessage.isValid){
			if($('#txtNuevoPasswd').val() == $('#txtVerificarPasswd').val()) {
				var view = $('#frmProg').attr("data-view");
				$.ajax({
					dataType: "json",
					data: $("form").serialize(),
					url: HOST_URL + view + '/' + metodo,
					type: 'post',
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
							limpiarCamposForm(contenedor, "all");
							KTUtil.scrollTop();
						});
					},
					error:	function(xhr,err){ 
						location.reload();
					}
				});
			} else {
				swal.fire({
					text: "La nueva contraseña y su confirmacion no coinciden, por favor verificar.",
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

    // Stats widgets
    var _initStatsWidget7 = function () {
        var element = document.getElementById("kt_stats_widget_7_chart");

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [30, 45, 32, 70, 40]
            }],
            chart: {
                type: 'area',
                height: 150,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [KTApp.getSettings()['colors']['theme']['base']['success']]
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: KTApp.getSettings()['colors']['gray']['gray-300'],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false,
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
            markers: {
                colors: [KTApp.getSettings()['colors']['theme']['light']['success']],
                strokeColor: [KTApp.getSettings()['colors']['theme']['base']['success']],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    // Charts widgets
    var _initChartsWidget1 = function () {
        var element = document.getElementById("kt_charts_widget_1_chart");

        if (!element) {
            return;
        }
		
        var options = {
            series: series,
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: categorias,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return val + " citas"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    // Mixed widgets
    var _initMixedWidget14 = function () {
        var element = document.getElementById("kt_mixed_widget_14_chart");
        var height = parseInt(KTUtil.css(element, 'height'));
        var valor = $(element).attr("data-porcen");

        if (!element) {
            return;
        }

        var options = {
            series: [valor],
            chart: {
                height: height,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 0,
                        size: "65%"
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: false,
                            fontWeight: '700'
                        },
                        value: {
                            color: KTApp.getSettings()['colors']['gray']['gray-700'],
                            fontSize: "30px",
                            fontWeight: '700',
                            offsetY: 12,
                            show: true,
                            formatter: function (val) {
                                return val + '%';
                            }
                        }
                    },
                    track: {
                        background: KTApp.getSettings()['colors']['theme']['light']['success'],
                        strokeWidth: '100%'
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success']],
            stroke: {
                lineCap: "round",
            },
            labels: ["Progress"]
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    // Activar/Desactivar Item de Menu
    var _initActivarDesactivarMenuItem = function () {
		var encontro = false;
		$(".menu-item a").each(function(e) {
			var hrefMenu = $(this).attr("href-data");
			if (hrefMenu.includes(SCRIPT_NAME)){
				$(this).parent().addClass('menu-item-active');				
				if (hrefMenu.includes("usuarios") || hrefMenu.includes("clientes") || hrefMenu.includes("brokers")){
					$(this).parent().parent().parent().parent().addClass('menu-item-open');
				}
				encontro = true;
			} else {
				$(this).parent().removeClass('menu-item-active');
				encontro = false;
			}
		});
		if(!encontro)
			$(".menu-item :eq(0)").parent().addClass('menu-item-active');
	}

	var _initDTCitas = function() {
		// begin first table
		$('#dt-tbl-reporte-citas').DataTable({
			responsive: true,
			// DOM Layout settings
			dom: `<'row'<'col-md-4 my-2 my-md-0'f>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
			stateSave: true,
			lengthMenu: [5, 10, 20, 30, 50, 100],

			pageLength: 20,

			language: {
				'lengthMenu': 		'Registros _MENU_',
				'sSearch':         	"Buscar:",
				'sInfo':           	"Registros _START_ a _END_ de _TOTAL_ citas",
				'sInfoEmpty':      	"Registros 0 a 0 de 0 citas",
				'sInfoFiltered':   	"(filtrado de un total de _MAX_ registros)",
				'sZeroRecords':    	"No se encontraron resultados",
				'searchPlaceholder': "Frase..."
			},
			
			columnDefs: [
				{
					targets: 0,
					width: '10px',
					className: 'dt-left',
					orderable: false
				},
				{
					targets: 8,
					width: '10px',
					orderable: false
				},
			],
		});

		$('#dt-tbl-reporte-citas_filter').removeClass("dataTables_filter").addClass("d-flex align-items-center");
		$('#dt-tbl-reporte-citas_filter input').removeClass("form-control-sm").addClass("form-control-solid");
		$('#dt-tbl-reporte-citas_filter label').addClass("mr-3 mb-0 d-none d-md-block");

	};

    // Public methods
    return {
        init: function () {
            // General Controls
			_initDtpickerReportes();
			_initDateRangeExportar();
            _initDatepicker();
			_guardarPerfilCuenta();
			
			_repaintDashboard1();
			
			// Charts widgets
			_initChartsWidget1();

            // Stats Widgets
            _initStatsWidget7();

            // Mixed Widgets
            _initMixedWidget14();

            _initDTCitas();
			
			_initActivarDesactivarMenuItem();
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTAdmin;
}
*/
function ExportarExcel(informe, ips, fechaIni, fechaFin) {
	window.open(HOST_URL + 'admin/exportar/' + informe + '/?ini=' + fechaIni + '&fin=' + fechaFin + '&ips=' + ips);
}

function VerMenuOpcion(href) {
	var view = $(href).attr("href-data");
    $("form").attr("action", HOST_URL + view);
    $("form").attr("method", "POST");
    $("form").submit();
}

function VerReporte() {
    $("form").attr("action", HOST_URL + 'reportes');
    $("form").attr("method", "POST");
    $("form").submit();
}

function VerModal(idProg = "") {
	var view = $('#frmProg').attr("data-view");
	var context = $('#frmProg').attr("data-context");
	var metodo = "";
    switch(context) {
        case "usuarios":
            metodo = 'verModalUsuarios';
            break;
        case "contratos":
            metodo = 'verModalContratos';
            break;
    }

	$.ajax({
		dataType: "text",
		data: $("form").serialize(),
		url:   HOST_URL + view + '/' + metodo + '/' + idProg,
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			$('#mdlGestion .modal-dialog').html(data);
			$('#mdlGestion').modal();
			if (context == "contratos"){
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
			}

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

function limpiarCamposForm(contenedor, clean){
	$(contenedor + " input").each(function (e) {
		if(clean == "all") {
			$(this).val("");
		}
		if(clean == "partial") {
			if ($(this).hasClass("no-clean") == false)
				$(this).val("");
		}
	});
	$(contenedor + " select").each(function (e) {
		if(clean == "all") {
			$(this).val("");
		}
		if(clean == "partial") {
			if ($(this).hasClass("no-clean") == false)
				$(this).val("");
		}
	});
	$(contenedor + " textarea").each(function (e) {
		if(clean == "all") {
			$(this).val("");
		}
		if(clean == "partial") {
			if ($(this).hasClass("no-clean") == false)
				$(this).val("");
		}
	});
}

function validarCamposForm(contenedor){
	valMessage.isValid = true;
	$(contenedor + " input").each(function (e) {
		if($(this).val() == "" && $(this).is(':required')){
			valMessage.isValid = false;
			valMessage.msj = "Este campo es requerido: " + $(this).parent().find("label").text();
			return false;
		}			
	});
	$(contenedor + " select").each(function (e) {
		if($(this).val() == "" && $(this).is(':required')){
			valMessage.isValid = false;
			var label = $(this).parent().find("label").text();
			if (label == "")
				label = $(this).parent().parent().find("label").text();
			valMessage.msj = "Este campo es requerido: " + label;
			return false;
		}			
	});
	$(contenedor + " textarea").each(function (e) {
		if($(this).val() == "" && $(this).is(':required')){
			valMessage.isValid = false;
			valMessage.msj = "Este campo es requerido: " + $(this).parent().find("label").text();
			return false;
		}			
	});
	$(contenedor + " input[type='number']").each(function (e) {
		if($(this).val() != ""){
			var filter=/^([0-9]+)*$/;
			if(!filter.test($(this).val())){
				valMessage.isValid = false;
				valMessage.msj = "Este campo solo permite números: " + $(this).parent().find("label").text();
				return false;
			}
		}			
	});
	$(contenedor + " input[type='email']").each(function (e) {
		if($(this).val() != ""){
			var filter=/^([a-z0-9-_.]+)@([a-z0-9-_.]+)\.([a-z]{2,3})*$/;
			if(!filter.test($(this).val())){
				valMessage.isValid = false;
				valMessage.msj = "Este campo no tiene formato correcto: " + $(this).parent().find("label").text();
				return false;
			}
		}			
	});
	$(contenedor + " .help-block").each(function (e) {
		if($(this).is(":visible")){
			valMessage.isValid = false;
			valMessage.msj = "Aún presenta errores de validación: " + $(this).parent().find("label").text();
			return false;
		}			
	});
	$(contenedor + " input[type='hidden']").each(function (e) {
		if($(this).val() == "" && $(this).attr('data-required') == 1){
			valMessage.isValid = false;
			valMessage.msj = "Debe completar toda la información para continuar";			
			return false;
		}			
	});
}
/*
jQuery(document).ready(function () {
    KTAdmin.init();
});
*/