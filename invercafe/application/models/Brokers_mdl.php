<?php

class Brokers_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }

    public function ConsultarBrokers() {
        $Sql = "call sp_broker_seleccionar();";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function SeleccionarBrokersActivos() {
        $Sql = "call sp_broker_seleccionarActivos();";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarBrokerId($BROId) {
        $Sql = "call sp_broker_seleccionarXid($BROId);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarCountriesActivos(){
        $Sql = "call sp_countries_seleccionarActivos();";
        $this->db->close();
        return $this->db->query($Sql);    
    }

    public function ActualizarBroker($inBROId, $inPAISId, $inBRONombre, $inBROContacto, $inBROTelefono, $inBROCiudad, $inBROEmail, $inBRODireccion) {
        $BROId = (is_null($inBROId) || empty($inBROId)) ? 0 : $inBROId;
		$Sql = "call sp_broker_actualizarXid($BROId,$inPAISId,'$inBRONombre','$inBROContacto','$inBROTelefono','$inBROCiudad','$inBROEmail','$inBRODireccion')";
        echo $Sql ;
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ActualizarBrokerEstado($BROId, $BROEstado) {
        $Sql = "call sp_broker_modificarEstado($BROId, $BROEstado)";
        $this->db->close();
        return $this->db->query($Sql);
        
    }
}

?>