<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Admin extends MY_Controller {

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
    }

    private function valida_rol() {
        if ($this->user->RolId > 0) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }
	
    public function index($fecha = "") {
        //$this->valida_rol();
		
		$fecha = (isset($fecha) && $fecha != "") ? $fecha : date('Y-m-d');

		//listar las citas
/*		$rtaCitasHoy = $this->getListadoCitas($this->arrVal['idIps'], $fecha, $fecha);
		$rtaTotalSemana = $this->getTotalSemana($this->arrVal['idIps'], $fecha);
		$rtaTotalDia = $this->getTotalDia($this->arrVal['idIps'], $fecha);
		
		$rtaEstados = $this->getEstados($this->arrVal['idIps'], $fecha);
		$series = array();
		foreach ($rtaEstados as $key => $estado) {
			$obj = (object) array();
			$obj->name = $estado->ESTDescripcion;
			$obj->data = explode(",",$estado->ARRAYCantidad);
			$series[] = $obj;
		}
		
		//en caso que sea un administrador
		if ($this->user->PERFId == 1) {
			if($this->arrVal['cargarIps'] == 0){
				$this->load->view('admin/inicio', $this->tp);
			} else {
				if($this->arrVal['cargaTp'] == 1){
					$this->tp['citas'] = $rtaCitasHoy;
					$this->tp['total_semana'] = $rtaTotalSemana;
					$this->tp['total_dia'] = $rtaTotalDia;
					$this->tp['fecha_hoy'] = $fecha;
					$this->tp['series'] = $series;

					$this->load->view('admin/inicio', $this->tp);
				} else {
					$output['citas'] = $rtaCitasHoy;
					$output['total_semana'] = $rtaTotalSemana;
					$output['total_dia'] = $rtaTotalDia;
					$output['fecha_hoy'] = $fecha;
					$output['series'] = $series;
					$output['cargar_tp'] = $this->arrVal['cargaTp'];
					$output['cargar_ips'] = $this->arrVal['cargarIps'];
					$output['ips_activa'] = $this->arrVal['idIps'];

					exit(json_encode($output));					
				}
			}
		}
		//en caso que sea una IPS
		if ($this->user->PERFId == 2 || $this->user->PERFId == 3) {
			if($this->arrVal['cargaTp'] == 1){
				$this->tp['citas'] = $rtaCitasHoy;
				$this->tp['total_semana'] = $rtaTotalSemana;
				$this->tp['total_dia'] = $rtaTotalDia;
				$this->tp['fecha_hoy'] = $fecha;
				$this->tp['series'] = $series;

				$this->load->view('admin/inicio', $this->tp);
			} else {
				$output['citas'] = $rtaCitasHoy;
				$output['total_semana'] = $rtaTotalSemana;
				$output['total_dia'] = $rtaTotalDia;
				$output['fecha_hoy'] = $fecha;
				$output['series'] = $series;
				$output['cargar_tp'] = $this->arrVal['cargaTp'];
				$output['cargar_ips'] = $this->arrVal['cargarIps'];
				$output['ips_activa'] = $this->arrVal['idIps'];

				exit(json_encode($output));
			}
		}	*/
		
//		$this->tp['citas'] = $rtaCitasHoy;
//		$this->tp['total_semana'] = $rtaTotalSemana;
//		$this->tp['total_dia'] = $rtaTotalDia;
		$this->tp['fecha_hoy'] = $fecha;
//		$this->tp['series'] = $series;

		$this->load->view('admin/inicio', $this->tp);
    }
	
    public function getTotalDia($idIps, $fecha) {
        //listar las citas
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarTotalCitasDia($idIps, $fecha);
        return $query->Row();
	}
	
    public function getTotalSemana($idIps, $fecha) {
        //listar las citas
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarTotalCitasSemana($idIps, $fecha);
        return $query->Result();
	}
	
    public function getListadoCitas($idIps, $fechaIni, $fechaFin) {
        //listar las citas
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarCitasFecha($idIps, $fechaIni, $fechaFin, "", "", "");
        return $query->Result();
	}
	
    public function getEstados($idIps, $fecha) {
        //listar las citas
        $this->load->model('estados_mdl', 'estadoModel');
		$query = $this->estadoModel->SeleccionarEstadosSemana($idIps, $fecha);
        return $query->Result();
	}
	
    public function exportar($informe = "") {
		set_time_limit(0);

        $get = $this->input->get(null, true);

		$idIps = $get['ips'];
		$fechaIni = $get['ini'];
		$fechaFin = $get['fin'];

		include APPPATH . 'libraries/PHPExcel/PHPExcel.php';
		include APPPATH . 'libraries/PHPExcel/PHPExcel/Writer/Excel2007.php';
		include APPPATH . 'libraries/PHPExcel/PHPExcel/Writer/HTML.php';
		//
		$objPHPExcel = new PHPExcel();
		//
		$objPHPExcel->getProperties()->setTitle("Periodo del $fechaIni al $fechaFin");
		//
		$objPHPExcel->getProperties()->setLastModifiedBy("Solutions Systems");
		$objPHPExcel->getProperties()->setCreator("Solutions Systems");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Document");
		$objPHPExcel->getProperties()->setDescription("This document for Office 2007 XLSX, generated using PHP.");
		//
		$objPHPExcel->setActiveSheetIndex(0);

        //informe detallado de citas
		if($informe == 1) {
			$rtaCitas = $this->getListadoCitas($idIps, $fechaIni, $fechaFin);		

			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID.CITA');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'PIN');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CLIENTE');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'FECHA CITA');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'HORA CITA');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'TELÉFONO PACIENTE');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CÉDULA PACIENTE');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'NOMBRE PACIENTE');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'MÉDICO');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ESPECIALIDAD');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'SEDE');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'DIRECCIÓN SEDE');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'FECHA ENVÍO/RESPUESTA');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'ESTADO');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'ESTADO WHATSAPP');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'PACIENTE INTERACTUÓ');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'MENSAJE');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'INTENTOS');
			$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'ASESOR(A) TIPIFICACIÓN');
			$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'ESTADO SIST. AGENDAMIENTO');
			$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'OBSERVACIÓN TIPIFICACIÓN');
			$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'FECHA TIPIFICACIÓN');
			
			foreach ($rtaCitas as $idx => $cita) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($idx+2), $cita->CITId);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . ($idx+2), $cita->CITPin);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . ($idx+2), $cita->IPSNombre);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . ($idx+2), $cita->CITFechaCita);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . ($idx+2), $cita->CITHoraCita);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . ($idx+2), $cita->CITTelefono);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . ($idx+2), $cita->CITCedulaPaciente);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . ($idx+2), $cita->CITPaciente); 
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . ($idx+2), $cita->CITMedico); 
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . ($idx+2), $cita->CITEspecialidad);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . ($idx+2), $cita->CITSede);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . ($idx+2), $cita->CITDireccion);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . ($idx+2), ($cita->CITFechaEnvioCita == "" ? "" : date('Y-m-d H:i', strtotime($cita->CITFechaEnvioCita))));
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . ($idx+2), $cita->ESTDescripcion);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . ($idx+2), $cita->ESTWDescripcion);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . ($idx+2), $cita->CITInteraccion);
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($idx+2), $cita->CITMensajeBot);
				$objPHPExcel->getActiveSheet()->SetCellValue('R' . ($idx+2), $cita->CITIntentos);	
				$objPHPExcel->getActiveSheet()->SetCellValue('S' . ($idx+2), $cita->Asesor);	
				$objPHPExcel->getActiveSheet()->SetCellValue('T' . ($idx+2), $cita->SUBTDescripcion);	
				$objPHPExcel->getActiveSheet()->SetCellValue('U' . ($idx+2), $cita->TIPObservacion);	
				$objPHPExcel->getActiveSheet()->SetCellValue('V' . ($idx+2), ($cita->Asesor == "" ? "" : date('Y-m-d H:i', strtotime($cita->TIPFechaTipificacion))));	
			}
		}
		
        //informe de totales por semana
		if($informe == 2) {
			$rtaTotales = $this->getTotalSemana($idIps, $fechaIni);		

			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'FECHA AGENDA');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ESTADO');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CANTIDAD');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'TOTAL DÍA');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'PORCENTAJE');
			
			foreach ($rtaTotales as $idx => $tot) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($idx+2), $tot->CITFechaCita);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . ($idx+2), $tot->ESTDescripcion);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . ($idx+2), $tot->Cantidad);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . ($idx+2), $tot->TotalDia);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . ($idx+2), $tot->Porcentaje);
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Hoja 1');
			
		/*$this->output->set_header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		$this->output->set_header("Content-Disposition: attachment; filename=\"". basename('reporte-periodo-' . $fechaIni . 'a' . $fechaFin . '-' . time() . '.xlsx')."\"");
		$this->output->set_header("Content-Transfer-Encoding: binary");
		$this->output->set_header('Cache-Control: max-age=0');
		*/

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"". basename('reporte-periodo-' . $fechaIni . 'a' . $fechaFin . '-' . time() . '.xlsx')."\"");
		header("Content-Transfer-Encoding: binary");
		header('Cache-Control: max-age=0');
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('php://output');
		
	}	
	
}