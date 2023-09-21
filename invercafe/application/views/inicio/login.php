<?php include_once(APPPATH . 'views/inc/head.php'); ?>
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!-- Google Tag Manager (noscript) -->
	<!--noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript-->
	<!-- End Google Tag Manager (noscript) -->
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside d-flex flex-column flex-row-auto" style="background-image: url(<?php echo $template; ?>media/bg/bg-invercafe.jpg); position: relative; background-position: top; background-size: cover!important">
				<!--begin::Aside Top-->
				<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-40">
					<!--begin::Aside header-->
					<!--a href="#" class="text-center mb-10">
						<img src="<?php echo $template; ?>media/logos/logo-text-white.png" class="max-h-120px" alt="" />
					</a-->
					<!--end::Aside header-->
					<!--begin::Aside title-->
					<!--h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #595a5c;">Descubra como automatizar sus agendas de la manera más fácil posible</h3-->
					<!--end::Aside title-->
				</div>
				<!--end::Aside Top-->
				<!--begin::Aside Bottom-->
				<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"></div>
				<!--end::Aside Bottom-->
			</div>
			<!--begin::Aside-->
			<!--begin::Content-->
			<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
				<!--begin::Content body-->
				<div class="d-flex flex-column-fluid flex-center">
					<!--begin::Signin-->
					<div class="login-form login-signin">
						<!--begin::Form-->
						<!--form id="formLogin" novalidate="novalidate" action="#!" onsubmit="return form_home(this); return false;" method="post"-->
						<form class="form" novalidate="novalidate" id="kt_login_signin_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Bienvenido al módulo para Gestión de Contratos</h3>
								<!--span class="text-muted font-weight-bold font-size-h4">New Here? 
								<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span-->
							</div>
							<!--begin::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<label class="font-size-h6 font-weight-bolder text-dark">Nombre de Usuario</label>
								<input name="username" type="text" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" autocomplete="off" placeholder="Nombre de Usuario" autofocus>
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									<label class="font-size-h6 font-weight-bolder text-dark pt-5">Contraseña</label>
									<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot" style="display:none">¿Olvido su contraseña?</a>
								</div>
								<input name="password" type="password" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" placeholder="Contraseña" autocomplete="off">
							</div>
							<!--end::Form group-->
							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Ingresar</button>
							</div>
							<!--end::Action-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Signin-->
					<!--begin::Signup-->

					<!--end::Signup-->
					<!--begin::Forgot-->
					<div class="login-form login-forgot">
						<!--begin::Form-->
						<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-boldest text-dark font-size-h4 font-size-h1-lg">Recuperar Contraseña</h3>
								<p class="text-muted font-weight-bold font-size-h4">Al utilizar este formulario se enviará una nueva contraseña de acceso a su correo electrónico</p>
							</div>
							<!--end::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<label id="label_username" class="font-size-h6 font-weight-bolder text-dark pt-5">Nombre de Usuario: <span class="text-muted font-weight-bold font-size-h4"><span></label>
								<input name="email" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Correo electrónico" autocomplete="off" required/>
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group d-flex flex-wrap pb-lg-0">
								<button type="submit" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Enviar Contraseña</button>
								<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancelar</button>
							</div>
							<!--end::Form group-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Forgot-->
				</div>
				<!--end::Content body-->
				<!--begin::Content footer-->
				<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
					<div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
						<span class="mr-1"><?php echo date('Y'); ?>©</span>
						<a href="http://solutions-systems.com/" target="_blank" class="text-dark-75 text-hover-primary">Invercafe Cerritos S.A.S</a>
					</div>
					<!--a href="#" class="text-primary font-weight-bolder font-size-lg">Terms</a>
					<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
					<a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a-->
				</div>
				<!--end::Content footer-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Login-->
	</div>
	<?php include_once(APPPATH . 'views/inc/js-login.php'); ?>
</body>
</html>