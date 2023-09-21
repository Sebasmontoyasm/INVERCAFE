<div class="card-header border-0 d-flex align-items-center justify-content-between pt-5">
	<h3 class="font-weight-bold m-0">Numeración de lote</h3>
	<a href="#!" id="kt_tipif_close" class="btn btn-xs btn-icon btn-light btn-hover-primary" onclick="CerrarAside(<?php echo $lote->DETId ?>)">
		<i class="ki ki-close icon-xs text-muted"></i>
	</a>
</div>
<div class="card-body pt-2">
	<div class="mb-5 scroll scroll-pull">
		<!--begin::Nav-->
		<div class="navi navi-spacer-x-0 p-0 mt-8 mb-5">
			<!--begin::Item-->
			<?php if($lote->DETNroLote == "") { // esta opcion es solo para lotes reales NO ad. en bolsa?>
				<a href="#!" class="navi-item" onclick="GenerarLote(this, <?php echo $lote->DETId ?>)">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-primary">
									<i class="flaticon2-add text-primary"></i>
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">Generar número lote</div>
							<div class="text-muted">Asignar nuevo consecutivo
							<span class="label label-light-primary label-inline font-weight-bold">Actualizar</span></div>
						</div>
					</div>
				</a>
				<!--end::Item-->
			<?php } else { ?>
				<!--begin::Item-->
				<a href="#!" class="navi-item" onclick="LiberarLote(this, <?php echo $lote->DETId ?>)">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-danger">
									<i class="flaticon-delete text-danger"></i>
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">Liberar número lote <strong class="text-danger"><?php echo sprintf("%06d", $lote->DETNroLote) ?></strong></div>
							<div class="text-muted">Eliminar consecutivo actual
							<span class="label label-light-danger label-inline font-weight-bold">Eliminar</span></div>
						</div>
					</div>
				</a>
				<!--end::Item-->
				<!--begin::Item-->
				<div class="navi-item">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-warning">
									<i class="flaticon2-edit text-warning"></i>
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">Modificar número lote</div>
							<div class="text-muted">Modificar consecutivo actual</div>
							<div class="mb-3 mt-3">
								<input name="txtNewLot" class="txtNewLot form-control form-control-sm col-sm-10 mask" data-mascara="Nro" value="<?php echo $lote->DETNroLote ?>">
							</div>
							<button type="button" class="btn btn-light-warning btn-sm" onclick="ModificarLote(this, <?php echo $lote->DETId ?>)">Modificar</button>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<!--end::Nav-->
	</div>
</div>
<script src="<?php echo $template; ?>js/pages/modal-lotes.js?v=7.2.9"></script>
