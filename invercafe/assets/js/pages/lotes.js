"use strict";

// Class definition
var KTLotes = function () {
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

    var _initMonthpicker = function () {
        if ($('.select-monthpicker').length == 0) {
            return;
        }
				
        var picker = $('.select-monthpicker');
		var fechaIni = new Date();
		var fechaFin = new Date();
		fechaFin.setDate(fechaFin.getDate() + 15);
        picker.datepicker({
            rtl: KTUtil.isRTL(),
			format: "yyyy-mm",
			startView: "months",
			minViewMode: "months",
			autoclose: true,
			startDate: "2021-01",
            orientation: "auto bottom",
            templates: arrows
        }).on('changeDate', function(e) {
			var fecha = moment($(this).find("input:eq(0)").val());
						
            //title
            $(this).find("span:eq(0)").html("");
            //date
			$(this).find("span:eq(1)").html(fecha.format('MMM yyyy'));

			if ($(this).attr("id") == "dtDesde") {
				$("#dtHasta").datepicker("setStartDate", $(this).find("input:eq(0)").val());
				$("#dtHasta").datepicker("show");
			}
			if ($(this).attr("id") == "dtHasta") {
				filtrarLotes();
			}
		});
    }

    var _initSelectPicker = function () {
        // minimum setup
        $('.live-search').selectpicker();
    }

	function PintarLotes(data, fecha, fechaIni) {
		//panel reporte de citas preliminar
		$('#panel-listado-lotes h3 span:eq(0) span').html(fecha.format('D') + ' de ' + fecha.format('MMMM'));
		$('#panel-listado-lotes h3 span:eq(2)').html("Cantidad de lotes encontrados: " + data.cant_citas);
				
		var table = $('#dt-tbl-lotes-citas').DataTable();
		table.clear();
		table.draw();
		table.destroy();

		$('#dt-tbl-lotes tbody').html(data.citas);
		table = _initDTLotes();
	}
		
	var _initDTLotes = function() {
		// begin first table
		$('#dt-tbl-lotes').DataTable({
			//responsive: true,
			fixedHeader: true,
			// DOM Layout settings
			dom: `<'row'<'col-md-4 my-2 my-md-0'f>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
			stateSave: true,
			lengthMenu: [5, 10, 20, 30, 50, 100],
			ordering: false,
			pageLength: 20,

			language: {
				'lengthMenu': 		'Registros _MENU_',
				'sSearch':         	"Buscar:",
				'sInfo':           	"Registros _START_ a _END_ de _TOTAL_ lotes",
				'sInfoEmpty':      	"Registros 0 a 0 de 0 lotes",
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

		$('#dt-tbl-lotes_filter').removeClass("dataTables_filter").addClass("d-flex align-items-center");
		$('#dt-tbl-lotes_filter input').removeClass("form-control-sm");
		$('#dt-tbl-lotes_filter label').addClass("mr-3 mb-0 d-none d-md-block");
	};

	var _initTipif = function () {
		// User listing
		var cardScrollEl = KTUtil.find(_tipiAsideEl, '.scroll');
        var header = KTUtil.find(_tipiAsideEl, '.card-header');
		
		KTUtil.scrollInit(cardScrollEl, {
			mobileNativeScroll: true,  // Enable native scroll for mobile
			desktopNativeScroll: false, // Disable native scroll and use custom scroll for desktop
			resetHeightOnDestroy: true,  // Reset css height on scroll feature destroyed
			handleWindowResize: true, // Recalculate hight on window resize
			rememberPosition: true, // Remember scroll position in cookie
			height: function() {  // Calculate height
				var height = parseInt(KTUtil.getViewPort().height);
				
				if (header) {
					height = height - parseInt(KTUtil.actualHeight(header));
					height = height - parseInt(KTUtil.css(header, 'marginTop'));
					height = height - parseInt(KTUtil.css(header, 'marginBottom'));
				}

				if (cardScrollEl) {
					height = height - parseInt(KTUtil.css(cardScrollEl, 'marginTop'));
					height = height - parseInt(KTUtil.css(cardScrollEl, 'marginBottom'));
				}

				height = height - parseInt(KTUtil.css(_tipiAsideEl, 'paddingTop'));
				height = height - parseInt(KTUtil.css(_tipiAsideEl, 'paddingBottom'));

				height = height - 5;

				return height;
			}
		});
	}

    var _repaintLotes = function () {
        var el = document.getElementById("cmbCliente");
        var e2 = document.getElementById("cmbEstadoFijacion");
        var e3 = document.getElementById("cmbEstadoLote");
        var e4 = document.getElementById("cmbEstadoForward");

        if (!(el || e2 || e3 || e4)) {
            return;
        }
		
        KTUtil.addEvent(el, 'change', function(e) {
			filtrarLotes();
        });

        KTUtil.addEvent(e2, 'change', function(e) {
			filtrarLotes();
        });

        KTUtil.addEvent(e3, 'change', function(e) {
			filtrarLotes();
        });
		
        KTUtil.addEvent(e4, 'change', function(e) {
			filtrarLotes();
        });
		
    }

	function filtrarLotes() {
		$('#panel-listado-lotes .card-body').append('<div class="overlay-layer bg-dark-o-10"><div class="spinner spinner-primary"></div></div>');

		var view = $('#frmView').attr("data-view");
		$.ajax({
			dataType: "json",
			data: $("#frmView").serialize(),
			url:   HOST_URL + view + '/filtrarLotes',
			type:  'post',
			beforeSend: function(){
			//Lo que se hace antes de enviar el formulario
			},
			success: function(data, status, xhr){
				PintarLotes(data);
				$('#panel-listado-lotes .overlay-layer').remove();
			},
			error:	function(xhr,err){ 
				location.reload();
			}
		});
	}
	
	function PintarLotes(data) {
		//panel reporte de citas preliminar
		$('#panel-listado-lotes h3 span:eq(1)').html("Se encontraron " + data.cant_lotes + " lotes disponibles");
		
		var table = $('#dt-tbl-lotes').DataTable();
		table.clear();
		table.draw();
		table.destroy();

		$('#dt-tbl-lotes tbody').html(data.lotes);
		table = _initDTLotes();
	}

    return {
		init: function () {
            _initDTLotes();
			_initMonthpicker();
			_initSelectPicker();
			_repaintLotes();
		},
		
		initTipif: function () {
			_tipiAsideEl = KTUtil.getById('kt_tipif_aside');

			// Init aside and user list
			_initTipif();
		}		
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTLotes;
}

function VerAside(idAction, idLote = "") {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");
	var metodo = 'VerModalLote';
	
	$('#kt_quick_cart .card-custom').html("");
	$.ajax({
		dataType: "text",
		data: {
			"idLote": idLote,
			"idAction": idAction
		},
		url:   HOST_URL + view + '/' + metodo,
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			$("#tr" + idLote).addClass("bg-light-primary");
			$('#kt_tipif_aside .card-custom').html(data);
			$('#kt_tipif_aside').parent().append('<div class="offcanvas-overlay"></div>');
			$('#kt_tipif_aside').removeClass("d-none");
			KTLotes.initTipif();
		},
		error:	function(xhr,err){ 
			//location.reload();
		}
	});
}

function CerrarAside(id) {
	var view = $('#frmView').attr("data-view");
	var context = "cerrarModalTipificador";
	$('.offcanvas-overlay').remove();
	$('#kt_tipif_aside').addClass("d-none");
	$("#tr" + id).removeClass("bg-light-primary").removeClass("bg-light-warning");
	$('#kt_quick_cart .card-custom').html("");
}

$(function() {
	var view = $('#frmView').attr("data-view");
	var context = $('#frmView').attr("data-context");
});


jQuery(document).ready(function () {
    KTLotes.init();
});
