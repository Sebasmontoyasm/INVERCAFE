let block = false;
//let page = 0;

window.onload = function(){
	alert(true);
    // cargar items
    loadItems();
}

window.addEventListener("scroll", async function(event) {
    const scrollHeight = this.scrollY;
    const viewportHeight = document.documentElement.clientHeight;
    const moreScroll = document.getElementById('more-row').offsetTop;
    const currentScroll = scrollHeight + viewportHeight;
	
    if((currentScroll >= moreScroll) && block === false){ //cargar más contenido
        block = true;
        this.setTimeout(() =>{

            loadItems();

            block = false;
        }, 2000);
    }
});

async function loadItems(){
    const data = await requestData($("#hidPage").val());
	
    //const response = data[0];

    /*if(response.response === '200'){
        const items = data[1];
        page = data[2].page;

        renderItems(items);
    }else if(response.response === '400'){
        console.error('No hay más tuits');
    }*/
}

function requestData(n){
    /*const url = 'http://localhost/curso/64.%20carga%20infinita/tutorial/api.php?action=more&page=' + n;

    const response = this.fetch(url)
    .then(res => res.json())
    .then(data => data)

    return response;*/
	var fecha = moment($("#hidFechaIni").val());
	var fechaIni = moment($("#hidFechaIni").val());
	var view = $('#frmView').attr("data-view");
	$("#cmbCargarTp").val(0);
	$.ajax({
		dataType: "json",
		data: $("form").serialize(),
		url:   HOST_URL + view + '/index/' + fecha.format('yyyy-M-D'),
		type:  'post',
		beforeSend: function(){
		//Lo que se hace antes de enviar el formulario
		},
		success: function(data, status, xhr){
			if(view == "reportes"){
				//page++;
				PintarTableReportes(data, fecha, fechaIni, $("#hidPage").val());
			}
		},
		error:	function(xhr,err){ 
			location.reload();
		}
	});					
	
}

function renderItems(data){
    let tblCitas = document.querySelector('#tbl-citas');
    data.forEach(element => {
		
        /*tblCitas.innerHTML += `
            <div class="tuit">
                <div class="profile">
                    <img src="img/${element.username_photo}" alt="">
                </div>
                <div class="content">
                    <div class="author">
                        <span class="name">${element.name}</span>
                        <span class="username">@${element.username}</span>
                    </div>
                    <div class="text">
                    ${element.text}
                    </div>
                    <div class="image">
                        <img src="img/${element.image}"  alt="">
                    </div>
                </div>
            </div>
        `;*/
    });
}

function PintarTableReportes(data, fecha, fechaIni, page) {
	//panel reporte de citas preliminar
	$("#hidPage").val(page + 1);
	$('#panel-reporte-citas h3 span:eq(0) span').html(fecha.format('D') + ' de ' + fecha.format('MMMM'));
	$('#panel-reporte-citas h3 span:eq(2)').html("Cantidad de agendas encontradas: " + data.total_citas);
	//tabla reporte de citas de hoy
	var addTr = "";
	for (var i = 0; i < data.citas.length; i++) {
		var cita = data.citas[i];
		addTr += '<tr>';
		addTr += '<td class="text-right">';
		addTr += '<span class="text-dark-75">' + cita.CITPaciente + '</span>';
		addTr += '<div><span class="text-muted font-weight-bold">' + cita.CITCedulaPaciente + '</span></div>';
		addTr += '</td>';
		addTr += '<td class="text-right">';
		addTr += '<span class="text-muted font-weight-bold">' + cita.CITTelefono + '</span>';
		addTr += '</td>';
		addTr += '<td class="text-right">';
		addTr += '<span class="text-dark-75">' + cita.CITSede + '</span>';
		addTr += '<div><span class="font-weight-bolder">' + cita.CITMedico + '</span></div>';
		addTr += '<div><span class="text-muted">' + cita.CITEspecialidad + '</span></div>';
		addTr += '</td>';
		addTr += '<td class="text-right">';
		addTr += '<span class="text-muted">' + cita.CITHoraCita + '</span>';
		addTr += '</td>';
		addTr += '<td>';
		addTr += '<span class="' + (cita.ESTDescripcion == null ? "" : 'text-' + cita.ESTColor) + '">' + (cita.ESTDescripcion == null ? "" : cita.ESTDescripcion) + '</span>';
		addTr += '</td>';
		addTr += '<td>';
		addTr += (cita.CITEstado >= 1) ? '<div class="dropdown dropdown-inline"><a href="#!" class="btn btn-sm btn-clean btn-icon mr-2" onclick="VerChat(' + cita.CITId + ')"><span class="icon-lg fab fa-whatsapp"></span></a></div>' : '';
		addTr += '</td>';
		addTr += '</tr>';
	}
	$('#dt-tbl-reporte-citas tbody').append(addTr);
	initDTCitas();
}

function initDTCitas() {
	var datatable = $('#dt-tbl-reporte-citas').KTDatatable({
	  data: {
		saveState: {cookie: false},
	  },
	  search: {
		input: $('#kt_datatable_search_query'),
		key: 'generalSearch',
	  },
	  layout: {
		class: 'datatable-bordered',
	  },
	  pagination: false,
	  sortable: false
	});

	$('#kt_datatable_search_status').on('change', function() {
	  datatable.search($(this).val().toLowerCase(), 'ESTADO');
	});

	$('#kt_datatable_search_status').selectpicker();

}
