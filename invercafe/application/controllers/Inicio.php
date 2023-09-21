<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {

    public function __construct() {
        parent::__construct();
		
		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
    }

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
				if ($this->tp['user_rolid'] == 1 || $this->tp['user_rolid'] == 2 || $this->tp['user_rolid'] == 3) {
					header('location:' . $this->tp['site_url'] . 'admin');
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
					// si el mensaje esta fuera del horario, actalizo que si hubo interaccion
					if($rsRta->RtaId == 0)
						$qryActRta = $this->citasModel->ActualizarEstadoCita($rsRta->CITId, $rsIps->IPSId, 2, 2, 1, "Respuesta fuera de horario de atención", 0);
					$this->sendMessage(array(
						"fulfillmentText" => $rtaFulFillmentText,
						//"fulfillmentText" => "Respuesta:" . json_encode($fromMessage),
					));
				} else {
					$rtaFulFillmentText = "El numero de PIN " . $idPin . ", corresponde a la siguiente cita:\n\n"
					. "Nombre del Paciente: " . $rsRta->CITPaciente ."\n"
					. "Fecha de la cita: " . date('d/m/Y', strtotime($rsRta->CITFechaCita)) . " a las " . $rsRta->CITHoraCita ."\n"
					. "Especialidad: " . $rsRta->CITEspecialidad . "\n"
					. ($rsRta->CITMedico == "" ? "" : "Doctor(a): " . $rsRta->CITMedico . "\n")
					. ($rsRta->CITSede == "" ? "" : "Sede: " . $rsRta->CITSede . "\n")
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
			
			$qryVal = $this->citasModel->ValidarHorarioCita($rowId[1]);			
			$rsVal = $qryVal->Row();
			
			if($rsVal->RtaId == -1 || $rsVal->RtaId == 0) {
				$rtaFulFillmentText = $rsVal->RtaMensaje;
				// si el mensaje esta fuera del horario, actalizo que si hubo interaccion
				if($rsVal->RtaId == 0)
					$qryActRta = $this->citasModel->ActualizarEstadoCita($rsVal->CITId, $rsIps->IPSId, 2, 2, 1, "Respuesta fuera de horario de atención", 0);
				$this->sendMessage(array(
					"fulfillmentText" => $rtaFulFillmentText,
				));
			} else {
				if($continuar == "SI") {
					$estado = 1;
					$mensaje = "Paciente confirma asistencia";
					$qryRta = $this->citasModel->ActualizarEstadoCita($rowId[1], $rsIps->IPSId, $estado, 2, 1, $mensaje, 0);
					$rsRta = $qryRta->Row();
					$rtaFulFillmentText = $rsRta->ESPMensaje;
				} else {
					$estado = 3;
					$mensaje = "Paciente no asistirá";
					$this->citasModel->ActualizarEstadoCita($rowId[1], $rsIps->IPSId, $estado, 2, 1, $mensaje, 0);
					//$qryRta = $this->cargaModel->ReprogramarCargaTelegram($rowId[1], "Usuario desea reprogramar");
					$rtaFulFillmentText = $rsIps->IPSMensajeCancelo;
				}
				$query = $this->citasModel->GuardarTipificacionCita($rowId[1], "", $estado, "", $mensaje);
			}
			
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

    public function phpin() {
        echo phpinfo();
    }

}
