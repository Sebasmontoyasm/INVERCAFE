<?php

class config_mdl extends CI_Model {

    var $PARA_DEP_RECORD;
    var $PARA_DEP_NAME1;       
    var $PARA_DEP_NAME2;
    var $PARA_DEP_LASTNAME1;
    var $PARA_DEP_LASTNAME2;
    var $PARA_DEP_DOB;
    var $PARA_DEP_CEDULA;
    var $PARA_DEP_PARENTESCO;
    var $PARA_DEP_EFFECTIVEDATE;
        
    public function __construct() {
        parent::__construct();
    }

    public function ConsultarFechaActual() {
        $Sql = "call sp_seleccionarFechaActual()";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function ObtenerConfiguracion() {
        $Sql = "call sp_config_seleccionar()";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function CosultarEstadoCampo($campo){
        $Sql = "call sp_estado_seleccionarXcampo($campo)";
        $this->db->close();
        return $this->db->query($Sql);
    }

}

?>