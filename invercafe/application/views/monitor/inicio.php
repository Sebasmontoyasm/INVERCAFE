<?php include(APPPATH . 'views/inc/head.php'); ?>
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
					<form id="frmView" class="form" novalidate="novalidate" data-view="admin">
						<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-2">
									<!--begin::Page Title-->
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Monitor de extracción</h5>
									<!--end::Page Title-->
									<!--begin::Actions-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
									<span class="text-muted font-weight-bold mr-4"><?php echo ($user_rolid == 1 && $cargar_ips) ? $ips_nombre : "" ?></span>
									<!--end::Actions-->
								</div>
								<!--end::Info-->
								<?php if($user_rolid == 2 || $user_rolid == 3 || $cargar_ips) { ?>
									<!--begin::Toolbar-->
									<div class="d-flex align-items-center">
										<!--begin::Daterange-->
										<input id="cmbCargarTp" name="cmbCargarTp" type="hidden" class="form-control" value="<?php echo $cargar_tp; ?>">
										<input id="cmbIpsActiva" name="cmbIpsActiva" type="hidden" class="form-control" value="<?php echo $ips_activa; ?>">
										<!--a href="#!" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_datepicker" data-view="monitor">
											<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_datepicker_title">Fecha</span>
											<span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_datepicker_date"><?php echo str_replace('.', '', strftime("%b %d", strtotime($fecha_hoy))); ?></span>
										</a>
										<a href="#!" id="kt_dashboard_reload" class="btn btn-sm btn-clean btn-icon">
											<span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z" fill="#000000" fill-rule="nonzero"/>
												</g>
											</svg></span>
										</a-->
									</div>
									<!--end::Toolbar-->
								<?php } ?>
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
										<div class="card card-custom card-stretch gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 pt-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Extracción diaria</span>
													<span class="text-muted mt-3 font-weight-bold font-size-sm">Se encontraron <?php echo count($extraccion); ?> IPS con información extraída</span>
												</h3>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body">
												<!--begin::Table-->
												<div class="table-responsive">
													<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
														<thead>
															<tr>
																<th>Id</th>
																<th>IPS</th>
																<th>Fecha de Program.</th>
																<th>Fecha de Ejecución</th>
																<th>Consult.</th>
																<th>Interv. día</th>
																<th>Estado</th>
																<th>Total citas cargadas</th>
																<th colspan="2">Pendientes por gestionar</th>
																<th colspan="2">Error de cargue</th>
																<th colspan="2">Confirmadas</th>
																<th colspan="2">Canceladas</th>
																<th colspan="2">Sin Responder</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($extraccion as $indice => $extr) { ?>
																<tr>
																	<td>
																		<span class="text-dark-75"><?php echo $extr->IPSId ?></span>
																	</td>
																	<td>
																		<span class="text-dark-75"><?php echo $extr->IPS ?></span>
																	</td>
																	<td>
																		<span class="text-dark-75"><?php echo ($extr->FechaProgramacion == "" ? "" : date('d/m/Y', strtotime($extr->FechaProgramacion))) ?></span>
																	</td>
																	<td>
																		<span class="text-dark-75"><?php echo ($extr->FechaEjecucion == "" ? "" : date('d/m/Y H:i:s', strtotime($extr->FechaEjecucion))) ?></span>
																	</td>
																	<td>
																		<span class="text-muted font-weight-bold"><?php echo $extr->Consultorios ?></span>
																	</td>
																	<td>
																		<span class="text-muted font-weight-bold"><?php echo $extr->IntervalioDiaInicio ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-<?php echo ($extr->Estado == "EJECUTADO" ? "success" : "danger") ?>"><?php echo $extr->Estado ?></span>
																	</td>
																	<td>
																		<span class="text-dark font-weight-bolder font-size-lg"><?php echo $extr->TotalDia ?></span>
																	</td>
																	<td>
																		<span class="text-info font-weight-bolder font-size-lg"><?php echo $extr->Pendiente ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-info"><?php echo ($extr->TotalDia == 0 ? "0" : round($extr->Pendiente/$extr->TotalDia*100)) . '%' ?></span>
																	</td>
																	<td>
																		<span class="text-danger font-weight-bolder font-size-lg"><?php echo $extr->Error ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-danger"><?php echo ($extr->TotalDia == 0 ? "0" : round($extr->Error/$extr->TotalDia*100)) . '%' ?></span>
																	</td>
																	<td>
																		<span class="text-success font-weight-bolder font-size-lg"><?php echo $extr->Confirmada ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-success"><?php echo ($extr->TotalDia == 0 ? "0" : round($extr->Confirmada/$extr->TotalDia*100)) . '%' ?></span>
																	</td>
																	<td>
																		<span class="text-danger font-weight-bolder font-size-lg"><?php echo $extr->Cancelada ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-danger"><?php echo ($extr->TotalDia == 0 ? "0" : round($extr->Cancelada/$extr->TotalDia*100)) . '%' ?></span>
																	</td>
																	<td>
																		<span class="text-warning font-weight-bolder font-size-lg"><?php echo $extr->Enviada ?></span>
																	</td>
																	<td>
																		<span class="label label-lg label-inline label-light-warning"><?php echo ($extr->TotalDia == 0 ? "0" : round($extr->Enviada/$extr->TotalDia*100)) . '%' ?></span>
																	</td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
												<!--end: Datatable-->
											</div>
											<!--end::Body-->
										</div>
									</div>
									<!--end::Row-->
								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</form>
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