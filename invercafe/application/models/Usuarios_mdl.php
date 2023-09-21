<?php

class Usuarios_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function ConsultarPerfilesActivos() {
        $Sql = "call sp_perfil_seleccionarActivos()";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function ConsultarUsuarioLogin($nomUsuario, $passUsuario) {
        $Sql = "call sp_usuario_seleccionarLogin('$nomUsuario', '$passUsuario')";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarUsuarioEmail($nomUsuario, $emailUsuario) {
        $Sql = "call sp_usuario_seleccionarEmail('$nomUsuario', '$emailUsuario')";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarUsuarioId($PERFId, $USRId) {
        $Sql = "call sp_usuario_seleccionarXid($PERFId, $USRId);";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarUsuarios() {
        $Sql = "call sp_usuario_seleccionar()";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarUsuarioContrasena($USPassWd, $USRId) {
        $Sql = "call sp_usuario_modificarContrasena('$USPassWd',$USRId)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarUsuarioCredenciales($USRId, $USRUname, $USREmail) {
        $Sql = "call sp_usuario_modificarCredenciales($USRId, '$USRUname', '$USREmail')";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function CompararUsuarioContrasena($USRId, $USPassWd) {
        $Sql = "call sp_usuario_compararContrasena($USRId, '$USPassWd')";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ActualizarUsuarioEstado($USRId, $USREstado) {
        $Sql = "call sp_usuario_modificarEstado($USRId, $USREstado)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ActualizarUsuario($USRId, $PERFId, $USRUserName, $USRPasswd, $USREmail, $USRName, $USRLastName, $USREstado) {
        $USRId = (is_null($USRId) || empty($USRId)) ? "NULL" : $USRId;
        $USRPasswd = (is_null($USRPasswd) || empty($USRPasswd)) ? "NULL" : "'$USRPasswd'";
		$Sql = "call sp_usuario_actualizarXid($USRId, $PERFId, '$USRUserName', $USRPasswd, '$USREmail', '$USRName', '$USRLastName', $USREstado)";
		echo $Sql; 
        $this->db->close();
        return $this->db->query($Sql);
    }


}

?>