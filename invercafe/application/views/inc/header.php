<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
	<!--begin::Container-->
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<div class="header-menu-wrapper header-menu-wrapper-left"></div>
		<!--begin::Topbar-->
		<div class="topbar">
			<!--begin::Search-->
			<div class="dropdown" id="kt_quick_search_toggle">
				<!--begin::Toggle-->
				<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
					<div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
						<span class="svg-icon svg-icon-xl svg-icon-primary">
							<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
					</div>
				</div>
				<!--end::Toggle-->
				<!--begin::Dropdown-->
				<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
					<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
						<!--begin:Form-->
						<form method="get" class="quick-search-form">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<span class="svg-icon svg-icon-lg">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Search.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
								</div>
								<input type="text" class="form-control" placeholder="Buscar..." />
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
									</span>
								</div>
							</div>
						</form>
						<!--end::Form-->
						<!--begin::Scroll-->
						<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
						<!--end::Scroll-->
					</div>
				</div>
				<!--end::Dropdown-->
			</div>
			<!--end::Search-->
			<!--begin::Notifications-->

			<!--end::Notifications-->
			<!--begin::Quick Actions-->

			<!--end::Quick Actions-->
			<!--begin::Cart-->

			<!--end::Cart-->
			<!--begin::Quick panel-->

			<!--end::Quick panel-->
			<!--begin::Chat-->

			<!--end::Chat-->
			<!--begin::Languages-->

			<!--end::Languages-->
			<!--begin::User-->
			<div class="topbar-item">
				<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
					<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Bienvenido,</span>
					<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php echo $user_username; ?></span>
					<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
						<span class="symbol-label font-size-h5 font-weight-bold"><?php echo $user_username[0]; ?></span>
					</span>
				</div>
			</div>
			<!--end::User-->
		</div>
		<!--end::Topbar-->
	</div>
	<!--end::Container-->
</div>
<!--end::Header-->

<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
	<!--begin::Header-->
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">Perfil de Usuario</h3>
		<!--small class="text-muted font-size-sm ml-2">12 messages</small></h3-->
		<a href="#!" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
	<!--end::Header-->
	<!--begin::Content-->
	<div class="offcanvas-content pr-5 mr-n5">
		<!--begin::Header-->
		<div class="d-flex align-items-center mt-5">
			<div class="symbol symbol-100 mr-5">
				<div class="symbol-label" style="background-image:url('<?php echo $template; ?>media/users/<?php echo ($user_rolid == 1 || $user_rolid == 3) ? "blank" : $user_id ?>.jpg')"></div>
				<i class="symbol-badge bg-success"></i>
			</div>
			<div class="d-flex flex-column">
				<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $user_username; ?></a>
				<div class="text-muted mt-1">Usuario Corporativo</div>
				<div class="navi mt-2">
					<a href="#" class="navi-item">
						<span class="navi-link p-0 pb-2">
							<span class="navi-icon mr-1">
								<span class="svg-icon svg-icon-lg svg-icon-primary">
									<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
											<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</span>
							<span class="navi-text text-muted text-hover-primary"><?php echo $user_email; ?></span>
						</span>
					</a>
					<a href="<?php echo $site_url?>login/logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Cerrar Sesión</a>
				</div>
			</div>
		</div>
		<!--end::Header-->
		<!--begin::Separator-->
		<?php if($user_rolid == 1 || $user_rolid == 2 || $user_rolid == 3) { ?>
			<div class="separator separator-dashed mt-8 mb-5"></div>
			<!--end::Separator-->
			<!--begin::Nav-->
			<div class="navi navi-spacer-x-0 p-0">
				<!--begin::Item-->
				<a href="#" onclick="VerMenuOpcion(this)" class="navi-item" href-data="perfil">
					<div class="navi-link">
						<div class="symbol symbol-40 bg-light mr-3">
							<div class="symbol-label">
								<span class="svg-icon svg-icon-md svg-icon-success">
									<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Notification2.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
											<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
							</div>
						</div>
						<div class="navi-text">
							<div class="font-weight-bold">Ver Perfil</div>
							<div class="text-muted">Configuración de cuenta 
							<span class="label label-light-danger label-inline font-weight-bold">Actualizar</span></div>
						</div>
					</div>
				</a>
			</div>
			<!--end::Nav-->
			<!--begin::Separator-->
		<?php } ?>						
		<div class="separator separator-dashed my-7"></div>
		<!--end::Separator-->
		<!--begin::Notifications-->
		<div>
			<!--begin:Heading-->
			<!--end:Heading-->
			<!--begin::Item-->
			<!--end::Item-->
		</div>
		<!--end::Notifications-->
	</div>
	<!--end::Content-->
</div>
<!-- end::User Panel-->

<!--begin::Chat Panel-->
<div class="modal modal-sticky" id="kt_chat_modal" role="dialog" data-backdrop="false">
	<div class="modal-dialog" role="document"></div>
</div>
<!--end::Chat Panel-->

<!--begin::Tipificador Panel-->
<div class="whatsapp flex-row-auto w-350px w-xl-400px d-none" id="kt_tipif_aside">
	<div class="card card-custom rounded-0"></div>
</div>
<!--end::Tipificador Panel-->