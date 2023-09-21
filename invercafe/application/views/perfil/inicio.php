<?php include(APPPATH . 'views/inc/head.php'); ?>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<?php include_once(APPPATH . 'views/inc/header-mobile.php'); ?>
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<?php include_once(APPPATH . 'views/inc/aside.php'); ?>
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<?php include_once(APPPATH . 'views/inc/header.php'); ?>
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
						<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<!--begin::Info-->
							<div class="d-flex align-items-center flex-wrap mr-2">
								<!--begin::Page Title-->
								<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Perfil de Usuario</h5>
								<!--end::Page Title-->
								<!--begin::Actions-->
								<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
								<span class="text-muted font-weight-bold mr-4"></span>
								<!--end::Actions-->
							</div>
							<!--end::Info-->
						</div>
					</div>
					<!--end::Subheader-->
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Dashboard-->
							<!--begin::Row-->
							<div class="row">
								<div class="col-lg-10 col-md-12 col-sm-12 col-xxl-12">
									<!--begin::Advance Table Widget 2-->									
									<div class="card card-custom card-stretch gutter-b">
										<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Card header-->
											<div class="card-header card-header-tabs-line nav-tabs-line-3x">
												<!--begin::Toolbar-->
												<div class="card-toolbar">
													<ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
														<!--begin::Item-->
														<li class="nav-item mr-3">
															<a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_2">
																<span class="nav-icon">
																	<span class="svg-icon">
																		<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<polygon points="0 0 24 0 24 24 0 24" />
																				<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																				<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
																<span class="nav-text font-size-lg">Cuenta</span>
															</a>
														</li>
														<!--end::Item-->
														<!--begin::Item-->
														<li class="nav-item mr-3">
															<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_3">
																<span class="nav-icon">
																	<span class="svg-icon">
																		<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Shield-user.svg-->
																		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																				<rect x="0" y="0" width="24" height="24" />
																				<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
																				<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
																				<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
																			</g>
																		</svg>
																		<!--end::Svg Icon-->
																	</span>
																</span>
																<span class="nav-text font-size-lg">Cambiar Contraseña</span>
															</a>
														</li>
														<!--end::Item-->
														<?php if($user_rolid == 1) { ?>
															<!--begin::Item>
															<li class="nav-item mr-3">
																<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_1">
																	<span class="nav-icon">
																		<span class="svg-icon">
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<polygon points="0 0 24 0 24 24 0 24" />
																					<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
																					<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
																				</g>
																			</svg>
																		</span>
																	</span>
																	<span class="nav-text font-size-lg">Perfil</span>
																</a>
															</li>
															<!--end::Item-->
															<!--begin::Item>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4">
																	<span class="nav-icon">
																		<span class="svg-icon">
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3" />
																					<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000" />
																				</g>
																			</svg>
																		</span>
																	</span>
																	<span class="nav-text font-size-lg">Configuración</span>
																</a>
															</li>
															<!--end::Item-->
														<?php } ?>
													</ul>
												</div>
												<!--end::Toolbar-->
											</div>
											<!--end::Card header-->
											<!--begin::Card body-->
											<div class="card-body">
												<form id="frmProg" class="form" novalidate="novalidate" data-view="perfil">
													<div class="tab-content">
														<!--begin::Tab-->
														<div class="tab-pane show active px-7" id="kt_user_edit_tab_2" role="tabpanel">
															<!--begin::Row-->
															<div class="row">
																<div class="col-xl-2"></div>
																<div class="col-xl-7">
																	<div class="my-2">
																		<!--begin::Group-->
																		<div class="form-group row">
																			<label class="col-form-label col-3 text-lg-right text-left">Nombre de Usuario</label>
																			<div class="col-9">
																				<div class="input-group input-group-lg input-group-solid">
																					<div class="input-group-prepend">
																						<span class="input-group-text">
																							<i class="la la-user-circle"></i>
																						</span>
																					</div>
																					<label class="d-none">Nombre de Usuario</label>
																					<input type="text" name="txtNombreUsuario" class="form-control form-control-lg form-control-solid" value="<?php echo ($user_rolid == 1 ? $user_uname : ""); ?>" placeholder="<?php echo ($user_rolid == 1 ? "Nombre de Usuario" : $user_uname) ?>" required <?php echo ($user_rolid == 1 ? "" : "disabled") ?>/>
																				</div>
																			</div>
																		</div>
																		<!--end::Group-->
																		<!--begin::Group-->
																		<div class="form-group row">
																			<label class="col-form-label col-3 text-lg-right text-left">Correo electrónico</label>
																			<div class="col-9">
																				<div class="input-group input-group-lg input-group-solid">
																					<div class="input-group-prepend">
																						<span class="input-group-text">
																							<i class="la la-at"></i>
																						</span>
																					</div>
																					<label class="d-none">Correo electrónico</label>
																					<input type="text" name="txtEmail" class="form-control form-control-lg form-control-solid" value="<?php echo ($user_rolid == 1 ? $user_email : ""); ?>" placeholder="<?php echo ($user_rolid == 1 ? "Correo electrónico" : $user_email) ?>" required <?php echo ($user_rolid == 1 ? "" : "disabled") ?>/>
																				</div>
																			</div>
																		</div>
																		<!--end::Group-->
																	</div>
																</div>
															</div>
															<!--begin::Footer-->
															<div class="card-footer pb-0">
																<div class="row">
																	<div class="col-xl-2"></div>
																	<div class="col-xl-7">
																		<div class="row">
																			<div class="col-3"></div>
																			<div class="col-9">
																				<?php if($user_rolid == 1) { ?>
																					<button id="btn-guardar-perfil-cuenta" type="button" class="btn btn-light-primary font-weight-bold">Guardar cambios</button>
																				<?php } ?>																				
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!--end::Footer-->
														</div>
														<!--end::Tab-->
														<!--begin::Tab-->
														<div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
															<!--begin::Body-->
															<div class="card-body">
																<!--begin::Row-->
																<div class="row">
																	<div class="col-xl-2"></div>
																	<div class="col-xl-7">
																		<!--begin::Row-->
																		<div class="row mb-5">
																			<label class="col-3"></label>
																			<div class="col-9">
																				<div class="alert alert-custom alert-light-danger fade show py-4" role="alert">
																					<div class="alert-icon">
																						<i class="flaticon-warning"></i>
																					</div>
																					<div class="alert-text font-weight-bold">Tenga en cuenta cambiar su contraseña de manera periódica.</div>
																					<div class="alert-close">
																						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																							<span aria-hidden="true">
																								<i class="la la-close"></i>
																							</span>
																						</button>
																					</div>
																				</div>
																			</div>
																		</div>
																		<!--end::Row-->
																		<!--begin::Group-->
																		<div class="form-group row">
																			<label class="col-form-label col-3 text-lg-right text-left">Contraseña actual</label>
																			<div class="col-9">
																				<label class="d-none">Contraseña actual</label>
																				<input name="txtActualPasswd" class="form-control form-control-lg form-control-solid mb-1" type="password" placeholder="Contraseña actual" required/>
																			</div>
																		</div>
																		<!--end::Group-->
																		<!--begin::Group-->
																		<div class="form-group row">
																			<label class="col-form-label col-3 text-lg-right text-left">Nueva contraseña</label>
																			<div class="col-9">
																				<label class="d-none">Nueva contraseña</label>
																				<input id="txtNuevoPasswd" name="txtNuevoPasswd" class="form-control form-control-lg form-control-solid" type="password" placeholder="Nueva contraseña" required />
																			</div>
																		</div>
																		<!--end::Group-->
																		<!--begin::Group-->
																		<div class="form-group row">
																			<label class="col-form-label col-3 text-lg-right text-left">Verificar contraseña</label>
																			<div class="col-9">
																				<label class="d-none">Verificar contraseña</label>
																				<input id="txtVerificarPasswd" name="txtVerificarPasswd" class="form-control form-control-lg form-control-solid" type="password" placeholder="Verificar contraseña" required />
																			</div>
																		</div>
																		<!--end::Group-->
																	</div>
																</div>
																<!--end::Row-->
															</div>
															<!--end::Body-->
															<!--begin::Footer-->
															<div class="card-footer pb-0">
																<div class="row">
																	<div class="col-xl-2"></div>
																	<div class="col-xl-7">
																		<div class="row">
																			<div class="col-3"></div>
																			<div class="col-9">
																				<button id="btn-guardar-perfil-contrasena" type="button" class="btn btn-light-primary font-weight-bold">Guardar cambios</button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!--end::Footer-->
														</div>
														<!--end::Tab-->
														<?php if($user_rolid == 1) { ?>
															<!--begin::Tab-->
															<!--end::Tab-->
														<?php } ?>
													</div>
												</form>
											</div>
											<!--begin::Card body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end::Advance Table Widget 2-->
								</div>
							</div>
							<!--end::Row-->
							<!--end::Reportes-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Entry-->
				</div>
				<!--end::Content-->
				<?php include_once(APPPATH . 'views/inc/footer.php'); ?>
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>

	<?php include_once(APPPATH . 'views/inc/js-admin.php'); ?>
</body>
</html>