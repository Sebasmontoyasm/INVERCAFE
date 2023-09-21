<div class="card-header border-0 d-flex align-items-center justify-content-between pt-5">
	<h3 class="font-weight-bold m-0">Seguimiento forward</h3>
	<a href="#!" id="kt_tipif_close" class="btn btn-xs btn-icon btn-light btn-hover-primary" onclick="CerrarAside(<?php echo $lote->DETId ?>)">
		<i class="ki ki-close icon-xs text-muted"></i>
	</a>
</div>
<div class="card-body pt-2">
	<div class="mb-5 scroll scroll-pull">
		<!--begin::Nav-->
		<form id="frmMdl" class="form" novalidate="novalidate" data-view="lotes" data-context="lotes">
			<div id="divForward" class="navi navi-spacer-x-0 p-0 mt-8 mb-5">
				<div class="form-group">
					<label>Banco</label>
					<select id="cmbBanco" name="cmbBanco" class="form-control" required>
						<option value="">[Seleccionar]</option>
						<?php foreach ($bancos as $indice => $banco) { ?>
							<option value="<?php echo $banco->OPCId ?>" <?php echo ($banco->OPCId == $lote->FWDBanco ? "selected" : "") ?>><?php echo $banco->OPCNombre ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Modalidad</label>
					<select id="cmbTipoForward" name="cmbTipoForward" class="form-control" required>
						<option value="">[Seleccionar]</option>
						<?php foreach ($tipoForward as $indice => $tipoFwd) { ?>
							<option value="<?php echo $tipoFwd->OPCId ?>" <?php echo ($tipoFwd->OPCId == $lote->FWDModalidad ? "selected" : "") ?>><?php echo $tipoFwd->OPCNombre ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Tasa SPOT</label>
					<input id="txtTasaSpot" name="txtTasaSpot" class="form-control mask" data-mascara="$" placeholder="Tasa SPOT" value="<?php echo number_format($lote->FWDTasaSpot, 2, '.', ',') ?>" required>
				</div>
				<div class="form-group">
					<label>Puntos forward</label>
					<input id="txtPuntosFwd" name="txtPuntosFwd" class="form-control mask" data-mascara="$" placeholder="Puntos forward" value="<?php echo number_format($lote->FWDPuntos, 2, '.', ',') ?>" required>
				</div>
				<div class="form-group">
					<label>Tasa final</label>
					<input id="txtTasaFinal" name="txtTasaFinal" class="form-control mask" data-mascara="$" placeholder="Tasa final" value="<?php echo number_format($lote->FWDTasaFinal, 2, '.', ',') ?>" required>
				</div>
				<div class="form-group">
					<label>Fecha futura</label><br>
					<a href="#!" class="btn btn-block btn-light font-weight-bold mr-2 select-dtpicker">
						<input id="hidFechaFutura" name="hidFechaFutura" type="hidden" class="form-control" data-required="1" value="<?php echo $lote->FWDFechaFutura ?>">
						<span class="text-muted font-size-base font-weight-bold mr-2"><?php echo ($lote->FWDFechaFutura == "" ? "Seleccionar" : ""); ?></span>
						<span class="text-primary font-size-base font-weight-bolder"><?php echo ($lote->FWDFechaFutura == "" ? "" : date("d/m/Y", strtotime($lote->FWDFechaFutura))); ?></span>
					</a>
				</div>
				<div class="form-group">
					<label>Monto USD</label>
					<input id="txtMontoFwd" name="txtMontoFwd" class="form-control mask" data-mascara="$" placeholder="Monto USD" value="<?php echo number_format($lote->FWDMonto, 2, '.', ','); ?>" required>
				</div>
				<button type="button" class="btn btn-primary font-weight-bold" onclick="ActualizarForward(this, <?php echo $lote->DETId ?>)">Actualizar forward</button>
			</div>
		</form>
		<!--end::Nav-->
	</div>
</div>
<script src="<?php echo $template; ?>js/pages/modal-lotes.js?v=7.2.9"></script>
