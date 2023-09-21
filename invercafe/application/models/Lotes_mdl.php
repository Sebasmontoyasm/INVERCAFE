<?php

class Lotes_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function ConsultarLotes($fechaEmbarIni, $fechaEmbarFin, $cliente, $estadoLote, $estadoFijacion, $estadoFwd) {
        $fechaEmbarIni = ($fechaEmbarIni == "") ? "NULL" : "'$fechaEmbarIni'";
        $fechaEmbarFin = ($fechaEmbarFin == "") ? "NULL" : "'$fechaEmbarFin'";
        $cliente = ($cliente == "") ? "NULL" : $cliente;
        $estadoLote = ($estadoLote == "") ? "NULL" : $estadoLote;
        $estadoFijacion = ($estadoFijacion == "") ? "NULL" : $estadoFijacion;
        $estadoFwd = ($estadoFwd == "") ? "NULL" : $estadoFwd;
		
        $Sql = "call sp_contratodetalle_seleccionarAll($fechaEmbarIni, $fechaEmbarFin, $cliente, $estadoLote, $estadoFijacion, $estadoFwd)";

        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarLote($DETId) {
        $Sql = "call sp_contratodetalle_seleccionarXid($DETId)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarLotesContrato($CONTId) {
        $Sql = "call sp_contratodetalle_seleccionarXcontrato($CONTId)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function GenerarLote($DETId){
        $Sql = "call sp_contratodetalle_generarLote($DETId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function LiberarLote($DETId){
        $Sql = "call sp_contratodetalle_liberarLote($DETId)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ModificarLote($DETId, $DETNroLote){
        $Sql = "call sp_contratodetalle_modificarLote($DETId, $DETNroLote)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function FijarPrecioLote($DETId, $LOTCostoCertificado, $LOTPrecioFijacion, $LOTFechaFijacion){
        $Sql = "call sp_contratodetalle_fijarPrecioLote($DETId, $LOTCostoCertificado, $LOTPrecioFijacion, '$LOTFechaFijacion')";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ActualizarForwardLote($DETId, $FWDBanco, $FWDModalidad, $FWDTasaSpot, $FWDPuntos, $FWDTasaFinal, $FWDFechaFutura, $FWDMonto){
        $Sql = "call sp_contratodetalle_actualizarForwardLote($DETId, $FWDBanco, $FWDModalidad, $FWDTasaSpot, $FWDPuntos, $FWDTasaFinal, '$FWDFechaFutura', $FWDMonto)";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
}

?>