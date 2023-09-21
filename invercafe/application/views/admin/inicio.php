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
									<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Panel de Control</h5>
									<!--end::Page Title-->
									<!--begin::Actions-->
									<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
									<a href="#" class="btn btn-light-warning btn-sm mr-2" onclick="VerModal();tblDetalleVenta=[]">
										<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
										<span class="svg-icon svg-icon-md">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
												</g>
											</svg><!--end::Svg Icon-->
										</span>
										<span class="font-size-base mr-2">Contrato</span>
									</a>
									<a href="#" class="btn btn-light-success  btn-sm mr-2" onclick="VerModal()">
										<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
										<span class="svg-icon svg-icon-md">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
												</g>
											</svg><!--end::Svg Icon-->
										</span>
										<span class="font-size-base mr-2">Cliente</span>
									</a>
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
								<?php if($user_rolid == 3) { ?>
									<!--begin::Row-->
									<div class="row">
										<div class="col-lg-8 col-xxl-8">
											<!--begin::Mixed Widget 1-->
											<div id="panel-totales-hoy" class="card card-custom bg-gray-100 card-stretch gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0 bg-danger py-5">
													<h3 class="card-title font-weight-bolder text-white"><?php echo strftime("%d de %B", strtotime($fecha_hoy)); ?></h3>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body p-0 position-relative overflow-hidden">
													<!--begin::Chart-->
													<div class="card-rounded-bottom bg-danger" style="height: 200px">
														<div class="d-flex align-items-center flex-lg-fill py-5 p-10">
															<span class="mr-4">
																<span class="svg-icon svg-icon-4x svg-icon-white d-block my-2">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																			<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																			<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																			<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</span>
															<div class="d-flex flex-column text-dark-75">
																<span class="text-white font-weight-bold font-size-h1" id="span-total-dia"><?php echo $total_dia->TotalDia; ?></span>
																<span class="text-white font-weight-bold font-size-h6">Citas Cargadas</span>
															</div>
														</div>
													</div>
													<!--end::Chart-->
													<!--begin::Stats-->
													<div class="card-spacer mt-n25">
														<!--begin::Row-->
														<div class="row m-0">
															<div class="col bg-light-info px-6 py-8 rounded-xl mr-3 mb-7">
																<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
																	<span class="mr-4">
																		<i class="flaticon2-layers icon-3x text-info font-weight-bold"></i>
																	</span>
																	<div class="d-flex flex-column text-dark-75">
																		<span class="text-info font-weight-bold font-size-h1" id="span-total-pendiente"><?php echo ($total_dia->Pendiente == "" ? 0 : $total_dia->Pendiente); ?></span>
																	</div>
																	<span class="px-11"></span>
																	<div class="d-flex flex-column text-dark-75 px-3">
																		<span class="text-info font-weight-bolder font-size-h1" id="span-porcen-pendiente"><?php echo ($total_dia->Pendiente == "" ? 0 : round(($total_dia->Pendiente/$total_dia->TotalDia)*100)); ?>%</span>
																	</div>
																</div>
																<span class="text-info font-weight-bold font-size-h6">Pendientes por gestionar</span>
															</div>
															<div class="col bg-light-danger px-6 py-8 rounded-xl mr-3 mb-7">
																<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
																	<span class="mr-4">
																		<i class="flaticon-warning-sign icon-3x text-danger font-weight-bold"></i>
																	</span>
																	<div class="d-flex flex-column text-dark-75">
																		<span class="text-danger font-weight-bold font-size-h1" id="span-total-error"><?php echo ($total_dia->Error == "" ? 0 : $total_dia->Error); ?></span>
																	</div>
																	<span class="px-11"></span>
																	<div class="d-flex flex-column text-dark-75 px-3">
																		<span class="text-danger font-weight-bolder font-size-h1" id="span-porcen-error"><?php echo ($total_dia->Error == "" ? 0 : round(($total_dia->Error/$total_dia->TotalDia)*100)); ?>%</span>
																	</div>
																</div>
																<span class="text-danger font-weight-bold font-size-h6">Error en cargue</span>
															</div>
														</div>
														<!--end::Row-->
														<!--begin::Row-->
														<div class="row m-0">
															<div class="col bg-light-warning px-6 py-8 rounded-xl mr-3 mb-7">
																<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
																	<span class="mr-4">
																		<i class="flaticon2-send-1 icon-3x text-warning font-weight-bold"></i>
																	</span>
																	<div class="d-flex flex-column text-dark-75">
																		<span class="text-warning font-weight-bold font-size-h1" id="span-total-enviada"><?php echo ($total_dia->Enviada == "" ? 0 : $total_dia->Enviada); ?></span>
																	</div>
																	<span class="px-11"></span>
																	<div class="d-flex flex-column text-dark-75 px-3">
																		<span class="text-warning font-weight-bolder font-size-h1" id="span-porcen-enviada"><?php echo ($total_dia->Enviada == "" ? 0 : round(($total_dia->Enviada/$total_dia->TotalDia)*100)); ?>%</span>
																	</div>
																</div>
																<span class="text-warning font-weight-bold font-size-h6">Citas Sin responder</span>
															</div>
															<div class="col bg-light-danger px-6 py-8 rounded-xl mr-3 mb-7">
																<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
																	<span class="mr-4">
																		<i class="flaticon-delete-2 icon-3x text-danger font-weight-bold"></i>
																	</span>
																	<div class="d-flex flex-column text-dark-75">
																		<span class="text-danger font-weight-bold font-size-h1" id="span-total-cancelada"><?php echo ($total_dia->Cancelada == "" ? 0 : $total_dia->Cancelada); ?></span>
																	</div>
																	<span class="px-11"></span>
																	<div class="d-flex flex-column text-dark-75 px-3">
																		<span class="text-danger font-weight-bolder font-size-h1" id="span-porcen-cancelada"><?php echo ($total_dia->Cancelada == "" ? 0 : round(($total_dia->Cancelada/$total_dia->TotalDia)*100)); ?>%</span>
																	</div>
																</div>
																<span class="text-danger font-weight-bold font-size-h6 mt-2">Citas Canceladas</span>
															</div>
														</div>
														<!--end::Row-->
														<!--begin::Row-->
														<div class="row m-0">
															<div class="col bg-light-success px-6 py-8 rounded-xl mr-3 mb-7">
																<div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
																	<span class="mr-4">
																		<i class="flaticon2-calendar-6 icon-3x text-success font-weight-bold"></i>
																	</span>
																	<div class="d-flex flex-column text-dark-75">
																		<span class="text-success font-weight-bold font-size-h1" id="span-total-confirmada"><?php echo ($total_dia->Confirmada == "" ? 0 : $total_dia->Confirmada); ?></span>
																	</div>
																	<span class="px-11"></span>
																	<div class="d-flex flex-column text-dark-75 px-3">
																		<span class="text-success font-weight-bolder font-size-h1" id="span-porcen-confirmada"><?php echo ($total_dia->Confirmada == "" ? 0 : round(($total_dia->Confirmada/$total_dia->TotalDia)*100)); ?>%</span>
																	</div>
																</div>
																<span class="text-success font-weight-bold font-size-h6 mt-2">Citas Confirmadas</span>
															</div>
															<div class="col px-6 py-8 rounded-xl mr-3 mb-7">
															</div>
														</div>
														<!--end::Row-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Mixed Widget 1-->
										</div>
										<div class="col-lg-4 col-xxl-4">
											<!--begin::Mixed Widget 14-->
											<div id="panel-confirmacion" class="card card-custom gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0 pt-5">
													<h3 class="card-title font-weight-bolder">Confirmación de asistencia</h3>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body d-flex flex-column">
													<div class="flex-grow-1">
														<div id="kt_mixed_widget_14_chart" data-porcen="<?php echo ($total_dia->Confirmada == "" ? 0 : round(($total_dia->Confirmada/$total_dia->TotalDia)*100)) ?>" style="height: 200px"></div>
													</div>
													<div class="pt-5">
														<p class="text-center font-weight-normal font-size-lg pb-7">Porcentaje de personas han confirmado su asistencia a las cita enviada por el canal de WhatsApp.</p>
													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Mixed Widget 14-->
										</div>
										<div class="col-xxl-12 order-2 order-xxl-1">
											<!--begin::Advance Table Widget 2-->
											<div id="panel-reporte-citas" class="card card-custom card-stretch gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0 pt-5">
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label font-weight-bolder text-dark">Reporte Citas: <span class="text-muted"><?php echo strftime("%d de %B", strtotime($fecha_hoy)); ?></span></span>
														<span class="text-muted mt-3 font-weight-bold font-size-sm">Cantidad de agendas encontradas: <?php echo count($citas); ?></span>
													</h3>
													<div class="card-toolbar">
														<a href="#" onclick="VerReporte();" class="btn btn-info font-weight-bolder font-size-sm mr-3">Ver reporte</a>
														<a href="#!" onclick="ExportarExcel(1, $('#cmbIpsActiva').val(), $('#hidFechaIni').val(), $('#hidFechaFin').val());" class="btn btn-success btn-outline-success font-weight-bold btn-pill"><i class="la la-file-excel-o"></i> Exportar</a>
													</div>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-2 pb-0 mt-n3">
													<div class="tab-content mt-5">
														<!--begin::Table-->
														<div class="table-responsive">
															<table id="tbl-reporte-citas" class="table table-head-custom table-head-bg table-borderless table-vertical-center">
																<thead>
																	<tr>
																		<th class="min-w-200px">NOMBRE/CÉDULA</th>
																		<th class="min-w-100px">TELEFONO</th>
																		<th class="min-w-200px">SEDE/MÉDICO/ESPECIALIDAD</th>
																		<th class="min-w-100px">HORA</th>
																		<th class="min-w-100px">ESTADO</th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach ($citas as $indice => $cita) { ?>
																		<tr>
																			<td class="pl-0">
																				<span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $cita->CITPaciente ?></span>
																				<div>
																					<span class="text-muted font-weight-bold"><?php echo $cita->CITCedulaPaciente ?></span>
																				</div>
																			</td>
																			<td>
																				<span class="text-muted font-weight-bold"><?php echo $cita->CITTelefono ?></span>
																			</td>
																			<td>
																				<span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg"><?php echo $cita->CITSede ?></span>
																				<div>
																					<span class="font-weight-bolder"><?php echo $cita->CITMedico ?></span>
																				</div>
																				<div>
																					<span class="text-muted font-weight-500"><?php echo $cita->CITEspecialidad ?></span>
																				</div>
																			</td>
																			<td>
																				<span class="text-muted font-weight-500"><?php echo $cita->CITHoraCita ?></span>
																			</td>
																			<td class="text-right">
																				<span class="<?php echo ($cita->ESTColor == "" ? "" : "label label-lg label-inline label-light-" . $cita->ESTColor) ?>"><?php echo $cita->ESTDescripcion ?></span>
																			</td>
																		</tr>
																	<?php if($indice >= 9) break; }?>
																</tbody>
															</table>
														</div>
														<!--end::Table-->
													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Advance Table Widget 2-->
										</div>
									</div>
									<!--end::Row-->
									<!--begin::Row-->
									<div class="row">
										<div class="col-lg-7">
											<!--begin::Advance Table Widget 4-->
											<div id="panel-reporte-semana" class="card card-custom card-stretch gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0 py-5">
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label font-weight-bolder text-dark">Consolidado Semanal</span>
														<span class="text-muted mt-3 font-weight-bold font-size-sm"><?php echo "Período del " . ucfirst(str_replace('.', '', (strftime("%d %b", strtotime($fecha_hoy . ' - 7 day'))))) . " al " . ucfirst(str_replace('.', '', strftime("%d %b %Y", strtotime($fecha_hoy)))); ?></span>
													</h3>
													<div class="card-toolbar">
														<a href="#!" onclick="ExportarExcel(2, $('#cmbIpsActiva').val(), $('#hidFechaIni').val(), $('#hidFechaFin').val());" class="btn btn-success btn-outline-success font-weight-bold btn-pill"><i class="flaticon-download"></i> Exportar</a>
													</div>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-0 pb-3">
													<div class="tab-content">
														<!--begin::Table-->
														<div class="table-responsive">
															<table id="tbl-reporte-semana" class="table table-head-custom table-head-bg table-borderless table-vertical-center">
																<thead>
																	<tr class="text-left text-uppercase">
																		<th class="min-w-100px pl-7">día</th>
																		<th class="min-w-100px">estado</th>
																		<th class="min-w-50px">cantidad</th>
																		<th class="min-w-50px">total día</th>
																		<th class="min-w-150px">porcentaje</th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach ($total_semana as $indice => $estado) { ?>
																	<tr>
																		<td>
																			<span class="text-text-dark-75 font-weight-bolder mb-1 font-size-lg text-uppercase"><?php echo utf8_encode(strftime("%A %d", strtotime($estado->CITFechaCita))) ?></span>
																		</td>
																		<td>
																			<span class="text-<?php echo $estado->ESTColor ?> font-weight-bolder mb-1 font-size-lg"><?php echo $estado->ESTDescripcion ?></span>
																		</td>
																		<td class="text-right">
																			<span class="text-muted font-weight-500"><?php echo $estado->Cantidad ?></span>
																		</td>
																		<td class="text-right">
																			<span class="text-muted font-weight-500"><?php echo $estado->TotalDia ?></span>
																		</td>
																		<td class="text-right">
																			<div class="d-flex align-items-center pt-2">
																				<div class="progress progress-xs mt-2 mb-2 w-100">
																					<div class="progress-bar bg-<?php echo $estado->ESTColor ?>" role="progressbar" style="width: <?php echo $estado->Porcentaje ?>%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																				</div>
																				<span class="ml-3 text-muted font-weight-500"><?php echo $estado->Porcentaje ?>%</span>
																			</div>																	
																		</td>
																	</tr>
																	<?php } ?>
																</tbody>
															</table>
														</div>
														<!--end::Table-->
													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Advance Table Widget 4-->
										</div>
										<div class="col-lg-5">
											<div id="panel-grafica-semana" class="card card-custom gutter-b">
												<div class="card-header h-auto border-0">
													<div class="card-title py-5">
														<h3 class="card-label">
															<span class="d-block text-dark font-weight-bolder">Comportamiento de las citas</span>
															<span class="text-muted mt-3 font-weight-bold font-size-sm"><?php echo "Período del " . ucfirst(str_replace('.', '', strftime("%d %b", strtotime($fecha_hoy . ' - 7 day')))) . " al " . ucfirst(str_replace('.', '', strftime("%d %b %Y", strtotime($fecha_hoy)))); ?></span>
														</h3>
													</div>
													<div class="card-toolbar">
														<div class="dropdown dropdown-inline">
															<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="ki ki-bold-more-hor"></i>
															</a>
														</div>
													</div>
												</div>
												<div class="card-body">
													<div id="kt_charts_widget_1_chart"></div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Row-->
								<?php } ?>
								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</form>
				</div>
				<!--end::Content-->
				<div id="mdlGestion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
					<form id="frmProg" class="form" novalidate="novalidate" data-view="contratos" data-context="contratos">
						<div class="modal-dialog modal-dialog-centered modal-xl" role="document"></div>
					</form>
				</div>
				<?php include_once(APPPATH . 'views/inc/footer.php'); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>

	<?php include_once(APPPATH . 'views/inc/js-admin.php'); ?>
</body>
</html>