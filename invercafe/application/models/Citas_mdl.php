<?php

class Citas_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function SeleccionarDetalleCita($PIN, $Telefono, $codBot) {
        $Sql = "call sp_citas_seleccionarXpin($PIN, '$Telefono', '$codBot')";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarCita($IdCita) {
        $Sql = "call sp_citas_seleccionarXid($IdCita)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function ValidarHorarioCita($IdCita) {
        $Sql = "call sp_citas_validarXhorario($IdCita)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function EnviarRecordatorioCita($IPSId) {
        $Sql = "call sp_citas_seleccionarReintentos($IPSId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function ActualizarEstadoCita($CITId, $IPSId, $CITEstado, $CITEstadoWapp, $CITInteraccion, $CITMensajeBot, $CONTIntento) {
        $Sql = "call sp_citas_actualizarEstado($CITId, $IPSId, $CITEstado, $CITEstadoWapp, $CITInteraccion, '$CITMensajeBot', $CONTIntento)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function GuardarTipificacionCita($CITId, $AGEId, $ESTId, $SUBTId, $TIPObervacion) {
        $AGEId = ($AGEId == "") ? "NULL" : $AGEId;
        $SUBTId = ($SUBTId == "") ? "NULL" : $SUBTId;
        $Sql = "call sp_citas_actualizarTipificacion($CITId, $AGEId, $ESTId, $SUBTId, '$TIPObervacion')";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function BloquearDesbloquearRegistro($CITId, $CITBloqueo) {
        $CITBloqueo = ($CITBloqueo == "") ? "NULL" : $CITBloqueo;
        $Sql = "call sp_citas_bloquearDesbloquearRegistro($CITId, $CITBloqueo)";
        $this->db->close();
        return $this->db->query($Sql);
    }
    
    public function SeleccionarCitasFecha($IPSId, $FechaIni, $FechaFin, $estado, $estadoWapp, $especialidad) {
        $estado = ($estado == "") ? "NULL" : $estado;
        $estadoWapp = ($estadoWapp == "") ? "NULL" : $estadoWapp;
        $especialidad = ($especialidad == "") ? "NULL" : "'$especialidad'";
        $Sql = "call sp_citas_seleccionarXfecha($IPSId, '$FechaIni', '$FechaFin', $estado, $estadoWapp, $especialidad)";
        $this->db->close();
        return $this->db->query($Sql);
    }    

    public function SeleccionarTotalCitas($IPSId, $FechaIni, $FechaFin) {
        $Sql = "call sp_citas_totalXfecha($IPSId, '$FechaIni', '$FechaFin')";
        $this->db->close();
        return $this->db->query($Sql);
    }    

    public function SeleccionarCitasFechaPagina($IPSId, $FechaIni, $FechaFin, $estado, $estadoWapp, $especialidad, $colOrden, $orden, $comienzo, $cuantos) {
        $estado = ($estado == "") ? "NULL" : $estado;
        $estadoWapp = ($estadoWapp == "") ? "NULL" : $estadoWapp;
        $especialidad = ($especialidad == "") ? "NULL" : "'$especialidad'";
        $Sql = "call sp_citas_seleccionarXfechaXpag($IPSId, '$FechaIni', '$FechaFin', $estado, $estadoWapp, $especialidad, $colOrden, '$orden', $comienzo, $cuantos)";
        $this->db->close();
        return $this->db->query($Sql);
    }    

    public function SeleccionarTotalCitasSemana($IPSId, $Fecha) {
        $Sql = "call sp_citas_totalXsemana($IPSId, '$Fecha')";
        $this->db->close();
        return $this->db->query($Sql);
    }    

    public function SeleccionarTotalCitasDia($IPSId, $CITFecha) {
        $Sql = "call sp_citas_totalXdia($IPSId, '$CITFecha')";
        $this->db->close();
        return $this->db->query($Sql);
    }    

    public function SeleccionarTotalCitasExtraccion() {
        $Sql = "call sp_citas_monitorearExtraccion(NULL)";
        $this->db->close();
        return $this->db->query($Sql);
    }    

}

?>