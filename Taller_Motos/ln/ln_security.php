<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('assets/phpmailer/Exception.php');
require_once('assets/phpmailer/PHPMailer.php');
require_once('assets/phpmailer/SMTP.php');

require_once('ln_usuarios.php');

class ln_security{

var $ln_usuarios;

function __construct(){

    $this->ln_usuarios = new ln_usuarios();
}

function action_controller(){

    if(isset($_GET['action'])){
        switch($_GET['action']){
           
            case 'login':
            $this->login($_POST);
            break;

            case 'logout':
            $this->logout();
            break;

            case 'enviar_correo':
            $this->enviar_correo($_POST);
            header('Location:cambio.php?mcor=Correo Exitoso');
            break;

        }
    }

}

function login($data){

    $result = $this->ln_usuarios->get_login($data);
    $json = json_encode($result);

    if($result){
        setcookie('usuario', $json, time() + 60*60*24*365);
        header('Location:entrada.php');

    }else{

       header('Location:index.php?mer=Datos Erroneos');

    }

}

function insert_usuario($data){
      
    
    if($this->ln_usuario->insert_user($data)!=false){

    }
}

function logout(){

    unset($_COOKIE['usuario']);
    setcookie('usuario', null, time()-100);

    header('Location:index.php');

} 

function check_access($url){

    if(isset($_COOKIE['usuario'])){
        
        if($url == "index.php"){
            $id=json_decode($_COOKIE['usuario']);
            foreach($id as $item){
            $id=$item;
            break;
            }
            header('Location:entrada.php');
        }

    }else{

        if($url!='index.php'){

            header('Location:index.php');

        }
    }
}

function enviar_correo($data){

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

    $mail->setFrom('wrdkillvibe@gmail.com', 'VirtualLibrery');
    $mail->addAddress($data['correo_electronico_link']);     // Add a recipient
   
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'MightyMotors[CAMBIOCONTRASEÑA]';
    $mail->Body    = 'usuario : ' .$data['correo_electronico_link']. ' ha solicitada un cambio de contrasena ' .$data['correo_electronico_link'].'clink en el siguinte link http://localhost:3000/Taller_Motos/form_cambio.php';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

}

?>