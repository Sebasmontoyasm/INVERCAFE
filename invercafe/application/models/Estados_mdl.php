<?php

class Estados_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }

    public function SeleccionarEstadosSemana($IPSId, $CITFecha) {
        $Sql = "call sp_estado_seleccionarXsemana($IPSId, '$CITFecha');";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarEstados() {
        $Sql = "call sp_estado_seleccionar();";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarEstadosTipificar() {
        $Sql = "call sp_estado_seleccionarTipificar();";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarSubtipificacion($ESTId) {
        $Sql = "call sp_subtipificacion_seleccionar($ESTId);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarEstadosWhatsApp() {
        $Sql = "call sp_estadowapp_seleccionar();";
        $this->db->close();
        return $this->db->query($Sql);
    }

}

?>