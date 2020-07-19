<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');
require_once('ln_usuarios.php');
require_once('db/db_admin.php');

class ln_security
{

    var $ln_usuarios;
    var $Key = "CLAVESUPERSECRETA";
    var $db;


    function __construct()
    {

        $this->ln_usuarios = new ln_usuarios();
        $this->db = new db_admin();
    }

    function action_controller()
    {

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {

                case 'log_in':
                    $this->login();
                    break;

                case 'logout':
                    $this->logout();
                    break;

                case 'enviar_correo_consulta':
                    $this->enviar_correo_consulta();
                    break;
            }
        }
    }



    function check_tipo_login_cliente()
    {

        if (isset($_COOKIE['usuario'])) {
            $data = json_decode($_COOKIE['usuario'], true);
            if ($data['tipo'] != 'cliente') {
                header('Location:../inventary.php');
            }
        } else {
            header('Location:../index.php');
        }
    }


    function desencriptar($valor)
    {
        $method = 'aes-256-cbc';
        $iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

        $encrypted_data = base64_decode($valor);
        return openssl_decrypt($valor, $method, $this->Key, false, $iv);
    }


    function login()
    {
        // $result = $this->ln_usuarios->get_usuario($_GET['datos']);
        // $json = json_encode($result);

        //   setcookie('usuario', $json, time() + 60 * 60 * 24 * 365);
        //  print_r($this->desencriptar($_GET['datos']));

        header('Location:index.php');
    }

    function logout()
    {

        if (isset($_COOKIE['usuario'])) {

            unset($_COOKIE['usuario']);
            setcookie('usuario', null, time() - 100);

            unset($_COOKIE['cliente']);
            setcookie('cliente', null, time() - 100);

            header('Location:../security.php?action=logout');
        }
    }


    function enviar_correo_consulta()
    {

        $tema = $_POST["tema"];
        $emisor = $_POST["emisor"];
        $mensaje = $_POST["mensaje"];
        $nombre = $_POST["nombre"];
        if ($this->enviar_correo_consultando($emisor, $tema, $nombre, $mensaje) == false) {
            echo json_encode(array("result" => false));
        } else {
            echo json_encode(array("result" => true));
        }
    }

    function is_valid_email($str)
    {
        echo ($str);
        if (checkdnsrr($str, "MX")) {
            return true;
        } else {
            return false;
        }
    }



    function enviar_correo_consultando($emisor, $tema, $nombre, $mensaje)
    {

        $respuesta = false;
        $mail = new PHPMailer(true);
        $datos = $this->db->get_admin();

        try {
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $datos['correo'];                     // SMTP username
            $mail->Password   = $datos['contrasena'];                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            $mail->setFrom($datos['correo'], $datos['nombre']);
            $mail->addAddress($datos['correo']);     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tema;
            $mail->Body    = $mensaje . "<br />" . 'Usuario: ' . $emisor . "<br />" . 'Nombre: ' . $nombre;

            $mail->send();
            $respuesta = true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $respuesta = false;
        }

        return $respuesta;
    }
}
