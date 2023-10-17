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

    public function ConsultarClientesId($CLIEId) {
        $Sql = "call sp_cliente_seleccionarXid($CLIEId);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarCountriesActivos(){
        $Sql = "call sp_countries_seleccionarActivos();";
        $this->db->close();
        return $this->db->query($Sql);    
    }
    //  Seguramente no funciona, probar 
    public function ActualizarClienteEstado($CLIEId, $CLIEEstado) {
        $Sql = "call sp_cliente_modificarEstado($CLIEId, $CLIEEstado)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarCliente($inCLIEId, $inPAISId, $inCLIENombre, $inCLIEContacto, $inCLIETelefono, $inCLIECiudad, $inCLIEEmail, $inCLIEDireccion) {
        $CLIEId = empty($inCLIEId) ? 0 : $inCLIEId;
		$Sql = "call sp_cliente_actualizarXid($CLIEId,$inPAISId,'$inCLIENombre','$inCLIEContacto','$inCLIETelefono','$inCLIECiudad', '$inCLIEEmail','$inCLIEDireccion')";
        $this->db->close();
        return $this->db->query($Sql);
    }
}

?>