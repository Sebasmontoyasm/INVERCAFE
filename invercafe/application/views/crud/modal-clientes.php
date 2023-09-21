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
		<h5 class="modal-title" id="exampleModalLabel">Gestionar Usuario</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<i aria-hidden="true" class="ki ki-close"></i>
		</button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<label class="form-text text-success">Adiciona o modifica usuarios en el siguiente formulario</label>
			<input id="hidIdUsuario" name="hidIdUsuario" type="hidden" class="form-control" value="<?php echo (isset($usuario->USRId) ? $usuario->USRId : "") ?>">
			<input id="hidIdEstado" name="hidIdEstado" type="hidden" class="form-control" value="<?php echo (isset($usuario->USREstado) ? $usuario->USREstado : 1) ?>">
		</div>
		<div class="form-group">
			<label>Perfil</label>
			<select class="form-control form-control-solid" id="cmbPerfil" name="cmbPerfil" required>
				<option value="">[Seleccionar]</option>
				<?php foreach ($perfiles as $indice => $perfil) { ?>
					<option value="<?php echo $perfil->PERFId ?>" <?php echo (isset($usuario->PERFId) ? ($perfil->PERFId == $usuario->PERFId ? "selected" : "") : "") ?>><?php echo $perfil->PERFDescripcion ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label>Nombres</label>
			<input id="txtNames" name="txtNames" type="text" class="form-control form-control-solid" value="<?php echo (isset($usuario->Name) ? $usuario->Name : "") ?>" placeholder="Nombres" required />
		</div>
		<div class="form-group">
			<label>Apellidos</label>
			<input id="txtLastNames" name="txtLastNames" type="text" class="form-control form-control-solid" value="<?php echo (isset($usuario->LastName) ? $usuario->LastName : "") ?>" placeholder="Apellidos" required />
		</div>
		<div class="form-group">
			<label>Nombre de Usuario</label>
			<input id="txtUserName" name="txtUserName" type="text" class="form-control form-control-solid" value="<?php echo (isset($usuario->UserName) ? $usuario->UserName : "") ?>" placeholder="Nombre de Usuario" required />
		</div>
		<div class="form-group">
			<label>Correo electrónico</label>
			<input id="txtEmail" name="txtEmail" type="email" class="form-control form-control-solid" value="<?php echo (isset($usuario->Email) ? $usuario->Email : "") ?>" placeholder="Correo electrónico" required />
		</div>
		<div class="form-group">
			<label>Contraseña temporal</label>
			<input id="txtPassword" name="txtPassword" type="password" class="form-control form-control-solid" placeholder="Contraseña temporal" />
		</div>
	</div>
	<div class="modal-footer">
		<button id="btn-guardar-usuario" type="button" class="btn btn-primary font-weight-bold">Almacenar</button>
	</div>
</div>
