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
				</svg>
			</span>
		</span>
		<h5 class="modal-title" id="modal-brokers">Gestionar broker</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label class="form-text text-success">Adiciona o modifica brokers en el siguiente formulario</label>
			<input id="hidIdBroker" name="hidIdBroker" type="hidden" class="form-control" value="<?php echo (isset($broker->BROId) ? $broker->BROId : "") ?>">
		</div>
		<div class="form-group">
			<label>Nombre completo</label>
			<input id="txtNames" name="txtNames" type="text" class="form-control form-control-solid" value="<?php echo (isset($broker->BRONombre) ? $broker->BRONombre : "") ?>" placeholder="Nombre completo" required />
		<div class="form-group">
			<label>País </label>
			<select class="form-control live-search" id="cmbPaises" name="cmbPaises" data-size="5" data-live-search="true" required>
				<option value="">[Seleccionar]</option>
				<?php foreach ($countries as $indice => $country) { ?>
					<option value="<?php echo $country->PAISId ?>" <?php echo (isset($broker->PAISId) ? ($country->PAISId == $broker->PAISId ? "selected" : "") : "") ?>><?php echo $country->country_name ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Ciudad</label>
			<input id="txtCiudad" name="txtCiudad" type="text" class="form-control form-control-solid" placeholder="Ciudad" pattern="[a-zA-Z]+{3}" 
				value="<?php echo (isset($broker->BROCiudad) ? $broker->BROCiudad : "") ?>"
			/>
		</div>
		<div class="form-group">
			<label>Contacto</label>
			<input id="txtContacto" name="txtContacto" type="text" class="form-control form-control-solid" placeholder="Contacto"
				value="<?php echo (isset($broker->BROContacto) ? $broker->BROContacto : "") ?>" 
			/>
		</div>
		<div class="form-group">
			<label>Telefono</label>
			<input id="txttelefono" name="txttelefono" type="number" class="form-control form-control-solid" placeholder="Telefono" pattern="[0-9]{8,9}" 
				value="<?php echo (isset($broker->BROTelefono) ? $broker->BROTelefono : "") ?>"
			/>
		</div>
		<div class="form-group">
			<label>Correo electrónico</label>
			<input id="txtEmail" name="txtEmail" type="email" class="form-control form-control-solid" value="<?php echo (isset($broker->BROEmail) ? $broker->BROEmail : "") ?>" placeholder="Correo electrónico" required />
		</div>
		<div class="form-group">
			<label>Dirección</label>
			<input id="txtDireccion" name="txtDireccion" type="text" class="form-control form-control-solid" placeholder="Dirección"
				value="<?php echo (isset($broker->BRODireccion) ? $broker->BRODireccion : "") ?>"
			/>
		</div>
	</div>
	<div class="modal-footer">
		<button id="btn-guardar-broker" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
	</div>
</div>
<script src="<?php echo $template; ?>js/pages/modal-brokers.js?v=7.2.9"></script>