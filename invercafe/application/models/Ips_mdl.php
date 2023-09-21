<?php

class Ips_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function SeleccionarXbot($IPSCodigoBot) {
        $Sql = "call sp_ips_seleccionarXbot('$IPSCodigoBot')";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarXid($IPSId) {
        $Sql = "call sp_ips_seleccionarXid($IPSId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarActivas() {
        $Sql = "call sp_ips_seleccionarTodas()";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarParaReenvio() {
        $Sql = "call sp_ips_seleccionarReenviar()";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function GuardarConfiguracionPublica($IntervaloDias, $HorarioHasta, $IPSId) {
        $Sql = "call sp_ips_modificarConfigPublicaV2($IntervaloDias, '$HorarioHasta', $IPSId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
}

?>