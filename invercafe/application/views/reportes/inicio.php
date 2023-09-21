<?php 
	include(APPPATH . 'views/inc/head.php'); 
	$fechaActual = new DateTime("now");
	$fechaManana = $fechaActual->add(new DateInterval('P1D'));
?>
<link href="<?php echo $template; ?>css/pages/reportes/reportes.css?v=7.2.9" rel="stylesheet" type="text/css" />
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<?php include_once(APPPATH . 'views/inc/header-mobile.php'); ?>
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<?php include_once(APPPATH . 'views/inc/aside.php'); ?>
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<?php include_once(APPPATH . 'views/inc/header.php'); ?>
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
						<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<!--begin::Info-->
							<div class="d-flex align-items-center flex-wrap mr-2">
								<!--begin::Page Title-->
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Reportes</h5>
								<!--end::Page Title-->
								<!--begin::Actions-->
								<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
								<span class="text-muted font-weight-bold mr-4"><?php echo ($user_rolid == 1 && $cargar_ips) ? $ips_nombre : "" ?></span>
								<!--end::Actions-->
							</div>
							<!--end::Info-->
						</div>
					</div>
					<!--end::Subheader-->
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Dashboard-->
							<!--begin::Row-->
							<div class="row">
								<div class="col-xxl-12 order-2 order-xxl-1">
									<!--begin::Advance Table Widget 2-->
									<div id="panel-reporte-citas" class="card card-custom card-stretch gutter-b overlay">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark">Reporte Citas: <span class="text-muted"><?php echo strftime("%d de %B", strtotime($fecha_ini)); ?></span></span>
												<span class="text-muted mt-3 font-weight-bold font-size-sm">Cantidad de agendas encontradas: <?php echo count($citas); ?></span>
											</h3>
											<div class="card-toolbar">
												<!--a href="#!" onclick="ExportarExcel(1, $('#cmbIpsActiva').val(), $('#hidFechaIni').val(), $('#hidFechaFin').val());" class="btn btn-success btn-outline-success font-weight-bold btn-pill"><i class="la la-file-excel-o"></i> Exportar</a-->
												<a href="#!" id="btn-exportar-fechas" class="btn btn-success btn-outline-success font-weight-bold btn-pill" ><i class="la la-file-excel-o"></i> Exportar
													<input id="hidExpFechaIni" name="hidExpFechaIni" type="hidden" value="<?php echo $fecha_ini; ?>">
													<input id="hidExpFechaFin" name="hidExpFechaFin" type="hidden" value="<?php echo $fecha_fin; ?>">
												</a>
											</div>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<div class="overlay-wrapper">
												<form id="frmView" class="form" novalidate="novalidate" data-view="reportes">
													<div class="mb-7">
														<div class="row align-items-center">
															<div class="col-lg-12 col-xl-12">
																<div class="row align-items-center">
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Estado:</label>
																			<select class="form-control form-control-solid" id="cmbEstado" name="cmbEstado">
																				<option value="">[Todos]</option>
																				<?php foreach ($estados as $indice => $estado) { ?>
																					<option value="<?php echo $estado->ESTEstado ?>"><?php echo $estado->ESTDescripcion ?></option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Estado WhatsApp:</label>
																			<select class="form-control form-control-solid" id="cmbEstadoWapp" name="cmbEstadoWapp">
																				<option value="">[Todos]</option>
																				<?php foreach ($estadosWapp as $indice => $estado) { ?>
																					<option value="<?php echo $estado->ESTWEstado ?>"><?php echo $estado->ESTWDescripcion ?></option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Especialidad / Servicio:</label>
																			<select class="form-control form-control-solid" id="cmbEspecialidad" name="cmbEspecialidad">
																				<option value="">[Todos]</option>
																				<?php foreach ($especialidades as $indice => $especialidad) { ?>
																					<option value="<?php echo $especialidad->ESPNombre ?>"><?php echo $especialidad->ESPNombre ?></option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<!--end::Toolbar-->
														</div>
													</div>
													<div class="mb-7">
														<div class="row align-items-center">
															<div class="col-lg-12 col-xl-12">
																<div class="row align-items-center">
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-none d-md-block">Fecha:&nbsp;</label>
																			<!--begin::Daterange-->
																			<input id="cmbCargarTp" name="cmbCargarTp" type="hidden" class="form-control" value="<?php echo $cargar_tp; ?>">
																			<input id="cmbIpsActiva" name="cmbIpsActiva" type="hidden" class="form-control" value="<?php echo $ips_activa; ?>">
																			<a href="#!" class="btn btn-light font-weight-bold mr-2" id="kt_reporte_dtpicker">
																				<input id="hidFechaIni" name="hidFechaIni" type="hidden" class="form-control" value="<?php echo $fecha_ini; ?>">
																				<input id="hidFechaFin" name="hidFechaFin" type="hidden" class="form-control" value="<?php echo $fecha_fin; ?>">
																				<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_reporte_dtpicker_title">Fecha</span>
																				<span class="text-primary font-size-base font-weight-bolder" id="kt_reporte_dtpicker_date"><?php echo date("M d", strtotime($fecha_ini)); ?></span>
																			</a>
																			<a href="#!" id="kt_dashboard_reload" class="btn btn-clean btn-icon">
																				<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																						<rect x="0" y="0" width="24" height="24"/>
																						<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
																						<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
																					</g>
																				</svg><!--end::Svg Icon--></span>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</form>
												<!--begin::Table-->
												<!--begin: Datatable-->
												<table id="dt-tbl-reporte-citas" class="table table-separate table-vertical-center">
													<thead>
														<tr>
															<th></th>
															<th>NOMBRE/CÉDULA</th>
															<th>TÉLEFONO</th>
															<th>SEDE/MÉDICO/ ESPECIALIDAD</th>
															<th>HORA</th>
															<th>ESTADO</th>
															<th>ESTADO WHATSAPP</th>
															<th>PACIENTE INTERACTUÓ</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($citas as $indice => $cita) { ?>
															<tr id="tr<?php echo $cita->CITId; ?>" class="<?php echo ($cita->TIPBloqueado == 1 && $cita->MinutosDesbloqueo < 5) ? "bg-light-primary" : ($cita->AGEId != "" ? "bg-light-warning" : "") ?>">
																<td></td>
																<td>
																	<span class="text-dark-75"><?php echo $cita->CITPaciente ?></span>
																	<div>
																		<span class="text-muted font-weight-bold"><?php echo $cita->CITCedulaPaciente ?></span>
																	</div>
																</td>
																<td>
																	<span class="text-muted font-weight-bold"><?php echo $cita->CITTelefono ?></span>
																</td>
																<td>
																	<span class="text-dark-75"><?php echo $cita->CITSede ?></span>
																	<div>
																		<span class="font-weight-bolder"><?php echo $cita->CITMedico ?></span>
																	</div>
																	<div>
																		<span class="text-muted"><?php echo $cita->CITEspecialidad ?></span>
																	</div>
																</td>
																<td>
																	<span class="text-muted"><?php echo $cita->CITHoraCita ?></span>
																</td>
																<td>
																	<span class="<?php echo ($cita->ESTColor == "" ? "" : "text-" . $cita->ESTColor) ?>"><?php echo $cita->ESTDescripcion ?></span>
																</td>
																<td>
																	<span class="<?php echo ($cita->ESTWColor == "" ? "" : "text-" . $cita->ESTWColor) ?>"><i class="icon-lg <?php echo  $cita->ESTWIcon . ($cita->ESTWColor == "" ? "" : " text-" . $cita->ESTWColor) ?>"></i> <?php echo $cita->ESTWDescripcion ?></span>
																</td>
																<td>
																	<span class="text-muted"><?php echo $cita->CITInteraccion ?></span>
																</td>
																<td>
																	<?php if($cita->CITEstado >= 1) {?>
																	<div class="dropdown dropdown-inline">
																		<button type="button" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<span class="icon-lg fas fa-cog"></span>
																		</button>
																		<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
																			<ul class="navi flex-column navi-hover py-2">
																				<li class="navi-item">
																					<a href="#!" class="navi-link" onclick="VerChat(<?php echo $cita->CITId ?>)">
																						<span class="navi-icon">
																							<i class="fab fa-whatsapp"></i>
																						</span>
																						<span class="navi-text">Ver chat</span>
																					</a>
																				</li>
																				<?php 
																					$fechaCita = new DateTime(date('Y-m-d', strtotime($cita->FechaHoraCita)));
																					$intervaloDias = $fechaManana->diff($fechaCita)->d;
																					if($intervaloDias == 0 || $intervaloDias == 1) {
																				?>
																					<li class="navi-item">
																						<a href="#!" class="navi-link" onclick="VerTipificador(<?php echo $cita->CITId ?>)">
																							<span class="navi-icon">
																								<i class="fab fa-wpforms"></i>
																							</span>
																							<span class="navi-text">Tipificar</span>
																						</a>
																					</li>
																				<?php } ?>
																			</ul>
																		</div>
																	</div>
																	<?php } ?>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
												<!--end: Datatable-->
											</div>
										</div>
										<!--end::Body-->
									</div>
									<!--end::Advance Table Widget 2-->
								</div>
							</div>
							<!--end::Row-->
							<!--end::Reportes-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Entry-->
				</div>
				<!--end::Content-->
				<?php include_once(APPPATH . 'views/inc/footer.php'); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>

	<?php include_once(APPPATH . 'views/inc/js-admin.php'); ?>
</body>
</html>