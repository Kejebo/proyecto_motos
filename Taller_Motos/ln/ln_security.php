<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');

require_once('ln_usuarios.php');
require_once('ln_client.php');

class ln_security
{

    var $ln_usuarios;
    var $ln_clientes;
    var $Key = "CLAVESUPERSECRETA";
    var $error;

    function __construct()
    {

        $this->ln_usuarios = new ln_usuarios();
        $this->ln_clientes = new ln_client();
    }

    function action_controller()
    {

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {

                case 'login':
                    $this->login($_POST);
                    break;


                case 'logout':
                    $this->logout();
                    break;

                case 'enviar_correo':
                    $this->enviar_correo_primera();
                    break;

                case 'reenviar_correo':
                    $this->reenviar_correo();
                    break;

                case 'cambio_contrasena':
                    $this->cambio_contrasena($_POST);
                    break;

                case 'validar':
                    $this->validar_codigo($_POST['codigo'], $_POST['id']);
                    break;
            }
        }
    }


    function encriptar($valor)
    {
        $method = 'aes-256-cbc';
        $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
        return openssl_encrypt($valor, $method, $this->Key, false, $iv);
    }


    function enviar_correo_primera()
    {
        $codigo = $this->get_codigo();
        $correo = $_POST["correo_electronico_link"];
        $id = $this->get_usuario_cambio($_POST, $codigo);
        if ($this->get_usuario_cambio($_POST, $codigo) == false) {
            echo json_encode(array("result" => "codigo_activo"));
        } else if ($this->enviar_correo($_POST, $codigo) == false) {
          echo json_encode(array("resultDos" => "false", "result" => $this->error, "id_usuario" => $id, "correo" => $correo));
        } else {
          echo json_encode(array("result" => "true", "id_usuario" => $id, "correo" => $correo));
        }
    }

    function generar_numero_aleatorio()
    {

        return rand(0, 100);
    }

    function get_codigo()
    {

        $data = array();

        for ($i = 0; $i < 4; $i++) {

            array_push($data, $this->generar_numero_aleatorio());
        }

        return $data;
    }


    function update_estado_cambio_negativo($id)
    {

        $this->ln_usuarios->update_estado_cambio_negativo($id);
    }


    function update_usuario($codigo, $id)
    {

        $this->ln_usuarios->update_usuario($codigo, $id);
    }

    function cambio_contrasena($data)
    {

        if ($_POST['contrasenaUno'] == $_POST['contrasenaDos']) {
            if ($this->ln_usuarios->cambio_contrasena($data) == true) {
                unset($_COOKIE['usuario']);
                setcookie('usuario', null, time() - 100);
                unset($_COOKIE['cliente']);
                setcookie('cliente', null, time() - 100);
                echo json_encode(array("result" => "actualizado"));
            } else {
                echo json_encode(array("result" => "no actualizado"));
            }
        } else {
            echo json_encode(array("result" => "no iguales"));
        }
    }

    function login($data)
    {
        $result = $this->ln_usuarios->get_login($data);
        $json = json_encode($result);

        if ($result) {
            if ($result[3] != "cliente") {
                setcookie('usuario', $json, time() + 60 * 60 * 24 * 365);
                header('Location:inventary.php');
            } else if ($result[3] == "cliente") {
                $result_Cliente = $this->ln_clientes->get_client($data);
                $json_cliente = json_encode($result_Cliente);
                setcookie('cliente', $json_cliente, time() + 60 * 60 * 24 * 365);
                setcookie('usuario', $json, time() + 60 * 60 * 24 * 365);
                header('Location:cliente/security.php?action=log_in&datos=' . $this->encriptar($_POST['correo_electronico']));
            }
        } else {
            header('Location:index.php?mer=Datos Erroneos');
        }
    }

    function insert_usuario($data)
    {

        if ($this->ln_usuario->insert_user($data) != false) {
        }
    }

    function get_usuario_cambio($data, $codigo)
    {
        return $this->ln_usuarios->get_usuario_cambio($data, $codigo);
    }

    function validar_codigo($codigo, $id)
    {

        if ($this->ln_usuarios->validar_codigo($codigo, $id) != false) {
            echo json_encode(array("result" => "true", "id_usuario" => $id));
        } else {
            echo json_encode(array("result" => "false", "id_usuario" => $id));
        }
    }

    function reenviar_correo()
    {
        $codigo = $this->get_codigo();
        $id = $_POST['id'];
        $correo =  $_POST['correo_electronico_link'];
        if ($this->get_usuario_cambio($_POST, $codigo) == false) {
            echo json_encode(array("result" => "codigo_activo"));
        } else if ($this->enviar_correo($_POST, $codigo) == false) {
            echo json_encode(array("result" => "false", "id_usuario" => $id, "correo" => $correo));
        } else {
            echo json_encode(array("result" => "true", "id_usuario" => $id, "correo" => $correo));
        }
    }


    function logout()
    {

        if (isset($_COOKIE['usuario'])) {
            if (isset($_COOKIE['cliente'])) {
            unset($_COOKIE['usuario']);
            setcookie('usuario', null, time() - 100);
            unset($_COOKIE['cliente']);
            setcookie('cliente', null, time() - 100);
            header('Location:index.php');
            }else{
                unset($_COOKIE['usuario']);
                setcookie('usuario', null, time() - 100);  
                header('Location:index.php');
            }
        } else if (isset($_COOKIE['cliente'])) {

            unset($_COOKIE['cliente']);
            setcookie('cliente', null, time() - 100);
            header('Location: cliente/security.php?action=logout_cambio_contrasena');
        }
    }


    function check_tipo_login($url)
    {

        if (isset($_COOKIE['usuario'])) {
            if ($url != 'recuperacion.php') {
                $data = json_decode($_COOKIE['usuario'], true);
                if ($data['tipo'] == 'administrador' || $data['tipo'] == 'tecnico') {
                    header('Location:inventary.php');
                } else if ($data['tipo'] == 'cliente') {
                    header('Location:cliente/index.php');
                }
            }
        }
    }

    function check_tipo_login_tecnico($url)
    {
            if ($url == 'recuperacion.php' || $url == 'users.php' || $url == 'proveedores.php' ) {
                    header('Location:inventary.php');
                }
            }
        
    function check_tipo_login_admin()
    {

        if (isset($_COOKIE['usuario'])) {
            $data = json_decode($_COOKIE['usuario'], true);
            if ($data['tipo'] == 'cliente' ) {
                header('Location:cliente/index.php');
            }
        } else {
            header('Location:index.php');
        }
    }


    function enviar_correo($data, $codigo)
    {

        $respuesta = false;
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'wrdkillvibe@gmail.com';                     // SMTP username
            $mail->Password   = 's.Zuniga29';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            $mail->setFrom('wrdkillvibe@gmail.com', 'Taller Migthy Motors');
            $mail->addAddress($data['correo_electronico_link']);     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'MightyMotors[CODIGO DE SEGURIDAD]';
            $mail->Body    = 'Usuario : ' . $data['correo_electronico_link'] . ' ha solicitada una recuperacion de contraseña '. 'copie el siguiente codigo de seguridad: ' . $codigo[0] . $codigo[1] . $codigo[2];

            $mail->send();
            $respuesta = true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $respuesta = false;
        }

        return $respuesta;
    }
}
