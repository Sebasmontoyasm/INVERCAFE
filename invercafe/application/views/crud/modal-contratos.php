<!-- Modal-->
<div class="modal-content">
	<div class="modal-header">
		<span class="nav-icon">
			<span class="svg-icon svg-icon-xl svg-icon-primary">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"></polygon>
						<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
						<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
					</g>
				</svg><!--end::Svg Icon-->
			</span>
		</span>
		<h5 class="modal-title" id="exampleModalLabel"><?php echo (isset($contrato->CONTId) ? "Modificar" : "Crear") ?> Contrato <?php echo (isset($contrato->CONTId) ? "# " . sprintf("%06d", $contrato->CONTId) : "") ?></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label class="form-text text-success">Adiciona o modifica contratos a través del siguiente formulario</label>
			<input id="hidIdContrato" name="hidIdContrato" type="hidden" class="form-control" value="<?php echo (isset($contrato->CONTId) ? $contrato->CONTId : "") ?>">
			<input id="hidIdEstado" name="hidIdEstado" type="hidden" class="form-control" value="<?php echo (isset($contrato->CONTEstado) ? $contrato->CONTEstado : 1) ?>">
		</div>
		<div id="divEncabezado">
			<div id="divEncabezado" class="row">
				<!--div class="col-lg-3">
					<div class="form-group">
						<label>Referencia Cliente</label>
						<input id="txtRefBuyer" name="txtRefBuyer" type="text" class="form-control" autocomplete="off" placeholder="Referencia Cliente" value="<?php echo (isset($contrato->CONTRefBuyer) ? $contrato->CONTRefBuyer : "") ?>">
					</div>
				</div-->
				<div class="col-lg-4">
					<div class="form-group">
						<label>Cliente</label><small class="text-danger"> (*)</small>
						<select class="form-control live-search" id="cmbCliente" name="cmbCliente" data-size="5" data-live-search="true" required>
							<option value="">[Seleccionar]</option>
							<?php foreach ($clientes as $indice => $cliente) { ?>
								<option value="<?php echo $cliente->CLIEId ?>" <?php echo (isset($contrato->CLIEId) ? ($cliente->CLIEId == $contrato->CLIEId ? "selected" : "") : "") ?>><?php echo $cliente->CLIENombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4">
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
				<div class="col-lg-4">
					<div class="form-group">
						<label>Modalidad</label>
						<select class="form-control" id="cmbTipoContrato" name="cmbTipoContrato" >
							<option value="">[Seleccionar]</option>
							<?php foreach ($tiposcontrato as $indice => $tipcontrato) { ?>
								<option value="<?php echo $tipcontrato->TCONId ?>" <?php echo (isset($contrato->TCONId) ? ($tipcontrato->TCONId == $contrato->TCONId ? "selected" : "") : "") ?>><?php echo $tipcontrato->TCONNombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-2">
					<div class="form-group">
						<label>Año emb.</label><small class="text-danger"> (*)</small>
						<select class="form-control" id="cmbAnioEmbarque" name="cmbAnioEmbarque" required>
							<option value="">[Año]</option>
							<?php foreach ($anios as $indice => $anio) { ?>
								<option value="<?php echo $anio->descripcion ?>" <?php echo (isset($contrato->CONTAnioEmbarque) ? ($anio->descripcion == $contrato->CONTAnioEmbarque ? "selected" : "") : "") ?>><?php echo $anio->descripcion ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label>Mes emb.</label><small class="text-danger"> (*)</small>
						<select class="form-control" id="cmbMesEmbarque" name="cmbMesEmbarque" required>
							<option value="">[Mes]</option>
							<?php foreach ($meses as $indice => $mes) { ?>
								<option value="<?php echo $mes->OPCId ?>" data-posicion="<?php echo $mes->OPCHijo ?>" <?php echo (isset($contrato->CONTMesEmbarque) ? ($mes->OPCId == $contrato->CONTMesEmbarque ? "selected" : "") : "") ?>><?php echo $mes->OPCNombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label>Rango</label><small class="text-danger"> (*)</small>
						<select class="form-control" id="cmbRangoEmbarque" name="cmbRangoEmbarque" required>
							<option value="">[Rango]</option>
							<?php foreach ($rangos as $indice => $rango) { ?>
								<option value="<?php echo $rango->OPCId ?>" <?php echo (isset($contrato->CONTRangoEmbarque) ? ($rango->OPCId == $contrato->CONTRangoEmbarque ? "selected" : "") : "") ?>><?php echo $rango->OPCNombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 ocultar-especial">
					<div class="form-group">
						<label>Mes fijación</label><small class="text-danger"> (*)</small>
						<select class="form-control" id="cmbMesPosicion" name="cmbMesPosicion" >
							<option value="">[Seleccionar]</option>
							<?php foreach ($posiciones as $indice => $posicion) { ?>
								<option value="<?php echo $posicion->OPCId ?>" <?php echo (isset($contrato->CONTPosicion) ? ($posicion->OPCId == $contrato->CONTPosicion ? "selected" : "") : "") ?>><?php echo $posicion->OPCNombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2 ocultar-especial">
					<div class="form-group">
						<label>Año fijación</label><small class="text-danger"> (*)</small>
						<select class="form-control" id="cmbAnioPosicion" name="cmbAnioPosicion" >
							<option value="">[Año]</option>
							<?php foreach ($anios as $indice => $anio) { ?>
								<option value="<?php echo $anio->descripcion ?>" <?php echo (isset($contrato->CONTAnioPosicion) ? ($anio->descripcion == $contrato->CONTAnioPosicion ? "selected" : "") : "") ?>><?php echo $anio->descripcion ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label>Puerto Embarque</label><small class="text-danger"> (*)</small>
						<select class="form-control no-clean" id="cmbPuerto" name="cmbPuerto" >
							<option value="">[Puerto]</option>
							<?php foreach ($puertos as $indice => $puerto) { ?>
								<option value="<?php echo $puerto->OPCId ?>" <?php echo (isset($contrato->CONTPuertoEmbarque) ? ($puerto->OPCId == $contrato->CONTPuertoEmbarque ? "selected" : "") : "") ?>><?php echo $puerto->OPCNombre ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mb-4">
					<div class="d-flex align-items-center flex-wrap mr-2">
						<!--begin::Page Title-->
						<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Detalle de la venta</h5>
						<!--end::Page Title-->
						<!--begin::Actions-->
					</div>
				</div>
				<div id="divDetalleVenta" class="card card-custom card-fit card-border p-5 mb-4 detalle-venta" style="display: none">
					<input id="hidIndice" name="hidIndice" type="hidden">
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Cantidad Unidades</label><small class="text-danger"> (*)</small>
								<input id="txtCantidadUnid" name="txtCantidadUnid" class="form-control form-control-sm calcular-lotes-fijar mask" data-mask="Nro" placeholder="Cantidad de Unidades" value="<?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $contrato->CONTotalUnidades : "275") : "275") ?>" required>
							</div>
						</div>
						<div class="col-lg-2 ocultar-especial ocultar-mixto">
							<div class="form-group">
								<label>Unidades X Lote</label><small class="text-danger"> (*)</small>
								<input id="txtUnidadesLote" name="txtUnidadesLote" class="form-control form-control-sm calcular-lotes-fijar mask" data-mask="Nro" placeholder="Unidades por lote" value="<?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $detalleVenta[0]->DETCantidad : "275") : "275") ?>" required>
							</div>
						</div>
						<div class="col-lg-2 ocultar-mixto ocultar-especial">
							<div class="form-group">
								<label>Nr Lotes a Embarcar</label>
								<input id="txtLostesFijar" name="txtLostesFijar" class="form-control form-control-sm" disabled placeholder="Nro. Lotes a Fijar" value="<?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $contrato->CONTLotesEmbarque : "1") : "1") ?>">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Kg X Unidad</label><small class="text-danger"> (*)</small>
								<select class="form-control form-control-sm" id="cmbKilosUnidad" name="cmbKilosUnidad" required>
									<?php foreach ($unidades as $indice => $unidad) { ?>
										<option value="<?php echo $unidad->OPCId ?>" data-requerimiento="<?php echo $unidad->OPCHijo ?>" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($unidad->OPCId == $detalleVenta[0]->DETKilos ? "selected" : "") : "") : "") ?>><?php echo $unidad->OPCNombre ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Requer. Empaque</label>
								<select class="form-control form-control-sm" id="cmbRequerimiento" name="cmbRequerimiento">
									<option value="">[Seleccionar]</option>
									<?php foreach ($requerimientos as $indice => $requerimiento) { ?>
										<option value="<?php echo $requerimiento->OPCId ?>" <?php echo ($requerimiento->OPCId != 66 ? "disabled" : "") ?> <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($requerimiento->OPCId == $detalleVenta[0]->DETRequerimientos ? "selected" : "") : "") : "") ?>><?php echo $requerimiento->OPCNombre ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Calidad</label><small class="text-danger"></small>
								<select class="form-control form-control-sm" id="cmbCalidad" name="cmbCalidad">
									<option value="">[Seleccionar]</option>
									<?php foreach ($calidades as $indice => $calidad) { ?>
										<option value="<?php echo $calidad->OPCId ?>" data-requerimiento="<?php echo $calidad->OPCHijo ?>" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($calidad->OPCId == $detalleVenta[0]->DETCalidad ? "selected" : "") : "") : "") ?>><?php echo $calidad->OPCNombre ?></option>
									<?php } ?>
								</select>
							</div>	
						</div>
						<div class="col-lg-2 ocultar-convencional ocultar-mixto">
							<div class="form-group">
								<label>Descripción lote especial</label>
								<input id="txtDescEspecial" name="txtDescEspecial" class="form-control form-control-sm" placeholder="Descripción lote especial">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Certificación</label>
								<select class="form-control form-control-sm" id="cmbCertificacion" name="cmbCertificacion">
									<option value="">[Seleccionar]</option>
									<?php foreach ($certificaciones as $indice => $certificacion) { ?>
										<option value="<?php echo $certificacion->OPCId ?>" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($certificacion->OPCId == $detalleVenta[0]->DETCertificacion ? "selected" : "") : ""): "") ?>><?php echo $certificacion->OPCNombre ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Asociación</label>
								<select class="form-control form-control-sm" id="cmbAsociacion" name="cmbAsociacion">
									<option value="">[Seleccionar]</option>
									<?php foreach ($asociaciones as $indice => $asociacion) { ?>
										<option value="<?php echo $asociacion->OPCId ?>" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($asociacion->OPCId == $detalleVenta[0]->DETAsociacion ? "selected" : "") : "") : "") ?>><?php echo $asociacion->OPCNombre ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Tipo de precio</label><small class="text-danger"> (*)</small>
								<select class="form-control form-control-sm" id="cmbTipoPrecio" name="cmbTipoPrecio" required>
									<option value="">[Seleccionar]</option>
									<option value="Dif" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($detalleVenta[0]->DETTipoPrecio == "Dif" ? "selected" : "") : "") : "") ?>>Dif</option>
									<option value="Fixed" <?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? ($detalleVenta[0]->DETTipoPrecio == "Fixed" ? "selected" : "") : "") : "") ?>>Fixed</option>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Dif/Fxprice USCts/Lb</label><small class="text-danger"> (*)</small>
								<input id="txtCentLbs" name="txtCentLbs" class="form-control form-control-sm mask" data-mask="$" placeholder="USD Cents/Lb" value="<?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $detalleVenta[0]->DETUsdLbs : "") : "") ?>" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 ocultar-especial ocultar-mixto">
							<div class="form-group">
								<label>Lotes adicionales en bolsa</label>
								<input id="txtLotesAdicionales" name="txtLotesAdicionales" class="form-control form-control-sm mask" data-mask="Nro" placeholder="Lotes adicionales en bolsa" value="<?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $contrato->CONTLotesBolsa : "0") : "0") ?>">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Observaciones</label>
								<textarea id="txtObervaciones" name="txtObervaciones" class="form-control form-control-sm" rows="3" placeholder="Observaciones"><?php echo (isset($contrato->TCONId) ? ($contrato->TCONId == 1 ? $detalleVenta[0]->DETObservaciones : "") : "") ?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<a href="#" id="btn-detalle-venta" class="btn btn-light-warning btn-sm" >
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
								<span class="font-size-base mr-2">Adicionar</span>
							</a>
						</div>
					</div>
				</div>
				<!--begin::Table-->
				<div class="table-responsive detalle-venta" style="display: none">
					<table id="table-detalle-venta" class="table table-head-custom table-head-bg table-borderless table-vertical-center">
						<thead>
							<tr>
								<th>#</th>
								<th>Cantidad</th>
								<th>Kilos.Unid</th>
								<th>Eq.Kg</th>
								<th>Calidad/Cert/Desc</th>
								<th>Dif/Fx USD Cents/Lb</th>
								<th>Req.Adic</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php if(isset($contrato->TCONId)) {
							if($contrato->TCONId <> 1) {
							foreach ($detalleVenta as $indice => $item) { ?>
							<tr>
								<td class="text-muted font-weight-bolder"><?php echo ($indice+1) ?></td>
								<td class="text-dark font-weight-bolder"><?php echo $item->Cantidad ?></td>
								<td class="text-dark font-weight-bolder"><?php echo $item->Kilos ?></td>
								<td class="text-dark font-weight-bolder"><?php echo $item->EqKilos ?></td>
								<td><span class="text-dark font-weight-bolder"><?php echo $item->Calidad ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->DETDescEspecial ?></span><span class="text-muted font-weight-bold d-block"><?php echo $item->Certificacion ?></span></td>
								<td class="text-dark font-weight-bolder"><?php echo $item->UsdLbs ?></td>
								<td class="text-dark font-weight-bolder"><?php echo $item->Requerimientos ?></td>
								<td>
									<a href="#!" class="btn btn-icon btn-light-primary btn-hover-primary btn-sm btn-modal-prog" onclick="ModificarDetalleVenta(<?php echo $indice ?>)">
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
												<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											</g>
											</svg>
										</span>
									</a>
									<a href="#!" class="btn btn-icon btn-light-danger btn-hover-danger btn-sm btn-modal-prog" onclick="EliminarDetalleVenta(this, <?php echo $indice ?>)">
										<span class="svg-icon svg-icon-md svg-icon-danger">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"/>
											<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
											<path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
											</g>
											</svg>
										</span>
									</a>
								</td>

							</tr>						
						<?php } } } ?>
						</tbody>
					</table>
				</div>
				<!--end::Table-->
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button id="btn-guardar-contrato" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
	</div>
</div>
<script src="<?php echo $template; ?>js/pages/contratos.js?v=7.2.9"></script>
<script>
	var tblDetalleVenta = [];
<?php 
if (count($detalleVenta) > 0) {
	foreach ($detalleVenta as $indice => $item) { ?>
		tblDetalleVenta.push({
			"id": "<?php echo $item->DETId ?>",
			"unidades": "<?php echo $item->DETCantidad ?>",
			"kilos": {
				"id": "<?php echo $item->DETKilos ?>",
				"desc": "<?php echo $item->Kilos ?>"
			},
			"calidad": {
				"id": "<?php echo $item->DETCalidad ?>",
				"desc": "<?php echo $item->Calidad ?>"
			},
			"descEspecial": "<?php echo $item->DETDescEspecial ?>",
			"asociacion": {
				"id": "<?php echo $item->DETAsociacion ?>",
				"desc": "<?php echo $item->Asociacion ?>"
			},
			"certificacion": {
				"id": "<?php echo $item->DETCertificacion ?>",
				"desc": "<?php echo $item->Certificacion ?>"
			},
			"centLbs": "<?php echo $item->DETUsdLbs ?>",
			"tipoPrecio": "<?php echo $item->DETTipoPrecio ?>",
			"requerimientos": {
				"id": "<?php echo $item->DETRequerimientos ?>",
				"desc": "<?php echo $item->Requerimientos ?>"
			},
			"observaciones": "<?php echo $item->DETObservaciones ?>",
			"accion": "select",
		});
<?php } } ?>	
</script>