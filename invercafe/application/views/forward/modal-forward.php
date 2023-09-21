<input id="hidBloqueado" type="hidden" value="<?php //echo $bloqueado; ?>">
<div class="card-header border-0 d-flex align-items-center justify-content-between pt-5">
	<h3 class="font-weight-bold m-0">Apertura de Forward</h3>
	<a href="#!" id="kt_tipif_close" class="btn btn-xs btn-icon btn-light btn-hover-primary" onclick="CerrarTipificador(<?php //echo $cita->CITId; ?>)">
		<i class="ki ki-close icon-xs text-muted"></i>
	</a>
</div>
<div class="card-body pt-2">
	<div class="mb-5 scroll scroll-pull">
		<div class="d-flex align-items-center mt-2">
			<div class="symbol symbol-75 symbol-light-warning mr-5">
				<div class="symbol-label font-size-h2 font-weight-bold text-uppercase"><?php //echo $iniciales; ?></div>
				<i class="symbol-badge bg-success"></i>
			</div>
			<div class="d-flex flex-column">
				<a href="#!" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php //echo $cita->CITPaciente; ?></a>
				<div class="navi mt-2">
					<span class="navi-link p-0 pb-2">
						<span class="navi-icon mr-1">
							<i class="text-success fab fa-whatsapp"></i>
						</span>
						<span class="navi-text text-muted">+<?php //echo $cita->CITTelefono; ?></span>
					</span>
				</div>
			</div>
		</div>
		<div class="separator separator-dashed mt-7 mb-7"></div>
		<div class="d-flex align-items-center pb-3">
			<div class="symbol symbol-40 bg-light mr-3">
				<div class="symbol-label">
					<i class="text-danger icon-md far fa-address-card"></i>
				</div>
			</div>
			<div class="navi-text">
				<span class="text-dark-75"><?php //echo $cita->CITCedulaPaciente; ?></span>
			</div>
		</div>
		<div class="d-flex align-items-center pb-3">
			<div class="symbol symbol-40 bg-light mr-3">
				<div class="symbol-label">
					<i class="text-primary icon-md fas fa-map-marker-alt"></i>
				</div>
			</div>
			<div class="navi-text">
				<span class="text-dark-75"><?php //echo $cita->CITSede; ?></span>
				<span class="text-muted"><?php //echo $cita->CITDireccion; ?></span>
			</div>
		</div>
		<div class="d-flex align-items-center pb-3">
			<div class="symbol symbol-40 bg-light mr-3">
				<div class="symbol-label">
					<i class="text-warning icon-md far fa-calendar-alt"></i>
				</div>
			</div>
			<div class="navi-text">
				<span class="text-dark-75"><?php //echo date("d/m/Y", strtotime($cita->CITFechaCita)) . " " . $cita->CITHoraCita; ?></span>
			</div>
		</div>
		<div class="d-flex align-items-center pb-3">
			<div class="symbol symbol-40 bg-light mr-3">
				<div class="symbol-label">
					<i class="text-info icon-md fas fa-user-md"></i>
				</div>
			</div>
			<div class="navi-text">
				<span class="text-dark-75"><?php //echo $cita->CITMedico; ?></span>
			</div>
		</div>
		<div class="d-flex align-items-center">
			<div class="symbol symbol-40 bg-light mr-3">
				<div class="symbol-label">
					<i class="text-success icon-md fas fa-briefcase-medical"></i>
				</div>
			</div>
			<div class="navi-text">
				<span class="text-dark-75"><?php //echo $cita->CITEspecialidad; ?></span>
			</div>
		</div>

		<div class="separator separator-dashed mt-7 mb-7"></div>
		<h5>Gestionar</h5>
		<span class="label label-light-<?php //echo $cita->ColorEstado; ?> label-inline"><i class="fa fa-genderless text-<?php //echo $cita->ColorEstado; ?>"></i>&nbsp;<?php //echo $cita->DescEstado; ?></span>
		<span class="label label-light-<?php //echo $cita->ColorEstadoWapp; ?> label-inline"><i class="<?php //echo $cita->ESTWIcon . ($cita->ColorEstadoWapp == "" ? "" : " text-" . $cita->ColorEstadoWapp); ?>"></i>&nbsp;<?php //echo $cita->DescEstadoWapp; ?></span>
		<?php //if($cita->Name != ""){ ?>
			<span class="label label-primary label-inline"><i class="la la-user text-white"></i>&nbsp;<?php //echo $cita->Name; ?></span>
		<?php //} ?>			
		<div class="navi navi-spacer-x-0 p-0 mt-5">
			<form id="frmTipi" class="form" novalidate="novalidate" data-view="reportes">
				<input id="hidCitaId" name="hidCitaId" type="hidden" value="<?php //echo $cita->CITId; ?>">
				<div class="form-group">
					<label>Asignar Estado</label>
					<select class="form-control form-control-solid" id="cmbTipificacion" name="cmbTipificacion" onchange="GetSubtipificacion(this.value)">
						<?php //foreach ($estados_tip as $indice => $estado) { ?>
							<option value="<?php //echo $estado->ESTEstado ?>" <?php //echo ($estado->ESTEstado == $cita->CITEstado ? "selected" : "") ?>><?php //echo $estado->ESTDescripcion ?></option>
						<?php //} ?>
					</select>
				</div>
				<div class="form-group">
					<label>Estado en sistema de agendamiento</label>
					<select class="form-control form-control-solid" id="cmbAgendamiento" name="cmbAgendamiento" required>
						<option value="">[Seleccionar]</option>
						<?php //foreach ($estados_subtip as $indice => $estado) { ?>
							<option value="<?php //echo $estado->SUBTId ?>" <?php //echo ($estado->SUBTId == $cita->SUBTId ? "selected" : "") ?>><?php //echo $estado->SUBTDescripcion ?></option>
						<?php //} ?>
					</select>
				</div>
				<div class="form-group">
					<label>Obervación</label>
					<textarea id="txtObervacion" name="txtObervacion" class="form-control form-control-solid" rows="3" placeholder="Obervación" required><?php //echo $cita->TIPObservacion; ?></textarea>
				</div>
				<button id="kt_tipif_guardar" type="button" class="btn btn-primary font-weight-bold" onclick="TipificarCita()">Tipificar</button>
			</form>
		</div>
	</div>
</div>