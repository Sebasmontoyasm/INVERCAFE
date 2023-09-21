<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

ini_set('display_errors', 1);
set_time_limit(60 * 5);
error_reporting(E_ALL);

class Reportes extends MY_Controller {

    public function __construct() {
        parent::__construct();
		
		date_default_timezone_set('America/Bogota');

        if (!$this->isLogedIn()) {
            //close session
            header('location: ' . site_url());
            exit();
        }

        //hay usuario se envia al dashboard
        $this->GetCurrentUser();
		$this->arrVal = $this->GetValoresDefectoIps();
    }

    private function valida_rol() {
        if ($this->user->USRId > 0) {
            //close session
            header('location: ' . site_url());
            exit();
        }
    }
	
    public function index() {
        //$this->valida_rol();
        $post = $this->input->post(null, true);
				
        setlocale(LC_TIME, "spanish");
		if(isset($post["hidFechaIni"]) && $post["hidFechaIni"] != ""){
			$fechaIni = $post["hidFechaIni"];
			$fechaFin = $post["hidFechaFin"];
			$cmbEstado = (isset($post["cmbEstado"])) ? $post["cmbEstado"] : "";
			$cmbEstadoWapp = (isset($post["cmbEstadoWapp"])) ? $post["cmbEstadoWapp"] : "";
			$cmbEspecialidad = (isset($post["cmbEspecialidad"])) ? $post["cmbEspecialidad"] : "";
		} else {
			$fechaIni = $fechaFin = date('Y-m-d');
			$cmbEstado = $cmbEstadoWapp = "";
		}
				
		$rtaCitasHoy = array();
		
		//en caso que sea un administrador
		if ($this->user->PERFId == 1) {
			if($this->arrVal['cargarIps'] == 0){
				$this->load->view('reportes/inicio', $this->tp);
			} else {
				if($this->arrVal['cargaTp'] == 1){
					//listar los estados
					$this->load->model('estados_mdl', 'estadoModel');
					$this->load->model('especialidades_mdl', 'especialidadModel');
					$qryEstados = $this->estadoModel->SeleccionarEstados();
					$qryEstadosWapp = $this->estadoModel->SeleccionarEstadosWhatsApp();
					$qryEspecialidades = $this->especialidadModel->SeleccionarEspecialidadesIps($this->arrVal['idIps']);
					
					$rtaEstados = $qryEstados->Result();
					$rtaEstadosWapp = $qryEstadosWapp->Result();
					$rtaEspecialidades = $qryEspecialidades->Result();

					$this->tp['citas'] = $rtaCitasHoy;
					$this->tp['estados'] = $rtaEstados;
					$this->tp['estadosWapp'] = $rtaEstadosWapp;
					$this->tp['especialidades'] = $rtaEspecialidades;
					$this->tp['fecha_ini'] = $fechaIni;
					$this->tp['fecha_fin'] = $fechaFin;

					$this->load->view('reportes/inicio', $this->tp);
				} else {
					//listar las citas
					$rtaCitasHoy = $this->getListadoCitas($this->arrVal['idIps'], $fechaIni, $fechaFin, $cmbEstado, $cmbEstadoWapp, $cmbEspecialidad);

					$tblCitas = '';
					$fechaActual = new DateTime("now");
					$fechaManana = $fechaActual->add(new DateInterval('P1D'));
					foreach ($rtaCitasHoy as $indice => $cita) {
						$tblCitas .= 
							'<tr id="tr' . $cita->CITId . '" class="' . (($cita->TIPBloqueado == 1 && $cita->MinutosDesbloqueo < 5) ? "bg-light-primary" : ($cita->AGEId != "" ? "bg-light-warning" : "")) . '">
								<td></td>
								<td>
									<span class="text-dark-75">' . $cita->CITPaciente . '</span>
									<div>
										<span class="text-muted font-weight-bold">' . $cita->CITCedulaPaciente . '</span>
									</div>
								</td>
								<td>
									<span class="text-muted font-weight-bold">' . $cita->CITTelefono . '</span>
								</td>
								<td>
									<span class="text-dark-75">' . $cita->CITSede . '</span>
									<div>
										<span class="font-weight-bolder">' . $cita->CITMedico . '</span>
									</div>
									<div>
										<span class="text-muted">' . $cita->CITEspecialidad . '</span>
									</div>
								</td>
								<td>
									<span class="text-muted">' . $cita->CITHoraCita . '</span>
								</td>
								<td>
									<span class="' . ($cita->ESTColor == "" ? "" : "text-" . $cita->ESTColor) . '">' . $cita->ESTDescripcion . '</span>
								</td>
								<td>
									<span class="' . ($cita->ESTWColor == "" ? "" : "text-" . $cita->ESTWColor) . '"><i class="icon-lg ' . $cita->ESTWIcon . ($cita->ESTWColor == "" ? "" : " text-" . $cita->ESTWColor) . '"></i> ' . $cita->ESTWDescripcion  . '</span>
								</td>
								<td>
									<span class="text-muted">' . $cita->CITInteraccion . '</span>
								</td>
								<td>';
						$fechaCita = new DateTime(date('Y-m-d', strtotime($cita->FechaHoraCita)));
						$intervaloDias = $fechaManana->diff($fechaCita)->d;
						if($cita->CITEstado >= 1) {
							$tblCitas .= '<div class="dropdown dropdown-inline">
								<button type="button" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="icon-lg fas fa-cog"></span>
								</button>
								<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="navi flex-column navi-hover py-2">
										<li class="navi-item">
											<a href="#!" class="navi-link" onclick="VerChat(' . $cita->CITId . ')">
												<span class="navi-icon">
													<i class="fab fa-whatsapp"></i>
												</span>
												<span class="navi-text">Ver chat</span>
											</a>
										</li>' . 
										(($intervaloDias == 0 || $intervaloDias == 1) ? 
										'<li class="navi-item">
											<a href="#!" class="navi-link" onclick="VerTipificador(' . $cita->CITId . ')">
												<span class="navi-icon">
													<i class="fab fa-wpforms"></i>
												</span>
												<span class="navi-text">Tipificar</span>
											</a>
										</li>' : '') . '
									</ul>
								</div>
							</div>';
						}
						$tblCitas .= '</td></tr>';	
					}

					$output['citas'] = $tblCitas;
					$output['cant_citas'] = count($rtaCitasHoy);
					$output['cargar_tp'] = $this->arrVal['cargaTp'];
					$output['cargar_ips'] = $this->arrVal['cargarIps'];
					$output['ips_activa'] = $this->arrVal['idIps'];
					//$output['estados'] = $rtaEstados;
					//$output['estadosWapp'] = $rtaEstadosWapp;
					//$output['especialidades'] = $rtaEspecialidades;
					$output['fecha_ini'] = $fechaIni;
					$output['fecha_fin'] = $fechaFin;

					exit(json_encode($output));
				}
			}
		}
		//en caso que sea una IPS
		if ($this->user->PERFId == 2 || $this->user->PERFId == 3) {
			if($this->arrVal['cargaTp'] == 1){
				//listar los estados
				$this->load->model('estados_mdl', 'estadoModel');
				$this->load->model('especialidades_mdl', 'especialidadModel');
				$qryEstados = $this->estadoModel->SeleccionarEstados();
				$qryEstadosWapp = $this->estadoModel->SeleccionarEstadosWhatsApp();
				$qryEspecialidades = $this->especialidadModel->SeleccionarEspecialidadesIps($this->arrVal['idIps']);
				
				$rtaEstados = $qryEstados->Result();
				$rtaEstadosWapp = $qryEstadosWapp->Result();
				$rtaEspecialidades = $qryEspecialidades->Result();

				$this->tp['citas'] = $rtaCitasHoy;
				$this->tp['estados'] = $rtaEstados;
				$this->tp['estadosWapp'] = $rtaEstadosWapp;
				$this->tp['especialidades'] = $rtaEspecialidades;
				$this->tp['fecha_ini'] = $fechaIni;
				$this->tp['fecha_fin'] = $fechaFin;

				$this->load->view('reportes/inicio', $this->tp);
			} else {
				//listar las citas
				$rtaCitasHoy = $this->getListadoCitas($this->arrVal['idIps'], $fechaIni, $fechaFin, $cmbEstado, $cmbEstadoWapp, $cmbEspecialidad);
				//$rtaCitasHoy = $this->getListadoCitasPage($this->arrVal['idIps'], $fechaIni, $fechaFin, $cmbEstado, $cmbEstadoWapp, $cmbEspecialidad, 22, 'asc', 0, 20);
				
				$tblCitas = '';
				$fechaActual = new DateTime("now");
				$fechaManana = $fechaActual->add(new DateInterval('P1D'));
				foreach ($rtaCitasHoy as $indice => $cita) {
					$tblCitas .= 
						'<tr id="tr' . $cita->CITId . '" class="' . (($cita->TIPBloqueado == 1 && $cita->MinutosDesbloqueo < 5) ? "bg-light-primary" : ($cita->AGEId != "" ? "bg-light-warning" : "")) . '">
							<td></td>
							<td>
								<span class="text-dark-75">' . $cita->CITPaciente . '</span>
								<div>
									<span class="text-muted font-weight-bold">' . $cita->CITCedulaPaciente . '</span>
								</div>
							</td>
							<td>
								<span class="text-muted font-weight-bold">' . $cita->CITTelefono . '</span>
							</td>
							<td>
								<span class="text-dark-75">' . $cita->CITSede . '</span>
								<div>
									<span class="font-weight-bolder">' . $cita->CITMedico . '</span>
								</div>
								<div>
									<span class="text-muted">' . $cita->CITEspecialidad . '</span>
								</div>
							</td>
							<td>
								<span class="text-muted">' . $cita->CITHoraCita . '</span>
							</td>
							<td>
								<span class="' . ($cita->ESTColor == "" ? "" : "text-" . $cita->ESTColor) . '">' . $cita->ESTDescripcion . '</span>
							</td>
							<td>
								<span class="' . ($cita->ESTWColor == "" ? "" : "text-" . $cita->ESTWColor) . '"><i class="icon-lg ' . $cita->ESTWIcon . ($cita->ESTWColor == "" ? "" : " text-" . $cita->ESTWColor) . '"></i> ' . $cita->ESTWDescripcion  . '</span>
							</td>
							<td>
								<span class="text-muted">' . $cita->CITInteraccion . '</span>
							</td>
							<td>';
					$fechaCita = new DateTime(date('Y-m-d', strtotime($cita->FechaHoraCita)));
					$intervaloDias = $fechaManana->diff($fechaCita)->d;
					if($cita->CITEstado >= 1) {
						$tblCitas .= '<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="icon-lg fas fa-cog"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<ul class="navi flex-column navi-hover py-2">
									<li class="navi-item">
										<a href="#!" class="navi-link" onclick="VerChat(' . $cita->CITId . ')">
											<span class="navi-icon">
												<i class="fab fa-whatsapp"></i>
											</span>
											<span class="navi-text">Ver chat</span>
										</a>
									</li>' . 
									(($intervaloDias == 0 || $intervaloDias == 1) ? 
									'<li class="navi-item">
										<a href="#!" class="navi-link" onclick="VerTipificador(' . $cita->CITId . ')">
											<span class="navi-icon">
												<i class="fab fa-wpforms"></i>
											</span>
											<span class="navi-text">Tipificar</span>
										</a>
									</li>' : '') . '
								</ul>
							</div>
						</div>';
					}
					$tblCitas .= '</td></tr>';	
				}

				$output['citas'] = $tblCitas;
				$output['cant_citas'] = count($rtaCitasHoy);
				$output['cargar_tp'] = $this->arrVal['cargaTp'];
				$output['cargar_ips'] = $this->arrVal['cargarIps'];
				$output['ips_activa'] = $this->arrVal['idIps'];
				//$output['estados'] = $rtaEstados;
				//$output['estadosWapp'] = $rtaEstadosWapp;
				//$output['especialidades'] = $rtaEspecialidades;
				$output['fecha_ini'] = $fechaIni;
				$output['fecha_fin'] = $fechaFin;

				exit(json_encode($output));
			}
		}
    }

/*
    public function sourceCitas() {
        $post = $this->input->post(null, true);

		$fechaIni = $post["hidFechaIni"];
		$fechaFin = $post["hidFechaFin"];
		$cmbEstado = (isset($post["cmbEstado"])) ? $post["cmbEstado"] : "";
		$cmbEstadoWapp = (isset($post["cmbEstadoWapp"])) ? $post["cmbEstadoWapp"] : "";
		$cmbEspecialidad = (isset($post["cmbEspecialidad"])) ? $post["cmbEspecialidad"] : "";
		$comienzo = $post["start"];
		$cuantos = $post["length"];
		
		$rtaCitasHoy = $this->getListadoCitasPage($this->arrVal['idIps'], $fechaIni, $fechaFin, $cmbEstado, $cmbEstadoWapp, $cmbEspecialidad, 22, 'asc', $comienzo, $cuantos);

        $data = array();
                
        for ( $i = 0; $i < count($results); $i++ ) 
        { 
            $object = (object)array();
            $obj = $results[$i]; 

            $object->ObjectID = $obj->objectId;
            $object->ComplegidadID = $obj->ComplegidadID;
            $object->Nombre = $obj->Nombre;
            $object->PreguntarPorcentaje = $obj->PreguntarPorcentaje;
            $object->MinimoRetiro = $obj->MinimoRetiro;
            $object->MaximoRetiroSimple = $obj->MaximoRetiroSimple;
            $object->MaximoRetiroCombinado = $obj->MaximoRetiroCombinado;
            $object->ValorAlto = $obj->ValorAlto;
            $object->MenorEdad = $obj->MenorEdad;
            $object->ComplejPermitidas = $obj->ComplejPermitidas;
            $object->ProcedPermitidos = ($obj->ProcedPermitidos == null ? '' : $obj->ProcedPermitidos);
            $object->MaxProcedimientos = $obj->MaxProcedimientos;
            $data[] = $object;
        }
        return $proc;



				$tblCitas = '';
				$fechaActual = new DateTime("now");
				$fechaManana = $fechaActual->add(new DateInterval('P1D'));
				foreach ($rtaCitasHoy as $indice => $cita) {
					$object = (object)array();

					$tblCitas .= 
						'<tr id="tr' . $cita->CITId . '" class="' . (($cita->TIPBloqueado == 1 && $cita->MinutosDesbloqueo < 5) ? "bg-light-primary" : ($cita->AGEId != "" ? "bg-light-warning" : "")) . '">
							<td></td>
							<td>
								<span class="text-dark-75">' . $cita->CITPaciente . '</span>
								<div>
									<span class="text-muted font-weight-bold">' . $cita->CITCedulaPaciente . '</span>
								</div>
							</td>
							<td>
								<span class="text-muted font-weight-bold">' . $cita->CITTelefono . '</span>
							</td>
							<td>
								<span class="text-dark-75">' . $cita->CITSede . '</span>
								<div>
									<span class="font-weight-bolder">' . $cita->CITMedico . '</span>
								</div>
								<div>
									<span class="text-muted">' . $cita->CITEspecialidad . '</span>
								</div>
							</td>
							<td>
								<span class="text-muted">' . $cita->CITHoraCita . '</span>
							</td>
							<td>
								<span class="' . ($cita->ESTColor == "" ? "" : "text-" . $cita->ESTColor) . '">' . $cita->ESTDescripcion . '</span>
							</td>
							<td>
								<span class="' . ($cita->ESTWColor == "" ? "" : "text-" . $cita->ESTWColor) . '"><i class="icon-lg ' . $cita->ESTWIcon . ($cita->ESTWColor == "" ? "" : " text-" . $cita->ESTWColor) . '"></i> ' . $cita->ESTWDescripcion  . '</span>
							</td>
							<td>
								<span class="text-muted">' . $cita->CITInteraccion . '</span>
							</td>
							<td>';
					$fechaCita = new DateTime(date('Y-m-d', strtotime($cita->FechaHoraCita)));
					$intervaloDias = $fechaManana->diff($fechaCita)->d;
					if($cita->CITEstado >= 1) {
						$tblCitas .= '<div class="dropdown dropdown-inline">
							<button type="button" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="icon-lg fas fa-cog"></span>
							</button>
							<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								<ul class="navi flex-column navi-hover py-2">
									<li class="navi-item">
										<a href="#!" class="navi-link" onclick="VerChat(' . $cita->CITId . ')">
											<span class="navi-icon">
												<i class="fab fa-whatsapp"></i>
											</span>
											<span class="navi-text">Ver chat</span>
										</a>
									</li>' . 
									(($intervaloDias == 0 || $intervaloDias == 1) ? 
									'<li class="navi-item">
										<a href="#!" class="navi-link" onclick="VerTipificador(' . $cita->CITId . ')">
											<span class="navi-icon">
												<i class="fab fa-wpforms"></i>
											</span>
											<span class="navi-text">Tipificar</span>
										</a>
									</li>' : '') . '
								</ul>
							</div>
						</div>';
					}
					$tblCitas .= '</td></tr>';	
				}

				$output['citas'] = $tblCitas;
				$output['data'] = $rtaCitasHoy;
				$output['cant_citas'] = count($rtaCitasHoy);
				$output['cargar_tp'] = $this->arrVal['cargaTp'];
				$output['cargar_ips'] = $this->arrVal['cargarIps'];
				$output['ips_activa'] = $this->arrVal['idIps'];
				//$output['estados'] = $rtaEstados;
				//$output['estadosWapp'] = $rtaEstadosWapp;
				//$output['especialidades'] = $rtaEspecialidades;
				$output['fecha_ini'] = $fechaIni;
				$output['fecha_fin'] = $fechaFin;
				$output['recordsTotal'] = 350;
				$output['recordsFiltered'] = count($rtaCitasHoy);

				exit(json_encode($output));
	}
	*/
	
    public function verModalChat($idCita = "") {
		//cargar API Plazbot
        $this->load->model('api_mdl', 'apiModel');
        $query = $this->apiModel->ConsultarApiPlazbot();
        $rsApi = $query->Row();

        //conseguir una cita
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarCita($idCita);
        $rsCita = $query->Row();

		$mensajes = $this->apiModel->ListarMensajesChat($rsApi->APIGetMessagesChat, $this->arrVal['ips']->IPSCodigoBot, $rsCita->CITTelefono);
				
		$this->tp['bot'] = $this->arrVal['ips']->IPSChatbot;
		$this->tp['fechaEnvioCita'] = $rsCita->CITFechaEnvioCita;
		$this->tp['mensajes'] = $mensajes;
		$this->load->view('chat/modal-chat', $this->tp);
	}
	
    public function verModalTipificador($idCita = "") {
        //conseguir una cita
        $this->load->model('citas_mdl', 'citaModel');
        $this->load->model('estados_mdl', 'estadoModel');
		$query = $this->citaModel->SeleccionarCita($idCita);
        $rsCita = $query->Row();
		
		$this->tp['bloqueado'] = $rsCita->TIPBloqueado;
		//si se excedio el tiempo de desbloqueo, se desbloquea
		if($rsCita->TIPBloqueado == 1){
			if($rsCita->MinutosDesbloqueo >= 5){
				$this->citaModel->BloquearDesbloquearRegistro($idCita, "");
				$this->tp['bloqueado'] = "";
			}
		} else {
			//bloquear registro
			$this->citaModel->BloquearDesbloquearRegistro($idCita, 1);			
		}
		
		$Iniciales = explode(" ", $rsCita->CITPaciente);
		//listar los estados
		$qryEstados = $this->estadoModel->SeleccionarEstadosTipificar();
		$rtaEstados = $qryEstados->Result();
		$rtaEstadosSI = $this->getSubtipificacion($rsCita->CITEstado, 0);
		
		$this->tp['bot'] = $this->arrVal['ips']->IPSChatbot;
		$this->tp['cita'] = $rsCita;
		$this->tp['iniciales'] = trim($Iniciales[0])[0] . ($Iniciales[1] == "" ? "" : $Iniciales[1][0]);
		$this->tp['estados_tip'] = $rtaEstados;
		$this->tp['estados_subtip'] = $rtaEstadosSI;
		$this->load->view('tipificar/modal-tipificador', $this->tp);
	}
	
    public function cerrarModalTipificador($idCita = "") {
        //conseguir una cita
        $this->load->model('citas_mdl', 'citaModel');
		//desbloquear registro
		$this->citaModel->BloquearDesbloquearRegistro($idCita, "");		
	}
	
    public function getListadoCitas($idIps, $fechaIni, $fechaFin, $estado, $estadoWapp, $especialidad) {
        //listar las citas
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarCitasFecha($idIps, $fechaIni, $fechaFin, $estado, $estadoWapp, $especialidad);
        return $query->Result();
	}
	
    public function getListadoCitasPage($idIps, $fechaIni, $fechaFin, $estado, $estadoWapp, $especialidad, $colOrden, $orden, $comienzo, $cuantos) {
        //listar las citas
        $this->load->model('citas_mdl', 'citaModel');
		$query = $this->citaModel->SeleccionarCitasFechaPagina($idIps, $fechaIni, $fechaFin, $estado, $estadoWapp, $especialidad, $colOrden, $orden, $comienzo, $cuantos);
        return $query->Result();
	}
	
    public function getSubtipificacion($idEstado, $f) {
        //listar los estados del agendamiento
        $this->load->model('estados_mdl', 'estadoModel');
		$query = $this->estadoModel->SeleccionarSubtipificacion($idEstado);
		$result = $query->Result();
		
		if($f == 0)
			return $result;
		else {
			$output['estados_subtip'] = $result;
			exit(json_encode($output));
		}
	}
		
    public function tipificarCita() {
		$post = $this->input->post(null, true);
		
		$this->load->model('citas_mdl', 'citaModel');
		$this->citaModel->GuardarTipificacionCita($post["hidCitaId"], $this->user->USRId, $post["cmbTipificacion"], $post["cmbAgendamiento"], $post["txtObervacion"]);
	}
	
}