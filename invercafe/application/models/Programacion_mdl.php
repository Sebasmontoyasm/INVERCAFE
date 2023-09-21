<?php

class Programacion_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function SeleccionarProgramacionProxima($IPSId) {
        $Sql = "call sp_programacion_seleccionarProximas($IPSId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarProgramacionFuturaProxima($IPSId) {
        $Sql = "call sp_programacion_futura_SeleccionarExtraccion($IPSId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarProgramacionId($PRGId) {
        $Sql = "call sp_programacion_seleccionarXid($PRGId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarProgramacionFuturaId($PRGId) {
        $Sql = "call sp_programacion_futura_seleccionarXid($PRGId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function GuardarProgramacion($PRGId, $IPSId, $PRGFecha, $PRGConsultorios) {
        $PRGId = (is_null($PRGId) || empty($PRGId)) ? "NULL" : $PRGId;
        $Sql = "call sp_programacion_insertar($PRGId, $IPSId, '$PRGFecha', '$PRGConsultorios')";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function GuardarProgramacionFutura($PRGId, $IPSId, $PRGFechaIni, $PRGFechaFin) {
        $PRGId = (is_null($PRGId) || empty($PRGId)) ? "NULL" : $PRGId;
        $Sql = "call sp_programacion_futura_insertar($PRGId, $IPSId, '$PRGFechaIni', '$PRGFechaFin')";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
}

?>