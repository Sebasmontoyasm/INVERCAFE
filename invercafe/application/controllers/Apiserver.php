<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Apiserver extends RestController {
	
    public function __construct() {
        parent::__construct();
		
		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
		
		$this->APIUrl = 'https://www.plazbot.com/';
    }

    public function test_get() {		
        $output = array(
            'status' => "ok",
            'message' => "servicio web service online"
        );
		
		$this->response($output);
    }
	
    public function sendMessageServiceTemplate_post() {
//    public function sendMessageServiceTemplate_get() {
        $output = array(
            'status' => "error",
            'message' => "Se detectaron parametros vacios"
        );

		if($this->input->get("mobile") != "" && $this->input->get("clientId") != "" && $this->input->get("serviceId")) {
			$this->load->model('api_mdl', 'apiModel');
			$query = $this->apiModel->ConsultarApiPlazbot();
			$rsApi = $query->Row();

			$this->load->model('ips_mdl', 'ipsModel');
			$query = $this->ipsModel->SeleccionarXbot($this->input->get("clientId"));
			$rsIps = $query->Row();
			
			if(is_null($rsIps)){
				$output = array(
					'status' => "error",
					'message' => "El 'clientId' suministrado no corresponde a una IPS valida"
				);
			} else {
				$codigoBot = $rsIps->IPSCodigoBot;
				$plantilla = $rsIps->IPSPlantillaCallbot;
				$celular = $this->input->get("mobile");

				$parametros = $rsIps->IPSParametros;
				$parametros = str_replace("{bot}", $codigoBot, $parametros);
				$parametros = str_replace("{plantilla}", $plantilla, $parametros);
				$parametros = str_replace("{telefono}", $celular, $parametros);
				$parametros = str_replace("{paciente}", $rsIps->IPSChatbot, $parametros);
				$parametros = str_replace("{robot}", $rsIps->IPSNombre, $parametros);
				$parametros = str_replace("{ips}", $rsIps->IPSLinkPolitica, $parametros);
//				$parametros = str_replace("{especialidad}", "Especialidad Prueba", $parametros);
//				$parametros = str_replace("{pin}", "123456", $parametros);

				if(strlen($celular) <> 12){
					$output = array(
						'status' => "error",
						'message' => "El 'mobile' suministrado no tiene la longitud permitida, 12 caracteres"
					);
				} else {
					$this->apiModel->EnviarMensajePlantilla($rsApi->APITemplateHsm, $codigoBot, $plantilla, $celular, $parametros);
					
					$output = array(
						'status' => "ok",
						'message' => "Mensaje enviado exitosamente"
					);
				}
			}
		} 
		$this->response($output);
    }
}
