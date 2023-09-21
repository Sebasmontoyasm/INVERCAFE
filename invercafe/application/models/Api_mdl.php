<?php
require APPPATH . '/libraries/Curl.php';

class Api_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }

    public function ConsultarApiPlazbot() {
        $Sql = "call sp_apiplazbot_seleccionar();";
        $this->db->close();
        return $this->db->query($Sql);
    }

	public function EnviarMensaje($contexto, $codigoBot, $celularReceptor, $mensaje, $idPlataforma, $idUsuarioProceso) {
		$this->load->library('curl');
		
		// For SSL Sites. Check whether the Host Name you are connecting to is valid 
		// ====Funciona desde el localhost======		
		$this->curl->create($this->APIUrl . $contexto);
		
		$this->curl->option('SSL_VERIFYPEER', false);
		$this->curl->option('SSL_VERIFYHOST', false);
		 
		// Optional, delete this line if your API is open
		//$this->curl->http_login($username, $password);
	 
	 
		$this->curl->post(array(
			'codigoBot' => $codigoBot,
			'sessionId' => $celularReceptor,
			'mensaje' => $mensaje,
			'idPlataforma' => $idPlataforma,
			'idUsuarioProceso' => $idUsuarioProceso
		));
		 
		$result = json_decode($this->curl->execute());
		
		return 'Ok';

	}

	public function EnviarRespuestaRapida($contexto, $codigoBot, $celularReceptor, $titulo, $mensaje, $subMensaje, $respuestasRapidas) {
		$this->load->library('curl');
		
		// For SSL Sites. Check whether the Host Name you are connecting to is valid 
		// ====Funciona desde el localhost======		
		$this->curl->create($this->APIUrl . $contexto);
		
		$this->curl->option('SSL_VERIFYPEER', false);
		$this->curl->option('SSL_VERIFYHOST', false);
		 
		// Optional, delete this line if your API is open
		//$this->curl->http_login($username, $password);
	 
	 
		$this->curl->post(array(
			'codigoBot' => $codigoBot,
			'celularReceptor' => $celularReceptor,
			'codigoPostalTel' => "+57",
			'titulo' => $titulo,
			'mensaje' => $mensaje,
			'subMensaje' => $subMensaje,
			'respuestasRapidas' => $respuestasRapidas
		));
		 
		$result = json_decode($this->curl->execute());
		
		return 'Ok';

	}

	public function EnviarMensajePlantilla($contexto, $codigoBot, $plantilla, $celularReceptor, $parametros) {
		$this->load->library('curl');
		
		// For SSL Sites. Check whether the Host Name you are connecting to is valid 
		// ====Funciona desde el localhost======
		$this->curl->create($this->APIUrl . $contexto);
		
		$this->curl->option('SSL_VERIFYPEER', false);
		$this->curl->option('SSL_VERIFYHOST', false);
		 
		// Optional, delete this line if your API is open
		//$this->curl->http_login($username, $password);	 
		
		$this->curl->post_plain($parametros);
				 
		$result = json_decode($this->curl->execute());
				
		return 'Ok';

	}

	public function ListarMensajesChat($contexto, $codigoBot, $celularReceptor) {
		$this->load->library('curl');
		
		// For SSL Sites. Check whether the Host Name you are connecting to is valid 
		// ====Funciona desde el localhost======		
		$this->curl->create($this->APIUrl . $contexto);
		
		$this->curl->option('SSL_VERIFYPEER', false);
		$this->curl->option('SSL_VERIFYHOST', false);
		 
		// Optional, delete this line if your API is open
		//$this->curl->http_login($username, $password);
	 
	 
		$this->curl->post(array(
			'codigoBot' => $codigoBot,
			'sessionId' => $celularReceptor,
			'busquedaPorFrase' => "false",
			'tokenContinuacion' => ""
		));
		 
		$result = json_decode($this->curl->execute());
		
		return $result;

	}

}

?>