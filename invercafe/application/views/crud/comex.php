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
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Módulo Comex</h5>
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
							<div class="row">
								<div class="col-xxl-8">
									<input id="hidIdContrato" name="hidIdContrato" type="hidden" class="form-control" value="<?php echo (isset($contrato->CONTId) ? $contrato->CONTId : "") ?>">	
									<!--div class="card card-custom card-fit card-border p-5 mb-4"-->
									<div class="card card-custom card-border">
										<div class="card-header border-0">
											<h3 class="card-title">
												<span class="card-label font-weight-bold font-size-h4 text-primary">Ref. Interna # <?php echo sprintf("%06d", $contrato->CONTId) ?></span>
											</h3>
											<div class="card-toolbar alert alert-custom alert-notice alert-light-warning p-4">
												<ul class="nav nav-pills nav-pills-sm nav-light">
													<li class="nav-item">
														<span class="alert-text font-size-sm font-weight-bolder"><?php echo $contrato->MesEmbarque . " " . $contrato->RangoEmbarque . ", " . $contrato->CONTAnioEmbarque ?></span>
														<span class="alert-text font-size-sm d-block"><?php echo ($contrato->TCONId == 2 ? "" : $contrato->Posicion . ", " . $contrato->CONTAnioPosicion) ?></span>
														<span class="alert-text font-size-sm d-block"><?php echo $contrato->PuertoEmbarque ?></span>

													</li>
												</ul>
											</div>
										</div>
										<div class="row pl-5 pr-5">
											<div class="col-xxl-12">
												<div class="separator separator-dashed mb-5"></div>
											</div>
										</div>
										<div id="divContratoComex">
											<div class="row pl-5 pr-5">
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Referencia del cliente</label>
														<input id="txtRefBuyer" name="txtRefBuyer" type="text" class="form-control" autocomplete="off" placeholder="Referencia del Cliente" value="<?php echo $contrato->CONTRefBuyer ?>">
													</div>
												</div>
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Cliente</label>
														<span class="form-control form-control-solid"><?php echo $contrato->CLIENombre ?></span>
													</div>
												</div>
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Modalidad</label>
														<span class="form-control form-control-solid"><?php echo $contrato->TCONNombre ?></span>
													</div>
												</div>
											</div>
											<div class="row pl-5 pr-5">
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Broker</label>
														<select class="form-control live-search" id="cmbBroker" name="cmbBroker" data-size="5" data-live-search="true">
															<option value="">[Seleccionar]</option>
															<?php foreach ($brokers as $indice => $broker) { ?>
																<option value="<?php echo $broker->BROId ?>" <?php echo (isset($contrato->BROId) ? ($broker->BROId == $contrato->BROId ? "selected" : "") : "") ?>><?php echo $broker->BRONombre ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Referencia del broker</label>
														<input id="txtRefBroker" name="txtRefBroker" type="text" class="form-control" autocomplete="off" placeholder="Referencia del Broker" value="<?php echo $contrato->CONTRefBroker ?>">
													</div>
												</div>
												<div class="col-xxl-4">
													<div class="form-group">
														<label>Comisión del broker</label>
														<input id="txtComisionBroker" name="txtComisionBroker" class="form-control mask" data-mask="$" placeholder="Comisión del broker"  placeholder="Comisión del broker" value="<?php echo $contrato->CONTComisionBroker ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row pl-5 pr-5 pb-5">
											<div class="col-lg-4">
												<a href="#" id="btn-contrato-comex" class="btn btn-light-primary btn-sm" >
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
													<span class="font-size-base mr-2">Almacenar</span>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xxl-4">
									<div class="card card-custom card-fit card-border p-5 mb-4">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bold font-size-h4 text-success">Documentación</span>
										</h3>
										<div class="separator separator-dashed mb-5"></div>
										<div class="timeline timeline-5">
											<div class="timeline-items">
												<div class="timeline-item">
													<!--begin::Icon-->
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Clip.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"/>
																	<path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
																</g>
															</svg><!--end::Svg Icon-->
														</span>
													</div>
													<!--end::Icon-->
													<!--begin::Info-->
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Adjuntar contrato del cliente</span>
														<div class='form-group mb-3 mt-3'>
															<div id='MFUpldCliente' class='upload' data-filename='<?php echo $contrato->CONTId ?>&contrato-cliente'>Cargar última versión</div>
															<div id='status'></div>
														</div>
														<!--p class="font-weight-normal text-dark-50 pt-1">To start a blog, think of a topic about and first brainstorm ways to write details</p-->
													</div>
													<!--end::Info-->
												</div>
												<div class="timeline-item">
													<!--begin::Icon-->
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Clip.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"/>
																	<path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
																</g>
															</svg><!--end::Svg Icon-->
														</span>
													</div>
													<!--end::Icon-->
													<!--begin::Info-->
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Adjuntar contrato del broker</span>
														<div class='form-group mb-3 mt-3'>
															<div id='MFUpldBroker' class='upload' data-filename='<?php echo $contrato->CONTId ?>&contrato-broker'>Cargar última versión</div>
															<div id='status'></div>
														</div>
														<!--p class="font-weight-normal text-dark-50 pt-1">To start a blog, think of a topic about and first brainstorm ways to write details</p-->
													</div>
													<!--end::Info-->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="card card-custom card-fit card-border p-5 mb-4">
										<div class="card-toolbar mb-5">
											<ul class="nav nav-pills nav-pills-sm nav-dark-75">
												<li class="nav-item">
													<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#tab-fijacion">Fijación</a>
												</li>
												<li class="nav-item">
													<a class="nav-link py-2 px-4" data-toggle="tab" href="#tab-factura">Datos factura</a>
												</li>
											</ul>
										</div>

										<div class="separator separator-dashed mb-5"></div>

										<div class="tab-content">
											<div class="tab-pane fade show active" id="tab-fijacion" role="tabpanel" aria-labelledby="tab-fijacion">
												<!--begin::Table-->
												<div class="table-responsive detalle-venta">
													<table id="table-fijacion-lotes" class="table table-head-custom table-head-bg table-borderless table-vertical-center">
														<thead>
															<tr>
																<th></th>
																<th>Lote</th>
																<th>Cantidad</th>
																<th>Kilos.Unid</th>
																<th>Eq.Kg</th>
																<th>Calidad/Cert/Desc</th>
																<th>Req.Adic</th>
																<th>Fix/Dif</th>
																<th>Cto.Cert</th>
																<th>Dif.Neto</th>
																<th>Prec.Fijac</th>
																<th>Fech.Fijac</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
														<?php if(isset($contrato->TCONId)) {
															foreach ($detalleVenta as $indice => $item) { ?>
															<tr>
																<td>
																	<?php if($item->DETKilos != "") { // esta opcion es solo para lotes reales NO ad. en bolsa?>
																		<div class="dropdown dropdown-inline" data-placement="left">
																			<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				<i class="ki ki-bold-more-hor"></i>
																			</a>
																			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
																				<!--begin::Navigation-->
																				<ul id="menu-lote" class="navi navi-hover py-5">
																					<?php if($item->DETNroLote == "") { // esta opcion es solo para lotes realnes NO ad. en bolsa?>
																						<li class="navi-item">
																							<a href="#" class="navi-link" onclick="GenerarLote(this, <?php echo $item->DETId ?>)">
																								<span class="navi-icon">
																									<i class="flaticon2-add"></i>
																								</span>
																								<span class="navi-text">Generar número lote</span>
																							</a>
																						</li>
																					<?php } else { ?>														
																						<li class="navi-item">
																							<a href="#" class="navi-link" onclick="LiberarLote(this, <?php echo $item->DETId ?>)">
																								<span class="navi-icon">
																									<i class="flaticon-delete"></i>
																								</span>
																								<span class="navi-text">Liberar número lote</span>
																							</a>
																						</li>
																						<li class="navi-item">
																							<span class="navi-link">
																								<span class="navi-icon">
																									<i class="flaticon2-edit"></i>
																								</span>
																								<span class="navi-text">
																									<input id="txtNewLot" name="txtNewLot" class="form-control form-control-sm col-sm-10 mask" data-mask="Nro" value="<?php echo $item->DETNroLote ?>">
																								</span>
																								<span class="navi-link-badge">
																									<a href="#" class="label label-light-warning label-inline font-weight-bold" onclick="ModificarLote(this, <?php echo $item->DETId ?>)">modificar</a>
																								</span>
																							</span>
																						</li>
																					<?php } ?>														
																				</ul>
																				<!--end::Navigation-->
																			</div>
																		</div>
																	<?php } ?>														
																</td>
																<td class="text-success font-weight-bolder <?php echo ($item->DETNroLote == "" ? "" : "table-success") ?>"><?php echo ($item->DETKilos != "" ? $item->DETNroLote : "Bolsa") ?></td>
																<td class="text-dark font-weight-bolder"><?php echo $item->DETCantidad ?></td>
																<td class="text-dark font-weight-bolder"><?php echo $item->Kilos ?></td>
																<td class="text-dark font-weight-bolder"><?php echo $item->EqKilos ?></td>
																<td><span class="text-dark font-weight-bolder"><?php echo $item->Calidad ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->DETDescEspecial ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->Certificacion ?></span></td>
																<td class="text-dark font-weight-bolder"><?php echo $item->Requerimientos ?></td>
																<td id="span-precio-fix" class="text-dark font-weight-bolder"><?php echo $item->DETUsdLbs ?></td>
																<td>
																	<?php if($item->Certificacion != "") { ?>
																		<input id="txtCtoCertificado" name="txtCtoCertificado" class="form-control form-control-sm mask" data-mask="$" placeholder="Costo certificado" value="<?php echo $item->LOTCostoCertificado ?>" onchange="CalcularDiferencial(this)">
																	<?php } ?>
																</td>
																<td id="span-dif-neto" class="text-success"><?php echo ($item->DETUsdLbs - $item->LOTCostoCertificado - $contrato->CONTComisionBroker) ?></td>
																<td id="span-precio-fijacion" class="<?php echo ($item->LOTFechaFijacion == "" ? "" : "table-success") ?>"><input id="txtPrecioFijacion" name="txtPrecioFijacion" class="form-control form-control-sm mask" data-mask="$" placeholder="Precio fijación" value="<?php echo $item->LOTPrecioFijacion ?>"></td>
																<td>
																	<a href="#!" class="btn btn-sm btn-light font-weight-bold mr-2 select-dtpicker">
																		<input id="hidFechaProg" name="hidFechaProg" type="hidden" class="form-control" value="<?php echo $item->LOTFechaFijacion ?>">
																		<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_programar_datepicker_title"><?php echo ($item->LOTFechaFijacion == "" ? "Seleccionar" : "") ?></span>
																		<span class="text-primary font-size-base font-weight-bolder" id="kt_programar_datepicker_date"><?php echo ($item->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($item->LOTFechaFijacion))); ?></span>
																	</a>
																</td>
																<td>
																	<a href="#!" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-modal-prog" onclick="FijarPrecio(this, <?php echo $item->DETId ?>)">
																		<span class="svg-icon svg-icon svg-icon-md svg-icon-primary">
																			<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Done-circle.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24"/>
																					<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
																					<path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
																				</g>
																			</svg><!--end::Svg Icon-->
																		</span>
																	</a>
																	<a href="#!" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-modal-prog" onclick="VerForward(<?php echo $item->DETId ?>)">
																		<span class="svg-icon svg-icon svg-icon-md svg-icon-primary">
																			<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Done-circle.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24"/>
																					<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
																					<path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
																				</g>
																			</svg><!--end::Svg Icon-->
																		</span>
																	</a>
																</td>
															</tr>						
														<?php } } ?>
														</tbody>
													</table>
												</div>
												<!--end::Table-->
											</div>

											<div class="tab-pane fade" id="tab-factura" role="tabpanel" aria-labelledby="tab-factura">
												<!--begin::Table-->
												<div class="table-responsive">
													<table id="" class="table table-head-custom table-head-bg table-borderless table-vertical-center">
														<thead>
															<tr>
																<!--th></th-->
																<th>Lote</th>
																<th>Cantidad</th>
																<th>Kilos.Unid</th>
																<th>Eq.Kg</th>
																<th>Calidad/Cert/Desc</th>
																<th>Req.Adic</th>
																<th>Fix/Dif</th>
																<!--th>Cto.Cert</th>
																<th>Dif.Neto</th-->
																<th>Prec.Fijac</th>
																<th>Repeso.FNC(Kg)</th>
																<th>Repeso(Lbs)</th>
																<th>Precio.Pond</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
														<?php if(isset($contrato->TCONId)) {
															$valorFactura = 0;
															foreach ($detalleVenta as $indice => $item) {
																if($item->LOTFechaFijacion != "") { 
																	$valorFactura += $item->PrecioPond;
														?>
																	<tr>
																		<td class="text-success font-weight-bolder <?php echo ($item->DETNroLote == "" ? "" : "table-success") ?>"><?php echo ($item->DETKilos != "" ? $item->DETNroLote : "Bolsa") ?></td>
																		<td class="text-dark font-weight-bolder"><?php echo $item->DETCantidad ?></td>
																		<td class="text-dark font-weight-bolder"><?php echo $item->Kilos ?></td>
																		<td class="text-dark font-weight-bolder"><?php echo $item->EqKilos ?></td>
																		<td><span class="text-dark font-weight-bolder"><?php echo $item->Calidad ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->DETDescEspecial ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->Certificacion ?></span></td>
																		<td class="text-dark font-weight-bolder"><?php echo $item->Requerimientos ?></td>
																		<td class="text-muted font-weight-bold"><?php echo $item->DETUsdLbs ?></td>
																		<!--td>
																			<?php if($item->Certificacion != "") { ?>
																				<input id="txtCtoCertificado" name="txtCtoCertificado" class="form-control form-control-sm mask" data-mask="$" placeholder="Costo certificado" value="<?php echo $item->LOTCostoCertificado ?>" onchange="CalcularDiferencial(this)">
																			<?php } ?>
																		</td>
																		<td id="span-dif-neto" class="text-success"><?php echo ($item->DETUsdLbs - $item->LOTCostoCertificado) ?></td-->
																		<td class="text-muted font-weight-bold"><?php echo $item->LOTPrecioFijacion ?></td>
																		<!--td>
																			<a href="#!" class="btn btn-sm btn-light font-weight-bold mr-2 select-dtpicker">
																				<input id="hidFechaProg" name="hidFechaProg" type="hidden" class="form-control" value="<?php echo $item->LOTFechaFijacion ?>">
																				<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_programar_datepicker_title"><?php echo ($item->LOTFechaFijacion == "" ? "Seleccionar" : "") ?></span>
																				<span class="text-primary font-size-base font-weight-bolder" id="kt_programar_datepicker_date"><?php echo ($item->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($item->LOTFechaFijacion))); ?></span>
																			</a>
																		</td-->
																		<td>
																			<?php if($item->DETKilos != "") { ?>
																				<input id="txtRepesoFNC" name="txtRepesoFNC" class="form-control form-control-sm mask" data-mask="Nro" placeholder="Repeso(Kg)" value="<?php echo number_format($item->LOTRepesoFNC, 0, '.', ',') ?>" onchange="CalcularRepesoLbs(this)"></td>
																			<?php } ?>
																		<td id="span-repeso-lbs" class="text-success"><?php echo ($item->LOTRepesoFNC == "" ? "" : number_format($item->RepesoLibras, 2, '.', ',')) ?></td-->
																		<td class="text-muted font-weight-bold"><?php echo ($item->LOTRepesoFNC == "" ? "" : number_format($item->PrecioPond, 2, '.', ',')) ?></td>
																		<td>
																			<?php if($item->DETKilos != "") { ?>
																				<a href="#!" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-modal-prog" onclick="FijarPrecio(this, <?php echo $item->DETId ?>)">
																					<span class="svg-icon svg-icon svg-icon-md svg-icon-primary">
																						<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Done-circle.svg-->
																						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																								<rect x="0" y="0" width="24" height="24"/>
																								<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
																								<path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
																							</g>
																						</svg><!--end::Svg Icon-->
																					</span>
																				</a>
																			<?php } ?>
																		</td>
																	</tr>						
														<?php } } } ?>
														</tbody>
													</table>
												</div>
												<!--end::Table-->
												<div class="modal-footer p-2">
													<div class="card-toolbar alert alert-custom alert-notice alert-primary p-4">
														<ul class="nav nav-pills nav-pills-sm nav-light">
															<li class="nav-item">
																<span class="alert-text font-weight-bolder">DIFERENCIAL PONDERADO</span>
																<span class="alert-text font-size-h4 d-block"><?php echo number_format($promFinalPond, 2, '.', ',') ?></span>
															</li>
														</ul>
													</div>
													<div class="card-toolbar alert alert-custom alert-notice alert-danger p-4">
														<ul class="nav nav-pills nav-pills-sm nav-light">
															<li class="nav-item">
																<span class="alert-text font-weight-bolder">VALOR FACTURA (USD)</span>
																<span class="alert-text font-size-h4 d-block"><?php echo number_format($valorFactura, 2, '.', ',') ?></span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<!--div class="col-xxl-7">
									<div class="card card-custom card-fit card-border p-5 mb-4">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bold font-size-h4 text-success">Checklist</span>
										</h3>
										<div class="separator separator-dashed mb-5"></div>
										<div class="timeline timeline-5">
											<div class="timeline-items">
												<div class="timeline-item">
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																</g>
															</svg>
														</span>
													</div>
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Envío de muestra con número de lote</span>
														<div class="row mt-3 mb-3">
															<div class="col-xxl-6">
																<a href="#!" class="btn btn-block btn-light font-weight-bold mr-2" id="kt_dashboard_datepicker" data-view="admin">
																	<input id="hidFechaIni" name="hidFechaIni" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<input id="hidFechaFin" name="hidFechaFin" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_datepicker_title">Fecha:</span>
																	<span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_datepicker_date"><?php echo str_replace('.', '', strftime("%b %d", strtotime($fecha_hoy))); ?></span>
																</a>
															</div>
															<div class="col-xxl-6">
																<input id="txtCantidadUnid" name="txtCantidadUnid" class="form-control mask" data-mask="Nro" placeholder="Número de guía">
															</div>
														</div>
													</div>
												</div>
												<div class="timeline-item">
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
																	<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
																</g>
															</svg>
														</span>
													</div>
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Recibo de muestra por el cliente</span>
														<div class="row mt-3 mb-3">
															<div class="col-xxl-2">
																<span class="switch switch-outline switch-icon switch-success">
																	<label> 
																		<input type="checkbox"/>
																		<span></span>
																	</label>
																</span>
															</div>
															<div class="col-xxl-5">
																<a href="#!" class="btn btn-block btn-light font-weight-bold mr-2" id="kt_dashboard_datepicker" data-view="admin">
																	<input id="hidFechaIni" name="hidFechaIni" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<input id="hidFechaFin" name="hidFechaFin" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_datepicker_title">Fecha:</span>
																	<span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_datepicker_date"><?php echo str_replace('.', '', strftime("%b %d", strtotime($fecha_hoy))); ?></span>
																</a>
															</div>
															<div class="col-xxl-5">
																<input id="txtCentLbs" name="txtCentLbs" class="form-control" placeholder="Nombre de quien recibe">
															</div>
														</div>
													</div>
												</div>
												<div class="timeline-item">
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="#000000" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)" />
																	<path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="#000000" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)" />
																	<path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="#000000" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)" />
																	<path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="#000000" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)" />
																</g>
															</svg>
														</span>
													</div>
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Aprobación / Rechazo de muestra</span>
														<div class="row mt-3 mb-3">
															<div class="col-xxl-2">
																<span class="switch switch-outline switch-icon switch-success">
																	<label> 
																		<input type="checkbox"/>
																		<span></span>
																	</label>
																</span>
															</div>
															<div class="col-xxl-5">
																<a href="#!" class="btn btn-block btn-light font-weight-bold mr-2" id="kt_dashboard_datepicker" data-view="admin">
																	<input id="hidFechaIni" name="hidFechaIni" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<input id="hidFechaFin" name="hidFechaFin" type="hidden" class="form-control" value="<?php echo $fecha_hoy; ?>">
																	<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_datepicker_title">Fecha:</span>
																	<span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_datepicker_date"><?php echo str_replace('.', '', strftime("%b %d", strtotime($fecha_hoy))); ?></span>
																</a>
															</div>
															<div class="col-xxl-5">

															</div>
														</div>
													</div>
												</div>
												<div class="timeline-item">
													<div class="timeline-media bg-light">
														<span class="svg-icon svg-icon svg-icon-md">
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																	<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																</g>
															</svg>
														</span>
													</div>
													<div class="timeline-desc timeline-desc-light">
														<span class="font-weight-bolder text-muted">Indicar costo del certificado</span>
														<input id="txtCentLbs" name="txtCentLbs" class="form-control mask mb-3 mt-3" data-mask="$" placeholder="USD Cents/Lb">
													</div>
												</div>
											</div>
										</div>
										<a href="#" id="btn-detalle-venta" class="btn btn-light-warning btn-sm" >
											<span class="svg-icon svg-icon-md">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"></polygon>
														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>
													</g>
												</svg>
											</span>
											<span class="font-size-base mr-2">Almacenar</span>
										</a>
									</div>
								</div-->
							</div>	

						</div>
						<!--end::Container-->
					</div>
					<!--end::Entry-->
					<!-- Modal 1-->
					<div id="mdlForward" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
						<form id="frmCmx" class="form" novalidate="novalidate" data-view="comex" data-context="comex">
							<div class="modal-dialog modal-dialog-centered modal-xl" role="document"></div>
						</form>
					</div>
					<!--end::Modal1-->
				</div>
				<!--end::Content-->
				<?php include_once(APPPATH . 'views/inc/footer.php'); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<?php include_once(APPPATH . 'views/inc/js-admin.php'); ?>
	<script src="<?php echo $template; ?>js/pages/contratos.js?v=7.2.9"></script>
</body>
</html>