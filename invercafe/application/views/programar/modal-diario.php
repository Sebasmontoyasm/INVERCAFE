<!-- Modal-->
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Programar una agenda</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label class="form-text text-success">Recuerda que solo podrás adelantar programacion de una semana</label>
			<input id="hidIdProg" name="hidIdProg" type="hidden" class="form-control" value="<?php echo ($prog ? $prog->PRGId : "") ?>">
			<input id="hidIntervalo" name="hidIntervalo" type="hidden" class="form-control" value="<?php echo $intervalo ?>">
			<a href="#!" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_programar_dtpicker">
				<input id="hidFechaProg" name="hidFechaProg" type="hidden" class="form-control" value="<?php echo ($prog ? $prog->PRGFecha : "") ?>">
				<!--input id="hidCargaTp" name="hidCargaTp" type="hidden" class="form-control" value="1"-->
				<span class="text-muted font-size-base font-weight-bold mr-2" id="kt_programar_datepicker_title">Indicar día</span>
				<span class="text-primary font-size-base font-weight-bolder" id="kt_programar_datepicker_date"><?php echo ($prog ? str_replace('.', '', strftime("%b %d", strtotime($prog->PRGFecha))) : ""); ?></span>
			</a>
		</div>
		<div class="form-group">
			<label>Consultorios</label>
			<div class="checkbox-inline">
				<?php for($i=1;$i<=25;$i++) {?>
					<label class="checkbox">
						<input type="checkbox" name="consultorio[]" class="inpup-sm" value="<?php echo $i; ?>" <?php echo (in_array(strval($i), $consultorios, true) ? " checked" : ""); ?>/>
						<span></span><?php echo sprintf("%02d", $i) ?>
					</label>
				<?php } ?>
			</div>
			<span class="form-text text-success">Por favor indica cuáles de los siguientes consultorios están disponibles para el día que acabas de escoger</span>
		</div>
	</div>
	<div class="modal-footer">
		<button id="btn-guardar-prog" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
	</div>
</div>
