<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Contratos extends MY_Controller {

    public function __construct() {
        parent::__construct();

		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
		
        if (!$this->isLogedIn()) {
            //close session
            header('location: ' . site_url());
            exit();
        }

        //hay usuario se envia al dashboard
        $this->GetCurrentUser();
        				
		$this->valida_rol();
    }

    private function valida_rol() {
        if ($this->user->PERFId == 3) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }
	
    public function index() {
        //listar los contratos disponibles
        $this->load->model('contratos_mdl', 'contratModel');
		$query = $this->contratModel->ConsultarContratos();
        $rtaCont = $query->Result();
		
        $this->tp['contratos'] = $rtaCont;
        $this->load->view('crud/contratos', $this->tp);
    }

    public function actualizarEstado() {
		$post = $this->input->post(null, true);
		
        $this->load->model('contratos_mdl', 'contratModel');
		$query = $this->usrModel->ActualizarUsuarioEstado($post["idReg"], $post["idEstado"]);

		$output['msj'] = "Se ha camabiado el estado de manera satisfactoria.";
		
		exit(json_encode($output));
    }

    public function verModalContratos($Params = "") {
		//$listParams = explode('-', $Params);
        $this->load->model('contratos_mdl', 'contratModel');
        $this->load->model('lotes_mdl', 'lotesModel');
        $this->load->model('clientes_mdl', 'clienteModel');
        $this->load->model('opciones_mdl', 'opcionesModel');
		
		$qryPaises = $this->opcionesModel->SeleccionarPaisesActivos();
		$qryCalidades = $this->opcionesModel->SeleccionarOpcionesTipo(1,3);
		$qryMeses = $this->opcionesModel->SeleccionarOpcionesTipo(5,1);
		$qryRangos = $this->opcionesModel->SeleccionarOpcionesTipo(6,1);
		$qryPosiciones = $this->opcionesModel->SeleccionarOpcionesTipo(2,1);
		$qryUnidades = $this->opcionesModel->SeleccionarOpcionesTipo(7,1);
		$qryCertificaciones = $this->opcionesModel->SeleccionarOpcionesTipo(4,3);
		$qryRequerimientos = $this->opcionesModel->SeleccionarOpcionesTipo(9,1);
		$qryAsociaciones = $this->opcionesModel->SeleccionarOpcionesTipo(10,3);
		$qryPuertos = $this->opcionesModel->SeleccionarOpcionesTipo(11,3);
		$qryRequerimientos = $this->opcionesModel->SeleccionarOpcionesTipo(9,1);

		$qryClientes = $this->clienteModel->SeleccionarClientesActivos();
		$qryBrokers = $this->clienteModel->SeleccionarBrokersActivos();
		$qryTiposContrato = $this->contratModel->CosultarTiposContrato();
		
		$paises = $qryPaises->Result();
		$meses = $qryMeses->Result();
		$rangos = $qryRangos->Result();
		$calidades = $qryCalidades->Result();
		$posiciones = $qryPosiciones->Result();
		$unidades = $qryUnidades->Result();
		$certificaciones = $qryCertificaciones->Result();
		$requerimientos = $qryRequerimientos->Result();
		$puertos = $qryPuertos->Result();
		$asociaciones = $qryAsociaciones->Result();
		$clientes = $qryClientes->Result();
		$brokers = $qryBrokers->Result();
		$tiposcontrato = $qryTiposContrato->Result();

		$anios = array();
		$anioActual = date('Y');
		$fechaActual = date('Y-m-d');
		$anioFin = $anioActual + 2;
        for ($k = $anioActual, $j = 0; $k <= $anioFin; $k++, $j++) {
			$obj = (object) array();
			$obj->id = date('y', strtotime($fechaActual . ' +' . $j . ' years'));
			$obj->descripcion = $k;
			$anios[] = $obj;
		}

		$contrato = array();
		$detalleVenta = array();
		if($Params != ""){
			$query = $this->contratModel->ConsultarContratoId($Params);
			$contrato = $query->Row();
			//detalle de la venta
			$query = $this->lotesModel->ConsultarLotesContrato($Params);
			$detalleVenta = $query->Result();
		}

		$this->tp['paises'] = $paises;
		$this->tp['clientes'] = $clientes;
		$this->tp['brokers'] = $brokers;
		$this->tp['tiposcontrato'] = $tiposcontrato;
		$this->tp['calidades'] = $calidades;
		$this->tp['anios'] = $anios;
		$this->tp['meses'] = $meses;
		$this->tp['rangos'] = $rangos;
		$this->tp['posiciones'] = $posiciones;
		$this->tp['unidades'] = $unidades;
		$this->tp['certificaciones'] = $certificaciones;
		$this->tp['asociaciones'] = $asociaciones;
		$this->tp['requerimientos'] = $requerimientos;
		$this->tp['puertos'] = $puertos;
		$this->tp['contrato'] = $contrato;
		$this->tp['detalleVenta'] = $detalleVenta;
		$this->load->view('crud/modal-contratos', $this->tp);
	}
		
    public function verModalComex($Params = "") {
        $this->load->model('contratos_mdl', 'contratModel');
		$this->load->model('clientes_mdl', 'clienteModel');
        $this->load->model('lotes_mdl', 'lotesModel');
		
		$qryBrokers = $this->clienteModel->SeleccionarBrokersActivos();
		$fecha = (isset($fecha) && $fecha != "") ? $fecha : date('Y-m-d');

		$brokers = $qryBrokers->Result();
		
		$contrato = array();
		$detalleVenta = array();
		if($Params != ""){
			$query = $this->contratModel->ConsultarContratoId($Params);
			$contrato = $query->Row();
			//detalle de la venta
			$query = $this->lotesModel->ConsultarLotesContrato($Params);
			$detalleVenta = $query->Result();			
		}
		$this->tp['brokers'] = $brokers;
		$this->tp['fecha_hoy'] = $fecha;
		$this->tp['contrato'] = $contrato;
		$this->tp['detalleVenta'] = $detalleVenta;
		$this->tp['cantLotes'] = $detalleVenta[0]->contLotes;
		$this->tp['promFinalPond'] = $detalleVenta[0]->promPond;
		$this->load->view('crud/modal-comex', $this->tp);
	}
		
    public function VerModalForward($idLote = "") {
        //conseguir una cita
        /*$this->load->model('citas_mdl', 'citaModel');
        $this->load->model('estados_mdl', 'estadoModel');
		$query = $this->citaModel->SeleccionarCita($idLote);
        $rsCita = $query->Row();
		
		$this->tp['bloqueado'] = $rsCita->TIPBloqueado;
		//si se excedio el tiempo de desbloqueo, se desbloquea
		if($rsCita->TIPBloqueado == 1){
			if($rsCita->MinutosDesbloqueo >= 5){
				$this->citaModel->BloquearDesbloquearRegistro($idLote, "");
				$this->tp['bloqueado'] = "";
			}
		} else {
			//bloquear registro
			$this->citaModel->BloquearDesbloquearRegistro($idLote, 1);			
		}
		
		$Iniciales = explode(" ", $rsCita->CITPaciente);
		//listar los estados
		$qryEstados = $this->estadoModel->SeleccionarEstadosTipificar();
		$rtaEstados = $qryEstados->Result();
		$rtaEstadosSI = $this->getSubtipificacion($rsCita->CITEstado, 0);
		*/
		$this->tp['bloqueado'] = "";
		$this->tp['bot'] = "";
		$this->tp['cita'] = array();
		$this->tp['iniciales'] = "";
		$this->tp['estados_tip'] = array();
		$this->tp['estados_subtip'] = array();
		$this->load->view('forward/modal-forward', $this->tp);
	}
	
    public function cerrarModalTipificador($idCita = "") {
        //conseguir una cita
        $this->load->model('citas_mdl', 'citaModel');
		//desbloquear registro
		$this->citaModel->BloquearDesbloquearRegistro($idCita, "");		
	}
	
	public function cargarCalidades() {
		$post = $this->input->post(null, true);
        $this->load->model('opciones_mdl', 'opcionesModel');
		$query = $this->opcionesModel->SeleccionarOpcionesHijo(1, $_POST['cmbTipoContrato'],3);
		$calidades = $query->Result();
				
		$output['calidades'] = $calidades;
		
		exit(json_encode($output));
	}
		
	public function guardarContrato() {
		$post = $this->input->post(null, true);
        $this->load->model('contratos_mdl', 'contratModel');
		
		//listado de items de venta
		$itemsVenta = json_decode($_POST['itemsVenta']);
		//$tipoPrecio = ($post["cmbTipoContrato"] == 2 ? "Fixed" : "Dif");
		$cantidadUnidades = ($post["cmbTipoContrato"] == 1 ? $post["txtCantidadUnid"] : "");
		$cantLotesEmbarque = ($post["cmbTipoContrato"] == 1 ? $post["cantLotesEmbarque"] : "");
		$cantLotesAdicionales = ($post["cmbTipoContrato"] == 1 ? $post["txtLotesAdicionales"] : "0");
		
		$query = $this->contratModel->ActualizarContrato($post["hidIdContrato"], $this->tp['user_id'], $post["cmbCliente"], $post["cmbBroker"], $post["cmbTipoContrato"], $post["cmbAnioEmbarque"], $post["cmbMesEmbarque"], $post["cmbRangoEmbarque"], $post["cmbMesPosicion"], $post["cmbAnioPosicion"], $post["cmbPuerto"], $cantidadUnidades, $cantLotesEmbarque, $cantLotesAdicionales, 1);
		$idContrato = $query->Row()->idContrato;
		foreach ($itemsVenta as $key => $item) {
			if($item->accion == "delete")
				$qryDetVenta = $this->contratModel->EliminarItemVenta($item->id);			
			else //update o add
				$qryDetVenta = $this->contratModel->ActualizarItemsVenta($item->id, $idContrato, $item->unidades, $item->kilos->id, $item->calidad->id, $item->descEspecial, $item->asociacion->id, $item->certificacion->id, $item->centLbs, $item->tipoPrecio, $item->requerimientos->id, $item->observaciones);			
		}
		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
		
	public function eliminarItem() {
		$post = $this->input->post(null, true);
        $this->load->model('contratos_mdl', 'contratModel');
		$query = $this->contratModel->EliminarItemVenta($post["idItem"]);
		
		$output['msj'] = "Item eliminado correctamente";
		
		exit(json_encode($output));
	}
		
	public function modificarContratoComex() {
		$post = $this->input->post(null, true);
        $this->load->model('contratos_mdl', 'contratModel');
		
		$query = $this->contratModel->ActualizarContratoComex($post["idContrato"], $post["txtRefBuyer"], $post["cmbBroker"], $post["txtRefBroker"], $post["txtComisionBroker"]);

		$output['msj'] = "Se han guardado los cambios de manera correcta";
		
		exit(json_encode($output));
	}
		
	public function cargarDocumento() {
		$post = $this->input->post(null, true);
        $this->load->model('config_mdl', 'configModel');
		
		if(isset($post["fileNameDest"]))
			$fileNameDest = $post["fileNameDest"];

		list($idContrato, $nombreArchivo) = explode("&", $fileNameDest);

		$query = $this->configModel->ObtenerConfiguracion();
		$output_uploads = $query->Row()->CFGEmpresaUploads;
		$output_file = $output_uploads . "/" . $idContrato;
		

		if(!file_exists($output_uploads)){
			mkdir ($output_uploads, 0777, true);
			mkdir ($output_file, 0777, true);
		}
		if(!file_exists($output_file)){
			mkdir ($output_file, 0777, true);
		}

		$error = $_FILES["myfile"]["error"];

		$fileName = $_FILES["myfile"]["name"];
		$info = pathinfo($fileName);
		$extension = strtolower($info['extension']);
		//$fileNameDest = $fileNameDest.".".$extension;
		$fileNameDest = $nombreArchivo . "." . $extension;

		move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_file . "/" . $nombreArchivo . "." . $extension);
		error_reporting(E_ALL ^ E_NOTICE);

		$output['msj'] = "Se ha cargado el archivo al servidor";
		$output['fileName'] = $fileName;
		$output['fileNameDest'] = $fileNameDest;

		exit(json_encode($output));
		
	}

	public function eliminarDocumento() {
		//para eliminacion de archivos
		$post = $this->input->post(null, true);
        $this->load->model('config_mdl', 'configModel');

		$query = $this->configModel->ObtenerConfiguracion();
		$output_uploads = $query->Row()->CFGEmpresaUploads;
		$output_file = $output_uploads . "/" . $post['id'];

		$fileName = $post['nameDest'];

		$filePath = $output_file . "/" . $fileName;
		if (file_exists($filePath))
		{
			unlink($filePath);
		}
		
		$output['msj'] = "Se ha eliminado el archivo";
		$output['fileName'] = $filePath;
		
		exit(json_encode($output));
	}

    public function listarDocumentos(){
		$post = $this->input->post(null, true);
        $this->load->model('config_mdl', 'configModel');

		$query = $this->configModel->ObtenerConfiguracion();
		$output_uploads = $query->Row()->CFGEmpresaUploads;
		$output_file = $output_uploads . "/" . $post['id'];

        $ret = array();
        if (file_exists($output_file)) {
			$files = scandir($output_file);
			foreach($files as $file){
				if($file == "." || $file == ".."){
						continue;
				}
				$filePath = $output_file."/".$file;
				$details1 = array();
				
				$details1['name'] = $file;
				$details1['path'] = $filePath;
				$details1['size'] = filesize($filePath);
				$ret[] = $details1;
			}
		}

		exit(json_encode($ret));
    }
		
    public function descargarDocumento($id){
		$post = $this->input->post(null, true);
        $this->load->model('config_mdl', 'configModel');

		$query = $this->configModel->ObtenerConfiguracion();
		$output_uploads = $query->Row()->CFGEmpresaUploads;
		$output_file = $output_uploads . "/" . $id . "/";

        //$root = "uploads/certificados/" . $idPoliza . "/";
        $file = basename($_GET['filename']);
        $path = $output_file . $file;
        $type = '';

        if (is_file($path)) {
            $size = filesize($path);
            if (function_exists('mime_content_type')) {
                $type = mime_content_type($path);
            } else if (function_exists('finfo_file')) {
                $info = finfo_open(FILEINFO_MIME);
                $type = finfo_file($info, $path);
                finfo_close($info);
            }
            if ($type == '') {
                $type = "application/force-download";
            }
            header("Content-Type: $type");
            header("Content-Disposition: attachment; filename=\"".basename($file)."\"" );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $size);
            readfile($path);
        }
        else {
            echo($file);
        }
    }    
		
}
