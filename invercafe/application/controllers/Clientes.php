<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Clientes extends MY_Controller {

    public function __construct() {
        parent::__construct();

		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
		
        if (!$this->isLogedIn()) {
            //close session
            header('location: ' . site_url());
            exit();
        }

        //hay Cliente se envia al dashboard
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
        //listar los clientes disponibles
        $this->load->model('clientes_mdl', 'clienteModel');
		$query = $this->clienteModel->ConsultarClientes();
        $rtaClie = $query->Result();
		
        $this->tp['clientes'] = $rtaClie;
        $this->load->view('crud/clientes', $this->tp);
    }

    public function actualizarEstado() {
		$post = $this->input->post(null, true);
		
        $this->load->model('clientes_mdl', 'clienteModel');
		$query = $this->clienteModel->ActualizarClienteEstado($post["idReg"], $post["idEstado"]);

		$output['msj'] = "Se ha cambiado el estado de manera satisfactoria.";
		
		exit(json_encode($output));
    }

    public function verModalClientes($Params = "") {
		$this->load->model('clientes_mdl', 'clnModel');
		$cliente = array();
        $countries = array();
        
		if($Params != ""){
			$query = $this->clnModel->ConsultarClientesId($Params);
			$cliente = $query->Row();
          
		}	

        $query = $this->clnModel->ConsultarCountriesActivos($Params);
        $countries = $query->result();
        
		$this->tp['cliente'] = $cliente;
        $this->tp['countries'] = $countries;
		$this->load->view('crud/modal-clientes', $this->tp);
	}
	
	
	public function guardarCliente() {
		$post = $this->input->post(null, true);
		$this->load->model('clientes_mdl', 'clienteModel');
		$query = $this->clienteModel->ActualizarCliente($post["hidIdCliente"], $post["cmbPerfil"], trim($post["txtUserName"]), trim($post["txtPassword"]), trim($post["txtEmail"]), trim($post["txtNames"]), trim($post["txtLastNames"]), $post["hidIdEstado"]);
		
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
		
}
