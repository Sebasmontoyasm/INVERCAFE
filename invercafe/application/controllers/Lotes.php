<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Lotes extends MY_Controller {

    public function __construct() {
        parent::__construct();

		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
		
        if (!$this->isLogedIn()) {
            //close session
            header('location: ' . site_url());
            exit();
        }

        //hay usuario se envia al dashboard
        $this->GetCurrentUser();
        				
		$this->valida_rol();
    }

    private function valida_rol() {
        if ($this->user->PERFId == 3) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }
	
    public function index() {
        //listar los lotes disponibles
        $this->load->model('clientes_mdl', 'clienteModel');
        $this->load->model('lotes_mdl', 'lotesModel');

		$qryClientes = $this->clienteModel->SeleccionarClientesActivos();
		
		$query = $this->lotesModel->ConsultarLotes("", "", "", "", "", "");
		$lotes = $query->Result();

		$clientes = $qryClientes->Result();
		$lotes = $query->Result();

		$this->tp['clientes'] = $clientes;
		$this->tp['lotes'] = $lotes;
		$this->load->view('crud/lotes', $this->tp);
    }

    public function filtrarLotes() {
		$post = $this->input->post(null, true);
        //listar los lotes disponibles
        $this->load->model('lotes_mdl', 'lotesModel');
		
		$fechaEmbarIni = ($post["hidFechaEmbarqueIni"] == "") ? "" : $post["hidFechaEmbarqueIni"] . "-01";
		$fechaEmbarFin = ($post["hidFechaEmbarqueFin"] == "") ? "" : $post["hidFechaEmbarqueFin"] . "-01";
		$cliente = $post["cmbCliente"];
		$estadoLote = $post["cmbEstadoLote"];
		$estadoFijacion = $post["cmbEstadoFijacion"];
		$estadoFwd = $post["cmbEstadoForward"];
		
		$query = $this->lotesModel->ConsultarLotes($fechaEmbarIni, $fechaEmbarFin, $cliente, $estadoLote, $estadoFijacion, $estadoFwd);
		$lotes = $query->Result();

		$tblLotes = '';

		foreach ($lotes as $indice => $lote) {
			$tblLotes .= 
				'<tr id="tr' . $lote->DETId . '">
					<td>
						<div class="dropdown dropdown-inline" data-placement="left">
							<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="ki ki-bold-more-hor"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
								<!--begin::Navigation-->
								<ul id="menu-lote" class="navi navi-hover py-5">' . 
									($lote->DETKilos != "" ?  
										'<li class="navi-item">
											<a href="#!" class="navi-link" onclick="VerAside(1, ' . $lote->DETId . ')">
												<span class="navi-icon">
													<i class="flaticon2-add"></i>
												</span>
												<span class="navi-text">Numeración lote</span>
											</a>
										</li>' : "") . '
									<li class="navi-item">
										<a href="#!" class="navi-link" onclick="VerAside(2, ' . $lote->DETId . ')">
											<span class="navi-icon">
												<i class="flaticon2-line-chart"></i>
											</span>
											<span class="navi-text">Fijación</span>
										</a>
									</li>' .
									($lote->DETKilos != "" ?
										'<li class="navi-item">
											<a href="#!" class="navi-link" onclick="VerAside(3, ' . $lote->DETId . ')">
												<span class="navi-icon">
													<i class="flaticon2-list"></i>
												</span>
												<span class="navi-text">Forward</span>
											</a>
										</li>' : "") . '
								</ul>
								<!--end::Navigation-->
							</div>
						</div>
					</td>
					<td>
						<span class="text-muted font-weight-bold">' . sprintf("%06d", $lote->CONTId) . '</span>
					</td>
					<td>
						<span class="text-muted font-weight-bold">' . $lote->CONTRefBuyer . '</span>
					</td>
					<td>
						<span class="text-dark-75">' . $lote->CLIENombre. ' </span>
					</td>
					<td>
						<span class="text-dark-75">' . $lote->BRONombre. ' </span>
					</td>
					<td class="text-success font-weight-bolder ' . ($lote->DETNroLote == "" ? "" : "table-success") . ' ">
						' . ($lote->DETKilos != "" ? sprintf("%06d", $lote->DETNroLote) : "Bolsa") . ' 
					</td>
					<td class="text-dark font-weight-bolder">' . $lote->Kilos . ' </td>
					<td class="text-dark font-weight-bolder">' . $lote->DETCantidad  . ' </td>
					<td class="text-dark font-weight-bolder">' . $lote->EqKilos70 . ' </td>
					<td><span class="text-dark font-weight-bolder">' . $lote->Calidad. ' </span><span class="text-muted font-weight-bold d-block">' . $lote->DETDescEspecial . ' </span><span class="text-muted font-weight-bold d-block">' . $lote->Certificacion . ' </span></td>
					<td>
						<span class="text-dark font-weight-bolder">' . $lote->MesEmbarque . " " . $lote->RangoEmbarque . ", " . $lote->CONTAnioEmbarque . ' </span>
						<span class="text-muted font-weight-bold d-block">' . ($lote->TCONId == 2 ? "" : $lote->Posicion . ", " . $lote->CONTAnioPosicion) . ' </span>
						<span class="text-muted font-weight-bold d-block">' . $lote->PuertoEmbarque . ' </span>
					</td>
					<td>' . $lote->DETTipoPrecio. ' </td>
					<td class="text-dark font-weight-bolder">' . $lote->DETUsdLbs . ' </td>
					<td>' . ($lote->Certificacion != $lote->LOTCostoCertificado ? : "") . ' </td>
					<td class="text-success">' . ($lote->DETUsdLbs - $lote->LOTCostoCertificado - ($lote->CONTComisionBroker == "" ? "0" : $lote->CONTComisionBroker)) . ' </td>
					<td class="text-success font-weight-bolder ' . ($lote->LOTFechaFijacion == "" ? "" : "table-success") . ' ">' . $lote->LOTPrecioFijacion . ' </td>
					<td>' . ($lote->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($lote->LOTFechaFijacion))) . ' </td>
					<td>' . $lote->Banco . ' </td>
					<td>' . $lote->Modalidad . ' </td>
					<td>' . number_format($lote->FWDTasaSpot, 0, '.', ',') . ' </td>
					<td>' . number_format($lote->FWDPuntos, 0, '.', ',') . ' </td>
					<td>' . number_format($lote->FWDTasaFinal, 0, '.', ',') . ' </td>
					<td>' . ($lote->FWDFechaFutura == "" ? "" : date("d/m/Y", strtotime($lote->FWDFechaFutura))) . ' </td>
					<td class="text-success font-weight-bolder ' . ($lote->FWDFechaFutura == "" ? "" : "table-success") . ' ">' . number_format($lote->FWDMonto, 0, '.', ',') . ' </td>
				</tr>';
		}

		$output['lotes'] = $tblLotes;
		$output['cant_lotes'] = count($lotes);
		exit(json_encode($output));
    }

    public function VerModalLote() {
		$post = $this->input->post(null, true);
        $this->load->model('contratos_mdl', 'contratModel');
        $this->load->model('lotes_mdl', 'lotesModel');
        $this->load->model('opciones_mdl', 'opcionesModel');

		$qryLotes = $this->lotesModel->ConsultarLote($post["idLote"]);
		$lote = $qryLotes->Row();
		
		$qryContrato = $this->contratModel->ConsultarContratoId($lote->CONTId);
		$qryBancos = $this->opcionesModel->SeleccionarOpcionesTipo(12,1);
		$qryTipoFw = $this->opcionesModel->SeleccionarOpcionesTipo(13,1);

		$this->tp['comisionBroker'] = $qryContrato->Row()->CONTComisionBroker;
		$this->tp['lote'] = $lote;
		$this->tp['bancos'] = $qryBancos->Result();
		$this->tp['tipoForward'] = $qryTipoFw->Result();
		
		if ($post["idAction"] == 1)
			$this->load->view('crud/modal-lotes-numeracion', $this->tp);
		if ($post["idAction"] == 2)
			$this->load->view('crud/modal-lotes-fijacion', $this->tp);
		if ($post["idAction"] == 3)
			$this->load->view('crud/modal-lotes-forward', $this->tp);
	}
	
	public function generarLote() {
		$post = $this->input->post(null, true);
        $this->load->model('lotes_mdl', 'loteModel');
		
		$query = $this->loteModel->GenerarLote($post["idDetalle"]);

		$output['idLote'] = $query->Row()->LOTId;
		$output['msj'] = "Se generó el numero de lote: " . $query->Row()->LOTId;
		
		exit(json_encode($output));
	}
		
	public function liberarLote() {
		$post = $this->input->post(null, true);
        $this->load->model('lotes_mdl', 'loteModel');
		
		$query = $this->loteModel->LiberarLote($post["idDetalle"]);

		//$output['idLote'] = $query->Row()->LOTId;
		$output['msj'] = "Se liberó el numero de lote";
		
		exit(json_encode($output));
	}
	
	public function modificarLote() {
		$post = $this->input->post(null, true);
        $this->load->model('lotes_mdl', 'loteModel');
		
		$query = $this->loteModel->ModificarLote($post["idDetalle"], $post["newLot"]);

		$output = $query->Row();
		//$output['idLote'] = $query->Row()->LOTId;
		//$output['msj'] = "Se modificó el numero de lote";
		
		exit(json_encode($output));
	}
		
	public function fijarPrecio() {
		$post = $this->input->post(null, true);
        $this->load->model('lotes_mdl', 'loteModel');
		
		$query = $this->loteModel->FijarPrecioLote($post["idDetalle"], $post["ctoCertificado"], str_replace(",", "", $post["precioFijacion"]), $post["fechaFijacion"]);

		$output['msj'] = "Se ha establecido la fijación del precio de manera correcta";
		
		exit(json_encode($output));
	}
	
	public function actualizarForward() {
		$post = $this->input->post(null, true);
        $this->load->model('lotes_mdl', 'loteModel');
		
		$query = $this->loteModel->ActualizarForwardLote($post["idDetalle"], $post["cmbBanco"], $post["cmbTipoForward"], str_replace(",", "", $post["txtTasaSpot"]), str_replace(",", "", $post["txtPuntosFwd"]), str_replace(",", "", $post["txtTasaFinal"]), $post["hidFechaFutura"], str_replace(",", "", $post["txtMontoFwd"]));

		$output['msj'] = "Se ha realizado la actualización del forward de manera correcta";
		
		exit(json_encode($output));
	}
}
