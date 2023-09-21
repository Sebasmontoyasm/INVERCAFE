<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();

		date_default_timezone_set('America/Bogota');
        setlocale(LC_TIME, "spanish");
    }

/*    public function index($mensaje = "") {
        if ($mensaje == 1) {
            $mensaje = 'Usuario o contraseña incorrectos, intentelo nuevamente';
        }

        $this->tp['mensaje'] = $mensaje;

        if (!$this->isLogedIn()) {
            //no hay usuario envia al login
            $this->load->view('login/login', $this->tp);
        } else {
            $this->GetCurrentUser();
            if ($this->user->RolId == 1 || $this->user->RolId == 2) {
                header('location:' . $this->tp['site_url'] . 'certificados');
            }elseif( $this->user->RolId == 3 || $this->user->RolId == 6 || $this->user->RolId == 10){
                header('location:' . $this->tp['site_url'] . 'consultas');
            }elseif( $this->user->RolId == 4 || $this->user->RolId == 5 || $this->user->RolId == 7 || $this->user->RolId == 9){
                header('location:' . $this->tp['site_url'] . 'estadisticas');
            } else {
                //echo 'vista de super administrador';
            }
        }
    }
*/
    public function phpin() {
        echo phpinfo();
    }

    public function login() {
        if ($_POST) {

            $post = $this->input->post(null, true);

            try {
                $this->load->model('usuarios_mdl', 'usuariosModel');
                $user = $this->usuariosModel->ConsultarUsuarioLogin($post['username'], $post['password']);
                if($user->Row()->RolId > 0){
					$this->sess->set('loged' . $this->RefSesion, true);
					$this->sess->set('logedTime' . $this->RefSesion, time());
					$this->sess->set('RolId' . $this->RefSesion, $user->Row()->RolId);
					$this->sess->set('UserId' . $this->RefSesion, $user->Row()->USRId);
				}
                exit(json_encode($user->row()));
                //header('location:' . site_url());                    
            } catch (Exception $ex) {

                header('location:' . $this->tp['site_url'] . 'login/index/1');
            }
        }
    }

    public function logout() {
        $this->sess->delete('loged' . $this->RefSesion);
        $this->sess->delete('logedTime' . $this->RefSesion);
        $this->sess->delete('RolId' . $this->RefSesion);
        $this->sess->delete('UserId' . $this->RefSesion);

        header('location:' . site_url());
    }

    public function restore() {
        if ($_POST) {

            $post = $this->input->post(null, true);
            $resp = array('success' => true);
            
            $this->load->model('usuarios_mdl', 'usuariosModel');
            $user = $this->usuariosModel->ConsultarUsuarioEmail($post['username'], $post['email']);
            
            if ($user->row()->USRId <= 0) {
                $resp['success'] = false;
                exit(json_encode($user->row()));
            } else {
                $letras = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z');
                $letra1 = $letras[rand(0, 24)];
                $letra2 = strtoupper($letras[rand(0, 24)]);
                $contrasena = $letra1 . $letra2 . '_' . rand(1000, 1999) . '!';
                $userActualiza = $this->usuariosModel->ActualizarUsuarioContrasena($contrasena, $user->row()->USRId);
                
				$this->load->model('config_mdl', 'configModel');
				$config = $this->configModel->ObtenerConfiguracion();
				
                require APPPATH . 'libraries/phpmailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

				$mail->SetFrom($config->row()->CFGEmpresaMailAutResp, $config->row()->CFGEmpresaSbjAutResp);
                $mail->IsSMTP();
                //configuracion mail
				$mail->SMTPSecure = $config->row()->CFGEmpresaSMTPSeguro; // sets the prefix to the servier
				//$mail->SMTPDebug  = 2; // enables SMTP debug information (for testing) 1 = errors and messages 2 = messages only
				$mail->Host = $config->row()->CFGEmpresaMailHost;
				$mail->Port = $config->row()->CFGEmpresaPuerto;
				$mail->SMTPAuth = true;
				$mail->Username = $config->row()->CFGEmpresaMailAutResp;
				$mail->Password = $config->row()->CFGEmpresaPwdAutResp;

                $mail->addAddress( $post['email'] );     // Add a recipient
                $mail->addReplyTo($config->row()->CFGEmpresaMailAutResp, $config->row()->CFGEmpresaSbjAutResp);
                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                $mail->isHTML(true);                                  
                // Set email format to HTML
                $titulo = "Restablecimiento de Contrasena " . $config->row()->CFGNombreAplicacion;

                $mensaje = 'Se ha solicitado el cambio de su contraseña de acceso al aplicativo ' . $config->row()->CFGNombreAplicacion;
                $mensaje .= '<br/><br/><br/><br/><strong>Datos de acceso</strong>';
                $mensaje .= '<br/><br/><strong>Usuario: </strong>'. $post['email'];
                $mensaje .= '<br/><br/><strong>Contraseña: </strong>'. $contrasena;
                $mensaje .= '<br/>---------------------';
                $mensaje .= '<br/><br/>Por favor ingrese nuevamente con las credenciales suministradas anteriormente, Bienvenido.';
                $mensaje .= '<br/><br/>Cualquier duda o inquietud, no dude en comunicarse con nosotros';
//                $mensaje .= '<img src="'.$this->tp["template"].'img/logo-small.jpg" alt="Equidad Seguros" />';
                
                $this->tp['titulo'] = $titulo;
                $this->tp['mensaje'] = $mensaje;

                $mail->Subject = utf8_decode($titulo);
                $mail->Body = utf8_decode($this->load->view('inc/mail_view', $this->tp, true));
                $mail->AltBody = strip_tags($mensaje);

                $rta = $mail->Send();
                if(!$rta) {
                  $rta = $mail->ErrorInfo;
                } else {
                  //return $rta;
                }

                exit(json_encode($user->row()));
            }
        }
    }

}

?>