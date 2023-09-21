<?php include(APPPATH . 'views/inc/head.php'); ?>
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
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Administrar Lotes</h5>
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
								<div class="col-xxl-12 order-2 order-xxl-1">
									<!--begin::Advance Table Widget 2-->									
									<div id="panel-listado-lotes" class="card card-custom card-stretch gutter-b overlay">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark">Listado de Lotes</span>
												<span class="text-muted mt-3 font-weight-bold font-size-sm">Se encontraron <?php echo count($lotes); ?> lotes disponibles</span>
											</h3>
											<div class="card-toolbar">
												<!--a href="#!" onclick="ExportarExcel(1, $('#cmbIpsActiva').val(), $('#hidFechaIni').val(), $('#hidFechaFin').val());" class="btn btn-success btn-outline-success font-weight-bold btn-pill"><i class="la la-file-excel-o"></i> Exportar</a-->
												<a href="#!" id="btn-exportar-fechas" class="btn btn-success btn-outline-success font-weight-bold btn-pill" ><i class="la la-file-excel-o"></i> Exportar
													<input id="hidExpFechaIni" name="hidExpFechaIni" type="hidden" value="<?php //echo $fecha_ini; ?>">
													<input id="hidExpFechaFin" name="hidExpFechaFin" type="hidden" value="<?php //echo $fecha_fin; ?>">
												</a>
											</div>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body">
											<div class="overlay-wrapper">
												<form id="frmView" class="form" novalidate="novalidate" data-context="lotes" data-view="lotes">
													<div class="mb-7">
														<div class="row align-items-center">
															<div class="col-lg-12 col-xl-12">
																<div class="row align-items-center">
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-md-block">Período embarque:</label>
																			<a href="#!" id="dtDesde" class="btn btn-block btn-light font-weight-bold mr-0 mt-0 select-monthpicker">
																				<input id="hidFechaEmbarqueIni" name="hidFechaEmbarqueIni" type="hidden" class="form-control" value="<?php //echo $lote->LOTFechaFijacion ?>">
																				<span class="text-muted font-size-base font-weight-bold mr-2">Desde</span>
																				<span class="text-primary font-size-base font-weight-bolder"><?php //echo ($lote->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($lote->LOTFechaFijacion))); ?></span>
																			</a>&nbsp;-&nbsp;
																			<a href="#!" id="dtHasta" class="btn btn-block btn-light font-weight-bold mr-0 mt-0 select-monthpicker">
																				<input id="hidFechaEmbarqueFin" name="hidFechaEmbarqueFin" type="hidden" class="form-control" value="<?php //echo $lote->LOTFechaFijacion ?>">
																				<span class="text-muted font-size-base font-weight-bold mr-2">Hasta</span>
																				<span class="text-primary font-size-base font-weight-bolder"><?php //echo ($lote->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($lote->LOTFechaFijacion))); ?></span>
																			</a>
																		</div>
																	</div>
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-md-block">Estado Lote:</label>
																			<select class="form-control" id="cmbEstadoLote" name="cmbEstadoLote">
																				<option value="">[Todos]</option>
																				<option value="1">Con lote</option>
																				<option value="0">Sin lote</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-md-block">Estado Fijación:</label>
																			<select class="form-control" id="cmbEstadoFijacion" name="cmbEstadoFijacion">
																				<option value="">[Todos]</option>
																				<option value="1">Fijado</option>
																				<option value="0">Sin fijar</option>
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
																			<label class="mr-3 mb-0 d-md-block">Cliente:</label>
																			<select class="form-control live-search" id="cmbCliente" name="cmbCliente" data-size="5" data-live-search="true">
																				<option value="">[Seleccionar]</option>
																				<?php foreach ($clientes as $indice => $cliente) { ?>
																					<option value="<?php echo $cliente->CLIEId ?>"><?php echo $cliente->CLIENombre ?></option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-4 my-2 my-md-0">
																		<div class="d-flex align-items-center">
																			<label class="mr-3 mb-0 d-md-block">Estado Forward:</label>
																			<select class="form-control" id="cmbEstadoForward" name="cmbEstadoForward">
																				<option value="">[Todos]</option>
																				<option value="1">Con forward</option>
																				<option value="0">Sin forward</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<!--end::Toolbar-->
														</div>
													</div>
												</form>

												<!--begin::Table-->
												<div class="table-responsive">
													<table id="dt-tbl-lotes" class="table table-separate table-vertical-center">
														<thead>
															<tr>
																<th></th>
																<th>Ref.Interna</th>
																<th>Ref.Cliente</th>
																<th>Cliente</th>
																<th>Broker</th>
																<th>Lote</th>
																<th>Kg/Und</th>
																<th>Cantidad</th>
																<th>Eq.SS.70Kg</th>
																<th>Calidad/Cert/Desc</th>
																<th>Per.Embarque</th>
																<th>Tipo.Precio</th>
																<th>Fix/Dif</th>
																<th>Cto.Cert</th>
																<th>Dif.Neto</th>
																<th>Prec.Fijac</th>
																<th>Fech.Fijac</th>
																<th>Banco</th>
																<th>Modalidad</th>
																<th>Tasa.Spot</th>
																<th>Ptos.Fwd</th>
																<th>Tasa.Final</th>
																<th>Fech.Fut</th>
																<th>Monto.Fwd</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($lotes as $indice => $lote) { ?>
																<tr id="tr<?php echo $lote->DETId; ?>">
																	<td>
																		<div class="dropdown dropdown-inline" data-placement="left">
																			<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				<i class="ki ki-bold-more-hor"></i>
																			</a>
																			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
																				<!--begin::Navigation-->
																				<ul id="menu-lote" class="navi navi-hover py-5">
																					<?php if($lote->DETKilos != "") { // esta opcion es solo para lotes reales NO ad. en bolsa?>
																						<li class="navi-item">
																							<a href="#!" class="navi-link" onclick="VerAside(1, <?php echo $lote->DETId ?>)">
																								<span class="navi-icon">
																									<i class="flaticon2-add"></i>
																								</span>
																								<span class="navi-text">Numeración lote</span>
																							</a>
																						</li>
																					<?php } ?>
																					<li class="navi-item">
																						<a href="#!" class="navi-link" onclick="VerAside(2, <?php echo $lote->DETId ?>)">
																							<span class="navi-icon">
																								<i class="flaticon2-line-chart"></i>
																							</span>
																							<span class="navi-text">Fijación</span>
																						</a>
																					</li>
																					<?php if($lote->DETKilos != "") { // esta opcion es solo para lotes reales NO ad. en bolsa?>
																						<li class="navi-item">
																							<a href="#!" class="navi-link" onclick="VerAside(3, <?php echo $lote->DETId ?>)">
																								<span class="navi-icon">
																									<i class="flaticon2-list"></i>
																								</span>
																								<span class="navi-text">Forward</span>
																							</a>
																						</li>
																					<?php } ?>
																				</ul>
																				<!--end::Navigation-->
																			</div>
																		</div>
																	</td>
																	<td>
																		<span class="text-muted font-weight-bold"><?php echo sprintf("%06d", $lote->CONTId) ?></span>
																	</td>
																	<td>
																		<span class="text-muted font-weight-bold"><?php echo $lote->CONTRefBuyer ?></span>
																	</td>
																	<td>
																		<span class="text-dark-75"><?php echo $lote->CLIENombre ?></span>
																	</td>
																	<td>
																		<span class="text-dark-75"><?php echo $lote->BRONombre ?></span>
																	</td>
																	<td class="text-success font-weight-bolder <?php echo ($lote->DETNroLote == "" ? "" : "table-success") ?>">
																		<?php echo ($lote->DETKilos != "" ? sprintf("%06d", $lote->DETNroLote) : "Bolsa") ?>
																	</td>
																	<td class="text-dark font-weight-bolder"><?php echo $lote->Kilos ?></td>
																	<td class="text-dark font-weight-bolder"><?php echo $lote->DETCantidad ?></td>
																	<td class="text-dark font-weight-bolder"><?php echo $lote->EqKilos70 ?></td>
																	<td><span class="text-dark font-weight-bolder"><?php echo $lote->Calidad ?></span><span class="text-muted font-weight-bold d-block"><?php echo $lote->DETDescEspecial ?></span><span class="text-muted font-weight-bold d-block"><?php echo $lote->Certificacion ?></span></td>
																	<td>
																		<span class="text-dark font-weight-bolder"><?php echo $lote->MesEmbarque . " " . $lote->RangoEmbarque . ", " . $lote->CONTAnioEmbarque ?></span>
																		<span class="text-muted font-weight-bold d-block"><?php echo ($lote->TCONId == 2 ? "" : $lote->Posicion . ", " . $lote->CONTAnioPosicion) ?></span>
																		<span class="text-muted font-weight-bold d-block"><?php echo $lote->PuertoEmbarque ?></span>
																	</td>
																	<td><?php echo $lote->DETTipoPrecio ?></td>
																	<td class="text-dark font-weight-bolder"><?php echo $lote->DETUsdLbs ?></td>
																	<td><?php echo ($lote->Certificacion != $lote->LOTCostoCertificado ? : "") ?></td>
																	<td class="text-success"><?php echo ($lote->DETUsdLbs - $lote->LOTCostoCertificado - ($lote->CONTComisionBroker == "" ? "0" : $lote->CONTComisionBroker)) ?></td>
																	<td class="text-success font-weight-bolder <?php echo ($lote->LOTFechaFijacion == "" ? "" : "table-success") ?>"><?php echo $lote->LOTPrecioFijacion ?></td>
																	<td><?php echo ($lote->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($lote->LOTFechaFijacion))); ?></td>
																	<td><?php echo $lote->Banco ?></td>
																	<td><?php echo $lote->Modalidad ?></td>
																	<td><?php echo number_format($lote->FWDTasaSpot, 0, '.', ',') ?></td>
																	<td><?php echo number_format($lote->FWDPuntos, 0, '.', ',') ?></td>
																	<td><?php echo number_format($lote->FWDTasaFinal, 0, '.', ',') ?></td>
																	<td><?php echo ($lote->FWDFechaFutura == "" ? "" : date("d/m/Y", strtotime($lote->FWDFechaFutura))); ?></td>
																	<td class="text-success font-weight-bolder <?php echo ($lote->FWDFechaFutura == "" ? "" : "table-success") ?>"><?php echo number_format($lote->FWDMonto, 0, '.', ',') ?></td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
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
	<script src="<?php echo $template; ?>js/pages/lotes.js?v=7.2.9"></script>
</body>
</html>