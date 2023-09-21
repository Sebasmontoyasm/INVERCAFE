<?php

class Clientes_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }

    public function ConsultarClientes() {
        $Sql = "call sp_cliente_seleccionar();";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function SeleccionarClientesActivos() {
        $Sql = "call sp_cliente_seleccionarActivos();";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarClienteEstado($USRId, $USREstado) {
        $Sql = "call sp_cliente_modificarEstado($USRId, $USREstado)";
        $this->db->close();
        return $this->db->query($Sql);
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

    public function ActualizarBrokerEstado($USRId, $USREstado) {
        $Sql = "call sp_broker_modificarEstado($USRId, $USREstado)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
}

?>