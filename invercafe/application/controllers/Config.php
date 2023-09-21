<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Config extends MY_Controller {

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
	
    public function index() {		
        setlocale(LC_TIME, "spanish");
		if(isset($post["hidFechaIni"]) && $post["hidFechaIni"] != ""){
			$fechaIni = $post["hidFechaIni"];
			$fechaFin = $post["hidFechaFin"];
			//$cargaTp = false;
		} else {
			$fechaIni = $fechaFin = date('Y-m-d');
		}
		//listado de minutos permitados para concelacion/confirmacion
		//$minutos = array(60,120,180,240,300);
		$horario = array(
				'12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM',
				'07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM');

		$this->tp['ipsActual'] = $this->ips;
		//$this->tp['minutos'] = $minutos;
		$this->tp['horario'] = $horario;

		$this->load->view('config/inicio', $this->tp);
    }
	
    public function guardarConfig1() {
		$post = $this->input->post(null, true);
		$this->load->model('ips_mdl', 'ipsModel');
		$query = $this->ipsModel->GuardarConfiguracionPublica($post["cmbDiasRecordar"], $post["cmbHorarioHasta"], $this->ips->IPSId);
		
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
	
}