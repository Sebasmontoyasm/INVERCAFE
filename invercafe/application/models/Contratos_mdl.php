<?php

class Contratos_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function CosultarTiposContrato(){
        $Sql = "call sp_tipocontrato_seleccionarActivos()";
        $this->db->close();
        return $this->db->query($Sql);
    }
	
    public function ConsultarContratos() {
        $Sql = "call sp_contrato_seleccionar()";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ConsultarContratoId($CONTId) {
        $Sql = "call sp_contrato_seleccionarXid($CONTId)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarContrato($CONTId, $USRId, $CLIEId, $BROId, $TCONId, $CONTAnioEmbarque, $CONTMesEmbarque, $CONTRangoEmbarque, $CONTPosicion, $CONTAnioPosicion, $CONTPuertoEmbarque, $CONTotalUnidades, $CONLotesEmbarque, $CONLotesBolsa, $ESTId) {
        $CONTId = (is_null($CONTId) || empty($CONTId)) ? "NULL" : $CONTId;
        $BROId = (is_null($BROId) || empty($BROId)) ? "NULL" : $BROId;
        $CONLotesEmbarque = (is_null($CONLotesEmbarque) || empty($CONLotesEmbarque)) ? "NULL" : $CONLotesEmbarque;
        $CONTotalUnidades = (is_null($CONTotalUnidades) || empty($CONTotalUnidades)) ? "NULL" : $CONTotalUnidades;
        $CONLotesBolsa = (is_null($CONLotesBolsa) || empty($CONLotesBolsa)) ? "0" : $CONLotesBolsa;
        $CONTAnioEmbarque = (is_null($CONTAnioEmbarque) || empty($CONTAnioEmbarque)) ? "NULL" : $CONTAnioEmbarque;
        $CONTMesEmbarque = (is_null($CONTMesEmbarque) || empty($CONTMesEmbarque)) ? "NULL" : $CONTMesEmbarque;
        $CONTRangoEmbarque = (is_null($CONTRangoEmbarque) || empty($CONTRangoEmbarque)) ? "NULL" : $CONTRangoEmbarque;
		$CONTPosicion = (is_null($CONTPosicion) || empty($CONTPosicion)) ? "NULL" : $CONTPosicion; 
		$CONTAnioPosicion = (is_null($CONTAnioPosicion) || empty($CONTAnioPosicion)) ? "NULL" : $CONTAnioPosicion;
		$CONTPuertoEmbarque = (is_null($CONTPuertoEmbarque) || empty($CONTPuertoEmbarque)) ? "NULL" : $CONTPuertoEmbarque;
		
		$Sql = "call sp_contrato_actualizarXid($CONTId, $USRId, $CLIEId, $BROId, $TCONId, $CONTAnioEmbarque, $CONTMesEmbarque, $CONTRangoEmbarque, $CONTPosicion, $CONTAnioPosicion, $CONTPuertoEmbarque, $CONTotalUnidades, $CONLotesEmbarque, $CONLotesBolsa, $ESTId)";
        $this->db->close();
        return $this->db->query($Sql);
    }

    public function ActualizarItemsVenta($DETId, $CONTId, $DETCantidad, $DETKilos, $DETCalidad, $DETDescEspecial, $DETAsociacion, $DETCertificacion, $DETUsdLbs, $DETTipoPrecio, $DETRequerimientos, $DETObservaciones) {
        $DETId = (is_null($DETId) || empty($DETId)) ? "NULL" : $DETId;
        $DETCalidad = (is_null($DETCalidad) || empty($DETCalidad)) ? "NULL" : $DETCalidad;
        $DETKilos = (is_null($DETKilos) || empty($DETKilos)) ? "NULL" : $DETKilos;
        $DETCertificacion = (is_null($DETCertificacion) || empty($DETCertificacion)) ? "NULL" : $DETCertificacion;
        $DETAsociacion = (is_null($DETAsociacion) || empty($DETAsociacion)) ? "NULL" : $DETAsociacion;
        $DETUsdLbs = (is_null($DETUsdLbs) || empty($DETUsdLbs)) ? "NULL" : $DETUsdLbs;
        $DETRequerimientos = (is_null($DETRequerimientos) || empty($DETRequerimientos)) ? "NULL" : $DETRequerimientos;
		$Sql = "call sp_contratodetalle_insertar($DETId, $CONTId, $DETCantidad, $DETKilos, $DETCalidad, '$DETDescEspecial', $DETAsociacion, $DETCertificacion, $DETUsdLbs, '$DETTipoPrecio', $DETRequerimientos, '$DETObservaciones')";
		//echo $Sql;
		$this->db->close();
		return $this->db->query($Sql);
    }

    public function EliminarItemVenta($DETId) {
		$Sql = "call sp_contratodetalle_eliminar($DETId)";
		$this->db->close();
		return $this->db->query($Sql);
    }

    public function ActualizarContratoComex($CONTId, $CONTRefBuyer, $BROId, $CONTRefBroker, $CONTComisionBroker) {		
        $BROId = (is_null($BROId) || empty($BROId)) ? "NULL" : $BROId;
        $CONTComisionBroker = (is_null($CONTComisionBroker) || empty($CONTComisionBroker)) ? "NULL" : $CONTComisionBroker;
		$Sql = "call sp_contrato_actualizarComexXid($CONTId, '$CONTRefBuyer', $BROId, '$CONTRefBroker', $CONTComisionBroker)";
        $this->db->close();
        return $this->db->query($Sql);
    }

}

?>