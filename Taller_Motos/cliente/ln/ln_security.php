<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');
require_once('aseets/phpmailer/VerifyEmail.php');
require_once('ln_usuarios.php');

class ln_security
{

    var $ln_usuarios;
    var $Key = "CLAVESUPERSECRETA";
    var $mail;

    function __construct()
    {
        $this->mail = new VerifyEmail();
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



function validar_correo($correo){

    $this->mail->setStreamTimeoutWait(20);
    $this->mail->Debug= TRUE; 
    $this->mail->Debugoutput= 'html';
     $this->mail->setEmailFrom('from@email.com'); 

    if($this->mail->check($correo)){ 
       return true;
    }else if(verifyEmail::validate($correo)){ 
      false; 
    }else{ 
     false; 
  } 
}

function enviar_correo_consultando($emisor, $tema,$nombre, $mensaje)
    {
       
        $respuesta = false;
        $mail = new PHPMailer(true);
      if($this->validar_correo($emisor)){
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
            $mail->addAddress('wrdkillvibe@gmail.com');     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tema;
            $mail->Body    = 'hola';

            $mail->send();
            $respuesta = true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $respuesta = false;
        }
    }else{
        return $respuesta;
    }

    
    }
}


?>