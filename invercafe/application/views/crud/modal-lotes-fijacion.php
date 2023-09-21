<div class="card-header border-0 d-flex align-items-center justify-content-between pt-5">
	<h3 class="font-weight-bold m-0">Fijación de precio</h3>
	<a href="#!" id="kt_tipif_close" class="btn btn-xs btn-icon btn-light btn-hover-primary" onclick="CerrarAside(<?php echo $lote->DETId ?>)">
		<i class="ki ki-close icon-xs text-muted"></i>
	</a>
</div>
<div class="card-body pt-2">
	<div class="mb-5 scroll scroll-pull">
		<!--begin::Nav-->
		<form id="frmMdl" class="form" novalidate="novalidate" data-view="lotes" data-context="lotes">
			<div class="navi navi-spacer-x-0 p-0 mt-8 mb-5">
				<div class="form-group">
					<label>Comisión del broker</label>
					<span id="span-comision-broker" class="form-control form-control-solid"><?php echo ($comisionBroker == "" ? "0" : $comisionBroker) ?></span>
				</div>
				<div class="form-group">
					<label>Precio (Fix/Dif)</label>
					<span id="span-precio-fix" class="form-control form-control-solid"><?php echo $lote->DETUsdLbs ?></span>
				</div>
				<div class="form-group">
					<label>Costo del certificado</label>
					<input id="txtCtoCertificado" name="txtCtoCertificado" class="form-control mask" data-mascara="$" placeholder="Costo certificado" value="<?php echo $lote->LOTCostoCertificado ?>" onchange="CalcularDiferencial(this)">
				</div>
				<div class="form-group">
					<label>Diferencial neto</label>
					<span id="span-dif-neto" class="form-control form-control-solid"><?php echo ($lote->DETUsdLbs - $lote->LOTCostoCertificado - ($comisionBroker == "" ? "0" : $comisionBroker)) ?></span>
				</div>
				<div class="form-group">
					<label>Precio fijación</label>
					<input id="txtPrecioFijacion" name="txtPrecioFijacion" class="form-control mask" data-mascara="$" placeholder="Precio fijación" value="<?php echo $lote->LOTPrecioFijacion ?>">
				</div>
				<div class="form-group">
					<label>Fecha fijación</label><br>
					<a href="#!" class="btn btn-block btn-light font-weight-bold mr-2 select-dtpicker">
						<input id="hidFechaProg" name="hidFechaProg" type="hidden" class="form-control" value="<?php echo $lote->LOTFechaFijacion ?>">
						<span class="text-muted font-size-base font-weight-bold mr-2"><?php echo ($lote->LOTFechaFijacion == "" ? "Seleccionar" : "") ?></span>
						<span class="text-primary font-size-base font-weight-bolder"><?php echo ($lote->LOTFechaFijacion == "" ? "" : date("d/m/Y", strtotime($lote->LOTFechaFijacion))); ?></span>
					</a>
				</div>
				<button type="button" class="btn btn-primary font-weight-bold" onclick="FijarPrecio(this, <?php echo $lote->DETId ?>)">Fijar precio</button>
			</div>
		</form>
		<!--end::Nav-->
	</div>
</div>
<script src="<?php echo $template; ?>js/pages/modal-lotes.js?v=7.2.9"></script>
