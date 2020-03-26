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
            $codigo = $this->get_codigo();
            $id = $this->get_usuario_cambio($_POST,$codigo);
            $this->enviar_correo($_POST,$codigo);
            header('Location:validacion.php?users_id='.$id.'&correo='.$_POST['correo_electronico_link']);
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

function update_estado_cambio_negativo($id){

    $this->ln_usuarios->update_estado_cambio_negativo($id);
}


function generar_numero_aleatorio(){

    return rand(0,100);
}

function get_codigo(){

    $data = array();

    for($i = 0; $i < 4; $i++){
        
        array_push($data,$this->generar_numero_aleatorio());
    }

    return $data;
}

function update_usuario($codigo,$id){

    $this->ln_usuarios->update_usuario($codigo,$id);

}

function cambio_contrasena($data){
  
 echo json_encode($this->ln_usuarios->cambio_contrasena($data));
    
   

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

function validar_codigo($codigo,$id){

    if($this->ln_usuarios->validar_codigo($codigo,$id)!=false){
        header('Location:form_cambio.php?user_id='.$id);
    }else{
        header('Location:validacion.php?users_id='.$id.'&correo='.$_POST['correo_electronico_link'].'&mer=true');
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

        if($url!='index.php' && $url=='entrada.php'){

            header('Location:index.php');

        }
    }
}

function get_usuario_cambio($data,$codigo){
     return $this->ln_usuarios->get_usuario_cambio($data,$codigo);
}

function enviar_correo($data,$codigo){

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

    $mail->setFrom('wrdkillvibe@gmail.com', 'VirtualLibrery');
    $mail->addAddress($data['correo_electronico_link']);     // Add a recipient
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'MightyMotors[CAMBIOCONTRASEÑA]';
    $mail->Body    = 'usuario : ' .$data['correo_electronico_link']. ' ha solicitada un cambio de contrasena ' .$data['correo_electronico_link'].'copie el siguinte codigo:'.$codigo[0].$codigo[1].$codigo[2];
        # code...
    
        # code...
    
    $mail->send();
   $respuesta = true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $respuesta= false;
}

return $respuesta;

}

}

?>