<?php

class Opciones_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }

    public function SeleccionarOpcionesTipo($TOPId, $OrderBy) {
        $Sql = "call sp_opciones_seleccionarXtipo($TOPId, $OrderBy);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarOpcionesHijo($TOPId, $IdHijo) {
        $Sql = "call sp_opciones_seleccionarXhijos($TOPId, '$IdHijo', $OrderBy);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function SeleccionarPaisesActivos() {
        $Sql = "call sp_countries_seleccionarActivos();";
        $this->db->close();
        return $this->db->query($Sql);
    }

}

?>