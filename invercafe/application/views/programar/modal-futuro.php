<!-- Modal-->
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Programar cargues futuros</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label class="form-text text-success">Recuerda que solo podrás adelantar cargue futuro de máximo dos semanas</label>
			<input id="hidIdProg" name="hidIdProg" type="hidden" class="form-control" value="<?php echo ($prog ? $prog->PRGId : "") ?>">
			<input id="hidIntervalo" name="hidIntervalo" type="hidden" class="form-control" value="<?php echo $intervalo ?>">
			<a href="#!" class="btn btn-light font-weight-bold mr-2" id="kt_programar_daterangepicker">
				<input id="hidFechaIni" name="hidFechaIni" type="hidden" class="form-control" value="<?php echo ($prog ? $prog->PRGFechaIni : ""); ?>">
				<input id="hidFechaFin" name="hidFechaFin" type="hidden" class="form-control" value="<?php echo ($prog ? $prog->PRGFechaFin : ""); ?>">
				<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_programar_daterangepicker_title">Fecha</span>
				<span class="text-primary font-size-base font-weight-bolder" id="kt_programar_daterangepicker_date"><?php echo ($prog ? str_replace('.', '', strftime("%b %d", strtotime($prog->PRGFechaIni))) : ""); ?></span>
			</a>
		</div>
	</div>
	<div class="modal-footer">
		<button id="btn-guardar-prog" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
	</div>
</div>
