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
					<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
						<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<!--begin::Info-->
							<div class="d-flex align-items-center flex-wrap mr-2">
								<!--begin::Page Title-->
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Configuración</h5>
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
								<div class="col-lg-6 col-xxl-6">
									<!--begin::Advance Table Widget 2-->									
									<div class="card card-custom card-stretch gutter-b">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark">Variables Globales</span>
												<span class="text-muted mt-3 font-weight-bold font-size-sm">Son variables importantes de configuración necesarias para el correcto funcionamiento de los procesos ejecutados automáticamente por <strong class="text-success"><?php echo $ipsActual->IPSChatbot ?></strong>.</span>
											</h3>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<form id="frmProg" class="form" novalidate="novalidate" data-view="config">
												<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
													<tbody>
														<tr>
															<td>
																<label><strong>1.</strong> ¿Con cuántos <strong>días</strong> de anticipación se debe extraer/notificar una agenda?</label>
															</td>
															<td class="min-w-150px">
																<input id="cmbCargarTp" name="cmbCargarTp" type="hidden" class="form-control" value="<?php echo $cargar_tp; ?>">
																<input id="cmbIpsActiva" name="cmbIpsActiva" type="hidden" class="form-control" value="<?php echo $ips_activa; ?>">
																<select class="form-control form-control-solid" id="cmbDiasRecordar" name="cmbDiasRecordar">
																	<?php for($i=1; $i<=5; $i++) { ?>
																		<option value="<?php echo $i ?>" <?php echo ($i==$ipsActual->IPSIntervaloDia ? "selected" : "") ?>><?php echo $i ?></option>
																	<?php } ?>
																</select>
															</td>
														</tr>
														<tr>
															<td>
																<label><strong>2.</strong> ¿Hasta que <strong>hora</strong> podrá una persona cancelar/confirmar una cita a través de <strong class="text-success"><?php echo $ipsActual->IPSChatbot ?></strong>?</label>
															</td>
															<td class="min-w-150px">
																<select class="form-control form-control-solid" id="cmbHorarioHasta" name="cmbHorarioHasta">
																	<?php for($i=0;$i<count($horario);$i++) {?>
																		<option value="<?php echo $horario[$i] ?>" <?php echo ($horario[$i]==$ipsActual->IPSHorarioHasta ? "selected" : "") ?>><?php echo $horario[$i] ?></option>
																	<?php } ?>
																</select>
															</td>
														</tr>
													</tbody>
												</table>
												<button id="btn-guardar-conf1" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
											</form>
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