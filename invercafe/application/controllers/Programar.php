<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Programar extends MY_Controller {

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
        
		$arrVal = $this->GetValoresDefectoIps();
		
		$this->ips = $arrVal['ips'];
		
        $this->valida_rol();		
    }

    private function valida_rol() {
        if ($this->user->PERFId == 3) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }	
	
    public function diario() {		
        setlocale(LC_TIME, "spanish");
		if(isset($post["hidFechaIni"]) && $post["hidFechaIni"] != ""){
			$fechaIni = $post["hidFechaIni"];
			$fechaFin = $post["hidFechaFin"];
			//$cargaTp = false;
		} else {
			$fechaIni = $fechaFin = date('Y-m-d');
		}
        //listar las programaciones disponibles
        $this->load->model('programacion_mdl', 'progModel');
		$query = $this->progModel->SeleccionarProgramacionProxima($this->ips->IPSId);
        $rtaProg = $query->Result();
		
		$this->tp['programacion'] = $rtaProg;

		$this->load->view('programar/diario', $this->tp);
    }
	
    public function futuro() {
        setlocale(LC_TIME, "spanish");
		if(isset($post["hidFechaIni"]) && $post["hidFechaIni"] != ""){
			$fechaIni = $post["hidFechaIni"];
			$fechaFin = $post["hidFechaFin"];
			//$cargaTp = false;
		} else {
			$fechaIni = $fechaFin = date('Y-m-d');
		}
        //listar las programaciones disponibles
        $this->load->model('programacion_mdl', 'progModel');
		$query = $this->progModel->SeleccionarProgramacionFuturaProxima($this->ips->IPSId);
        $rtaProg = $query->Result();
		
		$this->tp['programacion'] = $rtaProg;

		$this->load->view('programar/futuro', $this->tp);
    }
	
    public function guardarProgramacion() {
		$post = $this->input->post(null, true);
		if($post["context"] == "diario") {
			$arrConsultorios = str_replace("]", "", str_replace("[", "", str_replace("\"", "", json_encode($post["consultorio"]))));
			
			$this->load->model('programacion_mdl', 'progModel');
			$query = $this->progModel->GuardarProgramacion($post["hidIdProg"], $this->ips->IPSId, $post["hidFechaProg"], $arrConsultorios);
		}
		if($post["context"] == "futuro") {			
			$this->load->model('programacion_mdl', 'progModel');
			$query = $this->progModel->GuardarProgramacionFutura($post["hidIdProg"], $this->ips->IPSId, $post["hidFechaIni"], $post["hidFechaFin"]);
		}
	}
	
    public function verModalDiario($idProg = "") {
		$prog = array();
		$consultorios = array();
		//$ips = $this->getIPS($this->idIps);
		if($idProg != ""){
			$this->load->model('programacion_mdl', 'progModel');
			$query = $this->progModel->SeleccionarProgramacionId($idProg);
			$prog = $query->Row();
			$consultorios = explode(",",$prog->PRGConsultorios);
		}
		$this->tp['prog'] = $prog;
		$this->tp['intervalo'] = $this->ips->IPSIntervaloDia;
		$this->tp['consultorios'] = $consultorios;
		$this->load->view('programar/modal-diario', $this->tp);
	}
	
    public function verModalFuturo($idProg = "") {
		$prog = array();
		//$ips = $this->getIPS($this->user->USRId);
		if($idProg != ""){
			$this->load->model('programacion_mdl', 'progModel');
			$query = $this->progModel->SeleccionarProgramacionFuturaId($idProg);
			$prog = $query->Row();
		}
		$this->tp['prog'] = $prog;
		$this->tp['intervalo'] = $this->ips->IPSIntervaloDia;
		$this->load->view('programar/modal-futuro', $this->tp);
	}
	
}