<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');

require_once('ln_usuarios.php');

class ln_security
{

    var $ln_usuarios;
    var $Key = "CLAVESUPERSECRETA";

    function __construct()
    {

        $this->ln_usuarios = new ln_usuarios();
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
            header('Location:../security.php?action=logout');
        }
    }
}
