"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');

        _login.addClass(cls);
		$('#'+ form + ' input:eq(0)').focus();

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'El nombre de usuario es requerido'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'La contraseña es requerida'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					var btn = KTUtil.getById("kt_login_signin_submit");
					KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Cargando...");
					$(e.target).attr("disabled","");
					$.ajax({
						dataType: "json",
						data: $("form").serialize(),
						url:   HOST_URL + 'login/login',
						type:  'post',
						beforeSend: function(){
						//Lo que se hace antes de enviar el formulario
						},
						success: function(data, status, xhr){
							if (data.RolId == -1 || data.RolId == -2) {
								if (data.RolId == -2) {
									$("#kt_login_forgot").show();
									$("#label_username span").html($("input[name=username]").val());
								}
								swal.fire({
									text: data.USRMensaje,
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Aceptar",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function() {
									KTUtil.scrollTop();
								});
								$(e.target).removeAttr("disabled");
								KTUtil.btnRelease(btn);
							} else {
								document.location.href = HOST_URL;
							}
						},
						error:	function(xhr,err){ 
							swal.fire({
								text: xhr.responseText,
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Aceptar",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							}).then(function() {
								KTUtil.scrollTop();
							});
						}
					});					
				} else {
					swal.fire({
		                text: "Lo siento, por favor corrige los errores para continuar",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Corregir",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'El correo electrónico es requerido'
							},
                            emailAddress: {
								message: 'El correo ingresado no es un correo electrónico'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Submit form
					var btn = KTUtil.getById("kt_login_forgot_submit");
					KTUtil.btnWait(btn, "spinner spinner-right spinner-white pr-15", "Enviando...");
					$(e.target).attr("disabled","");
					$.ajax({
						dataType: "json",
						data: $("form").serialize(),
						url:   HOST_URL + 'login/restore',
						type:  'post',
						beforeSend: function(){
						//Lo que se hace antes de enviar el formulario
						},
						success: function(data, status, xhr){
							if (data.USRId == -1) {
								swal.fire({
									text: data.USRMensaje,
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Aceptar",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function() {
									KTUtil.scrollTop();
								});
							} else {								
								swal.fire({
									text: data.USRMensaje,
									icon: "success",
									buttonsStyling: false,
									confirmButtonText: "Aceptar",
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function() {
									KTUtil.scrollTop();
								});
							}
							$(e.target).removeAttr("disabled");
							KTUtil.btnRelease(btn);
						},
						error:	function(xhr,err){ 
							swal.fire({
								text: xhr.responseText,
								icon: "error",
								buttonsStyling: false,
								confirmButtonText: "Aceptar",
								customClass: {
									confirmButton: "btn font-weight-bold btn-light-primary"
								}
							}).then(function() {
								KTUtil.scrollTop();
							});
						}
					});
				} else {
					swal.fire({
		                text: "Lo siento, por favor corrige los errores para continuar",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Corregir",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
