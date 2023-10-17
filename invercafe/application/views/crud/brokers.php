<?php include(APPPATH . 'views/inc/head.php'); ?>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<?php include_once(APPPATH . 'views/inc/header-mobile.php'); ?>
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
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
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Administrar Brokers</h5>
								<!--end::Page Title-->
								<!--begin::Actions-->
								<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
								<span class="text-muted font-weight-bold mr-4"><?php echo "" ?></span>
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
								<div class="col-lg-10 col-md-12 col-sm-12 col-xxl-12">
									<!--begin::Advance Table Widget 2-->									
									<div id="panel-prog-diaria" class="card card-custom card-stretch gutter-b">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark">Listado de Brokers</span>
												<span class="text-muted mt-3 font-weight-bold font-size-sm">Se encontraron <?php echo count($brokers); ?> brokers disponibles</span>
											</h3>
											<div class="card-toolbar">
												<a href="#" class="btn btn-success btn-outline-success font-weight-bold btn-pill" onclick="VerModal()">
													<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
													<span class="svg-icon svg-icon-md">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
															</g>																													
														</svg><!--end::Svg Icon-->
													</span>Adicionar
												</a>
											</div>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Table-->
											<table id="tbl-brokers" class="table table-head-custom table-head-bg table-borderless table-vertical-center table-responsive">
												<thead>
													<tr>
														<th>Broker</th>
														<th>País</th>
														<th>Ciudad</th>
														<th>Contacto</th>
														<th>Télefono</th>
														<th>Dirección</th>
														<th>Estado</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($brokers as $indice => $broker) { ?>
														<tr>
															<td>
																<span class="text-muted font-weight-bold"><?php echo $broker->BRONombre ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $broker->country_name ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $broker->BROCiudad ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $broker->BROContacto ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $broker->BROTelefono ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $broker->BRODireccion ?></span>
															</td>
															<td class="text-center">
																<span class="switch switch-sm">
																	<label>
																		<input type="checkbox" <?php echo ($broker->BROEstado == 1 ? "checked" : ""); ?> onclick="actualizarEstadoBroker(<?php echo $broker->BROId . ", " . ($broker->BROEstado == 1 ? 0 : 1) ?>)"/>
																		<span></span>
																	</label>
																</span>
															</td>
															<td class="pr-0 text-right">
																<a href="#!" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-modal-prog" onclick="VerModal('<?php echo $broker->BROId ?>')">
																	<span class="svg-icon svg-icon-md svg-icon-primary">
																		<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<polygon points="0 0 24 0 24 24 0 24"></polygon>
																				<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
																				<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
											<!--end: Datatable-->
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
					<!-- Modal-->
					<div id="mdlGestion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
						<form id="frmProg" class="form" novalidate="novalidate" data-view="brokers" data-context="brokers">
							<div class="modal-dialog" role="document"></div>
						</form>
					</div>
				</div>
				<!--end::Content-->
				<?php include_once(APPPATH . 'views/inc/footer.php'); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?php echo $template; ?>js/pages/brokers.js?v=7.2.9"></script>
	<?php include_once(APPPATH . 'views/inc/js-admin.php'); ?>
</body>
</html>