<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Comex extends MY_Controller {

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
		$post = $this->input->post(null, true);

        $this->load->model('contratos_mdl', 'contratModel');
        $this->load->model('lotes_mdl', 'lotesModel');
		$this->load->model('clientes_mdl', 'clienteModel');
		
		$qryBrokers = $this->clienteModel->SeleccionarBrokersActivos();
		$fecha = (isset($fecha) && $fecha != "") ? $fecha : date('Y-m-d');

		$brokers = $qryBrokers->Result();
		
		$contrato = array();
		$detalleVenta = array();
		if($post["idLote"] != ""){
			$query = $this->contratModel->ConsultarContratoId($post["idLote"]);
			$contrato = $query->Row();
			//detalle de la venta
			$query = $this->lotesModel->ConsultarLotesContrato($post["idLote"]);
			$detalleVenta = $query->Result();			
		}
		$this->tp['brokers'] = $brokers;
		$this->tp['fecha_hoy'] = $fecha;
		$this->tp['contrato'] = $contrato;
		$this->tp['detalleVenta'] = $detalleVenta;
		$this->tp['cantLotes'] = $detalleVenta[0]->contLotes;
		$this->tp['promFinalPond'] = $detalleVenta[0]->promPond;
        $this->load->view('crud/comex', $this->tp);
    }

    public function actualizarEstado() {
		$post = $this->input->post(null, true);
		
        $this->load->model('clientes_mdl', 'clienteModel');
		$query = $this->clienteModel->ActualizarClienteEstado($post["idReg"], $post["idEstado"]);

		$output['msj'] = "Se ha camabiado el estado de manera satisfactoria.";
		
		exit(json_encode($output));
    }

    public function verModalComex($Params = "") {
        $this->load->model('contratos_mdl', 'contratModel');
		$this->load->model('clientes_mdl', 'clienteModel');
		
		$qryBrokers = $this->clienteModel->SeleccionarBrokersActivos();
		$fecha = (isset($fecha) && $fecha != "") ? $fecha : date('Y-m-d');

		$brokers = $qryBrokers->Result();
		
		$contrato = array();
		$detalleVenta = array();
		if($Params != ""){
			$query = $this->contratModel->ConsultarContratoId($Params);
			$contrato = $query->Row();
			//detalle de la venta
			$query = $this->contratModel->ConsultarDetalleVentaId($Params);
			$detalleVenta = $query->Result();			
		}
		$this->tp['brokers'] = $brokers;
		$this->tp['fecha_hoy'] = $fecha;
		$this->tp['contrato'] = $contrato;
		$this->tp['detalleVenta'] = $detalleVenta;
		$this->tp['cantLotes'] = $detalleVenta[0]->contLotes;
		$this->tp['promFinalPond'] = $detalleVenta[0]->promPond;
		$this->load->view('crud/modal-comex', $this->tp);
	}
	
	public function guardarUsuario() {
		$post = $this->input->post(null, true);
		$this->load->model('usuarios_mdl', 'usrModel');
		$query = $this->usrModel->ActualizarUsuario($post["hidIdUsuario"], $post["cmbPerfil"], trim($post["txtUserName"]), trim($post["txtPassword"]), trim($post["txtEmail"]), trim($post["txtNames"]), trim($post["txtLastNames"]), $post["hidIdEstado"]);
		
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
		
}
