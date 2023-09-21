<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Monitor extends MY_Controller {

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
		$this->arrVal = $this->GetValoresDefectoIps();
    }

    private function valida_rol() {
        if ($this->user->RolId > 0) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }
	
    public function index($fecha = "") {
        setlocale(LC_TIME, "spanish");
        //listar las programaciones disponibles
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarTotalCitasExtraccion();
        $rtaProg = $query->Result();
		
		$this->tp['extraccion'] = $rtaProg;

		$this->load->view('monitor/inicio', $this->tp);
		
    }
		
}