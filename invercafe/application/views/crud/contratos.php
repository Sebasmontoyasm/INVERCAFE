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
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Administrar Contratos</h5>
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
												<span class="card-label font-weight-bolder text-dark">Listado de Contratos</span>
												<span class="text-muted mt-3 font-weight-bold font-size-sm">Se encontraron <?php echo count($contratos); ?> contratos disponibles</span>
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
											<table id="tbl-usuarios" class="table table-head-custom table-head-bg table-borderless table-vertical-center table-responsive">
												<thead>
													<tr>
														<th>Ref.Interna</th>
														<th>Ref.Cliente</th>
														<th>Modalidad</th>
														<th>Cliente</th>
														<th>Broker</th>
														<th>Per.Embarque</th>
														<th>Cant.Unidades</th>
														<th>Eq.Kg.</th>
														<th>Lotes embarcar</th>
														<th>Lotes fijar</th>
														<th>Fecha creación</th>
														<!--th>Estado</th-->
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($contratos as $indice => $contrato) { ?>
														<tr>
															<td>
																<span class="text-muted font-weight-bold"><?php echo sprintf("%06d", $contrato->CONTId) ?></span>
															</td>
															<td>
																<span class="text-muted font-weight-bold"><?php echo $contrato->CONTRefBuyer ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->Modalidad ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->CLIENombre ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->BRONombre ?></span>
															</td>
															<td>
																<span class="text-dark font-weight-bolder"><?php echo $contrato->MesEmbarque . " " . $contrato->RangoEmbarque . ", " . $contrato->CONTAnioEmbarque ?></span>
																<span class="text-muted font-weight-bold d-block"><?php echo ($contrato->TCONId == 2 ? "" : $contrato->Posicion . ", " . $contrato->CONTAnioPosicion) ?></span>
																<span class="text-muted font-weight-bold d-block"><?php echo $contrato->PuertoEmbarque ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->CantUnidades ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->EQKilos ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->CantLotesEmbarcar ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo $contrato->CantLotesFijar ?></span>
															</td>
															<td>
																<span class="text-dark-75"><?php echo date("d/m/Y", strtotime($contrato->createdAt)); ?></span>
															</td>
															<!--td class="text-center">
																<span class="switch switch-sm">
																	<label>
																		<input type="checkbox" <?php echo ($contrato->CONTEstado == 1 ? "checked" : ""); ?> onclick="actualizarEstadoContrato(<?php echo $contrato->CONTId . ", " . ($contrato->CONTEstado == 1 ? 0 : 1) ?>)"/>
																		<span></span>
																	</label>
																</span>
															</td-->
															<td class="pr-0 text-right">
																<a href="#!" class="btn btn-icon btn-light btn-hover-primary btn-sm btn-modal-prog" onclick="VerModal('<?php echo $contrato->CONTId ?>')">
																	<span class="svg-icon svg-icon-md svg-icon-primary">
																		<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<polygon points="0 0 24 0 24 24 0 24"></polygon>
																				<path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>
																				<rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</a>
																<a href="#!" class="btn btn-icon btn-light btn-hover-success btn-sm" onclick="VerComex('<?php echo $contrato->CONTId ?>')">
																	<span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Home/Globe.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24"/>
																				<path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>
																				<circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>
																			</g>
																		</svg><!--end::Svg Icon-->
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
					<!-- Modal 1-->
					<div id="mdlGestion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
						<form id="frmProg" class="form" novalidate="novalidate" data-view="contratos" data-context="contratos">
							<input id="idLote" name="idLote" type="hidden" class="form-control">
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