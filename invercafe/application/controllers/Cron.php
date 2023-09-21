<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ALL);
set_time_limit(0);

class Cron extends MY_Controller {

    public function index() {
		//si la URL contiene localhost, ejecuto el cron		
		if(strpos($this->tp['site_url'], "localhost") == false){
			/*$this->load->model('ips_mdl', 'ipsModel');
			$query = $this->ipsModel->SeleccionarParaReenvio();
			$rsIps = $query->Result();	
			foreach ($rsIps as $index => $ips) {	*/
				$this->load->model('citas_mdl', 'citasModel');
				$query = $this->citasModel->EnviarRecordatorioCita($ips->IPSId);
				$rsRecordatorio = $query->Result();
				foreach ($rsRecordatorio as $index => $agenda) {
					$this->enviar_recordatorio($agenda, $ips);
				}
			//}
		} else {
			echo "Imposible conectar";
		}
    }

    public function enviar_recordatorio($agenda, $ips) {
        $this->load->model('api_mdl', 'apiModel');
		$this->citasModel->ActualizarEstadoCita($agenda->CITId, 2, "Recordatorio Enviado", 1);
        $query = $this->apiModel->ConsultarApiPlazbot();
        $rsApi = $query->Row();

		$rtaFulFillmentText = "Hola " . $agenda->CITPaciente ." 😊\n\n"
			. "Soy ". $ips->IPSChatbot . " la asistente virtual de " . $ips->IPSNombre . ", te escribo para recordarte la cita que tienes de " . $agenda->CITEspecialidad . ".\n\n"
			. "Por favor verifica este número de PIN para acceder a los detalles de la cita y confirmar asistencia.\n\nPIN: " . $agenda->CITPin;
		$rtaQuickReply = "Verifica acá tu número de PIN";
		$this->apiModel->EnviarMensaje($rsApi->APISendMessage, $ips->IPSCodigoBot, $agenda->CITTelefono, $rtaFulFillmentText, 2, $ips->IPSCodigoPlazbot);
		$this->apiModel->EnviarRespuestaRapida($rsApi->APISendQuickReply, $ips->IPSCodigoBot, $agenda->CITTelefono, "Verificar PIN", $rtaQuickReply, "👇👇👇👇👇", '[ { "itemMostrar": "Verificar PIN", "itemValor": "Verificar PIN" } ]');
		echo $agenda->CITId.'Recordatorio Enviado<br>';
    }

}

?>