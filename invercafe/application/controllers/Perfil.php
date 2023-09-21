<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Perfil extends MY_Controller {

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
    }

    private function valida_rol() {
        if ($this->user->IPSId > 0) {
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

		$this->load->view('perfil/inicio', $this->tp);
    }
	
    public function guardarCuenta() {
		$post = $this->input->post(null, true);
        $this->load->model('usuarios_mdl', 'usuariosModel');
		$query = $this->usuariosModel->ActualizarUsuarioCredenciales($this->user->USRId, trim($post["txtNombreUsuario"]), trim($post["txtEmail"]));
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
	
    public function guardarContrasena() {
		$post = $this->input->post(null, true);
        $this->load->model('usuarios_mdl', 'usuariosModel');
		$qryPasswd = $this->usuariosModel->CompararUsuarioContrasena($this->user->USRId, trim($post["txtActualPasswd"]));
		$rsPasswd = $qryPasswd->Row();
		
		//si paso validacion de comparacion de contraseña antigua, procedo a modificar la contraseña
		if($rsPasswd->USRId > 0)
			$query = $this->usuariosModel->ActualizarUsuarioContrasena(trim($post["txtNuevoPasswd"]), $this->user->USRId);
		
		$output['msj'] = $rsPasswd->Mensaje;
		
		exit(json_encode($output));
	}
		
}