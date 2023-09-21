<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {

	public function index() {

		$method = $_SERVER["REQUEST_METHOD"];
		$mensaje = '';

		if($method == "POST"){

			$post = file_get_contents("php://input");
			//$post = $this->input->post(null, true);
			
			//var_dump($post);
			$qryResult = json_decode($post, true);
						
			if (isset($qryResult["queryResult"]["action"])) {
				$this->processMessage($qryResult);
			}		 
		}
		
		//este codigo para pruebas por http
		if($method == "GET"){
			if ($mensaje == 1) {
				$mensaje = 'Usuario o contraseña incorrectos, intentelo nuevamente';
			}

			$this->tp['mensaje'] = $mensaje;

			if (!$this->isLogedIn()) {
				//no hay usuario envia al login
				$this->load->view('inicio/login', $this->tp);
			} else {
				$this->GetCurrentUser();
				if ($this->tp['user_rolid'] == 1) {
					header('location:' . $this->tp['site_url'] . 'admin/');
				/*}elseif( $this->user->RolId == 3 || $this->user->RolId == 6 || $this->user->RolId == 10){
					header('location:' . $this->tp['site_url'] . 'consultas');
				}elseif( $this->user->RolId == 4 || $this->user->RolId == 5 || $this->user->RolId == 7 || $this->user->RolId == 9){
					header('location:' . $this->tp['site_url'] . 'estadisticas');
				} else {
					//echo 'vista de super administrador';	*/
				}
			}
		}		
	}

	private function processMessage($qryResult) {
		
		$responseId = $qryResult["responseId"];
		$params = $qryResult["queryResult"]["parameters"];
		$session = explode("/", $qryResult["session"]);;
		$telIPS = explode("-", $session[4]);
		$telFrom = $telIPS[0];
		$ipsFrom = $telIPS[1];
		
        $this->load->model('api_mdl', 'apiModel');
        $query = $this->apiModel->ConsultarApiPlazbot();
        $rsApi = $query->Row();

        $this->load->model('ips_mdl', 'ipsModel');
        $query = $this->ipsModel->SeleccionarXbot($ipsFrom);
        $rsIps = $query->Row();

		//$chatId = $fromMessage["id"];

		//validacion cuando se recibe un PIN 
		if($qryResult["queryResult"]["action"] == "actValidaPIN"){
			$idPin = $params["pin"];
			
			$this->load->model('citas_mdl', 'citasModel');
			
			$qryRta = $this->citasModel->SeleccionarDetalleCita($idPin, $telFrom, $ipsFrom);			
			$rsRta = $qryRta->Row();
			
			if($telFrom != "") {
				if($rsRta->RtaId == -1 || $rsRta->RtaId == 0) {
					$rtaFulFillmentText = $rsRta->RtaMensaje;
					$this->sendMessage(array(
						"fulfillmentText" => $rtaFulFillmentText,
						//"fulfillmentText" => "Respuesta:" . json_encode($fromMessage),
					));
				} else {
					$rtaFulFillmentText = "El numero de PIN " . $idPin . ", corresponde a la siguiente cita:\n\n"
					. "Nombre del Paciente: " . $rsRta->CITPaciente ."\n"
					. "Fecha de la cita: " . date('d/m/Y', strtotime($rsRta->CITFechaCita)) . " a las " . $rsRta->CITHoraCita ."\n"
					. "Especialidad: " . $rsRta->CITEspecialidad . "\n"
					. ($rsRta->CITMedico == "" ? "" : "Doctor: " . $rsRta->CITMedico . "\n")
					. "Sede: " . $rsRta->CITSede . "\n"
					. "Dirección: " . $rsRta->CITDireccion;
					$this->apiModel->EnviarMensaje($rsApi->APISendMessage, $ipsFrom, $telFrom, $rtaFulFillmentText, 2, $rsIps->IPSCodigoPlazbot);
					$this->apiModel->EnviarRespuestaRapida($rsApi->APISendQuickReply, $ipsFrom, $telFrom, "Recordatorio de cita", "Por favor confirma tu asistencia seleccionando 'Si' o 'No'", "¿Asistirás?", '[ { "itemMostrar": "Si", "itemValor": "S1As1st1r3|' . $rsRta->CITId . '" }, { "itemMostrar": "No", "itemValor": "N0As1st1r3|' . $rsRta->CITId . '" } ]');
				}
			} else {
				$rtaFulFillmentText = "Lo siento pero la verificación de citas a través de PIN, se hace solo por WhatsApp";
				$this->sendMessage(array(
					"fulfillmentText" => $rtaFulFillmentText,
					//"fulfillmentText" => "Respuesta: " . json_encode($qryResult),
				));
			}
		}
		
		//validacion cuando se recibe respuesta si se asiste o no se asiste 
		if($qryResult["queryResult"]["action"] == "actAsistirCita"){
			$continuar = $params["rtaAsistencia"];
			$rowId = explode("|", $params["rtaRowId"]);
			$this->load->model('citas_mdl', 'citasModel');
			
			if($continuar == "SI") {
				$this->citasModel->ActualizarEstadoCita($rowId[1], 1, "Paciente confirma asistencia", 0);
				//$qryRta = $this->cargaModel->ActualizarContinuarCargaTelegram($rowId[1],1);
				$rtaFulFillmentText = "Muchas gracias por confirmar tu asistencia, Por favor ten en cuenta las siguientes recomendaciones:\n\n"
				. "* Estar 20 min antes de la hora programada para su cita.\n"
				. "* El uso del tapabocas es de carácter obligatorio.\n"
				. "* No se permite el ingreso de acompañantes.\n"
				. "* En lo posible, no llevar elementos que sean foco de contaminación.\n"
				. "* Contar con disponibilidad de tiempo.\n\n"
				. "¿Te puedo ayudar con algo más?";
			} else {
				$this->citasModel->ActualizarEstadoCita($rowId[1], 3, "Paciente no asistirá", 0);
				//$qryRta = $this->cargaModel->ReprogramarCargaTelegram($rowId[1], "Usuario desea reprogramar");
				$rtaFulFillmentText = "Muchas gracias. Comunicaré a nuestros Centro de Servicios que has decidido NO asistir a la cita.\n\n¿Te puedo ayudar con algo más?";
			}
			//$rsRta = $qryRta->Row();
			
			//creamos el mensaje a mostrar al usuario
			$this->sendMessage(array(
				"fulfillmentText" => $rtaFulFillmentText,
				//"fulfillmentText" => "Respuesta:" . json_encode($fromMessage),
			));				
		}		
	}

	private function sendMessage($parameters) {
		exit(json_encode($parameters));
	}

    private function GetCurrentUser() {

        $this->load->model('usuarios_mdl', 'usuariosModel');
        $query = $this->usuariosModel->ConsultarUsuarioId($this->sess->get('UserId' . $this->RefSesion));
        $this->user = $query->Row();
        
        $this->tp['user_username'] = $this->user->IPSNombre;
        $this->tp['user_email'] = $this->user->USREmail;
        //$this->tp['user_rolid'] = $this->user->RolId;
        $this->tp['user_rolid'] = 1;
    }


    public function phpin() {
        echo phpinfo();
    }

}

/* ESTRUCTURA TELEGRAM 
{
	"data":{
		"callback_query":{
			"data":"H@b1l1t4D14N",
			"id":"5077115432731752923",
			"message":{
				"from":{
					"id":1757174783,
					"is_bot":true,
					"username":"DATAICO_habilitadorDIAN_bot",
					"first_name":"DATAICO_habilitadorDIAN"
				},
				"date":1616207479,
				"text":"\u00bfIniciar proceso ahora?",
				"chat":{
					"type":"private",
					"id":"1182108054"
				},
				"message_id":190,
				"entities":[{
					"length":23,
					"type":"bold"}]
			},
			"from":{
				"first_name":"David",
				"id":1182108054,
				"last_name":"Trejos",
				"language_code":"es",
				"username":"fedat04"
			}
		},
		"update_id":"768886699"
	}
}

ESTRUCTURA WHATSAPP
{
	"responseId":"51b250bb-ebb5-4bab-9a76-d98b5e01081b-83ba84f3",
	"queryResult":{
		"queryText":"123",
		"action":"actValidaPIN",
		"parameters":{
			"pin":123
		},
		"allRequiredParamsPresent":true,
		"outputContexts":[{
			"name":"projects/miranda-chatbot-coc-v1-cefn/agent/sessions/573016899586-f46c03a1706b033da4dc7cd4b383da2e/contexts/_system_counters_",
			"parameters":{
				"no-input":0,
				"no-match":0,
				"pin":123,
				"pin.original":"123"
			}
		}],
		"intent":{
			"name":"projects/miranda-chatbot-coc-v1-cefn/agent/intents/b3826427-366b-4807-9912-980e58de89a0",
			"displayName":"1. SoloDF - Respuesta PIN"
		},
		"intentDetectionConfidence":1,
		"languageCode":"es"
	},
	"originalDetectIntentRequest":{
		"payload":[]
	},
	"session":"projects/miranda-chatbot-coc-v1-cefn/agent/sessions/573016899586-f46c03a1706b033da4dc7cd4b383da2e"
}

*/