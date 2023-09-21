<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//use Exception;
//use stdClass;

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        //$this->load->helper('utils');
        //Sesion nativa de php : 
        //http://www.moreofless.co.uk/using-native-php-sessions-with-codeigniter/
        $this->load->library('sess');

        $this->tp = array();
        $this->tp['site_url'] = $this->config->site_url() . '';
        $this->tp['base_url'] = base_url();
        $this->tp['template'] = base_url() . 'assets/';

		$arrUri = explode("/", $_SERVER["REQUEST_URI"]);
        $this->tp['srcipt_name'] = $arrUri[count($arrUri)-1];

        //accesos API keys Plazbot

        //vigencias para plasticos
        $this->RefSesion = '-inver-cafe';
    }

    public function isLogedIn() {

        if ($this->sess->get('loged' . $this->RefSesion) && intval($this->sess->get('logedTime' . $this->RefSesion)) + (60 * 120) > time()) {

            $this->rolId = $this->sess->get('RolId' . $this->RefSesion);
            $this->userId = $this->sess->get('UserId' . $this->RefSesion);
            return true;
        } else {
            $this->sess->delete('loged' . $this->RefSesion);
            $this->sess->delete('logedTime' . $this->RefSesion);
            $this->sess->delete('RolId' . $this->RefSesion);
            $this->sess->delete('UserId' . $this->RefSesion);

            return false;
        }
    }

    public function miFecha($fecha, $formato = '{m} {d} {Y}') {
        if ($fecha != '0000-00-00') {
            $fechac = explode("-", $fecha);  // declaro el array
            $mes = $fechac[1];
            $dia = substr($fechac[2], 0, 2);
            $ano = $fechac[0];


            $mesArray = array();
            $mesArray['01'] = "Enero";
            $mesArray['02'] = "Febrero";
            $mesArray['03'] = "Marzo";
            $mesArray['04'] = "Abril";
            $mesArray['05'] = "Mayo";
            $mesArray['06'] = "Junio";
            $mesArray['07'] = "Julio";
            $mesArray['08'] = "Agosto";
            $mesArray['09'] = "Septiembre";
            $mesArray['10'] = "Octubre";
            $mesArray['11'] = "Noviembre";
            $mesArray['12'] = "Diciembre";

            $mesReturn = $mesArray[$mes];
            //
            $formato = str_replace('{m}', $mesReturn, $formato);
            $formato = str_replace('{d}', $dia, $formato);
            $formato = str_replace('{Y}', $ano, $formato);
            return $formato;
        } else {
            return '';
        }
    }

    public function GetCurrentUser() {
        $this->load->model('usuarios_mdl', 'usuariosModel');
        $query = $this->usuariosModel->ConsultarUsuarioId($this->sess->get('RolId' . $this->RefSesion), $this->sess->get('UserId' . $this->RefSesion));
        $this->user = $query->Row();
        $this->tp['user_id'] = $this->user->USRId;
        $this->tp['user_username'] = $this->user->nameComplete;
        $this->tp['user_uname'] = $this->user->UserName;
        $this->tp['user_email'] = $this->user->Email;
        $this->tp['user_rolid'] = $this->user->PERFId;
    }
	
}

require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';
