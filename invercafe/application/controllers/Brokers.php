<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Brokers extends MY_Controller {

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
        //listar los brokers disponibles
        $this->load->model('brokers_mdl', 'brokerModel');
		$query = $this->brokerModel->ConsultarBrokers();
        $rtaBrok = $query->Result();
		
        $this->tp['brokers'] = $rtaBrok;
        $this->load->view('crud/brokers', $this->tp);
    }

    public function actualizarEstado() {
		$post = $this->input->post(null, true);
		
        $this->load->model('brokers_mdl', 'brokerModel');
		$query = $this->brokerModel->ActualizarBrokerEstado($post["idReg"], $post["idEstado"]);

		$output['msj'] = "Se ha camabiado el estado de manera satisfactoria.";
		
		exit(json_encode($output));
    }

    public function verModalBrokers($Params = "") {
		$this->load->model('brokers_mdl', 'broModel');

		$broker = array();
        $countries = array();
        
		if($Params != ""){
			$query = $this->broModel->ConsultarBrokerId($Params);
			$broker = $query->Row();
		}

        $query = $this->broModel->ConsultarCountriesActivos($Params);
        $countries = $query->result();
		$this->tp['broker'] = $broker;
        $this->tp['countries'] = $countries;
		$this->load->view('crud/modal-brokers', $this->tp);
	}
	
	public function guardarBroker() {
		$post = $this->input->post(null, true);
		$this->load->model('brokers_mdl', 'brokerModel');
        $query = $this->brokerModel->ActualizarBroker($post["hidIdBroker"], $post["cmbPaises"], trim($post["txtNames"]), trim($post["txtContacto"]), trim($post["txttelefono"]), trim($post["txtCiudad"]),  trim($post["txtEmail"]), trim($post["txtDireccion"]));
		
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
		
}
