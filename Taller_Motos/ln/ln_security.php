<?php

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

            case 'insert_user':
            print_r("llegue");
            $this->insert_usuario($_POST);
            header('Location:login_registro.php?msg=Rexitoso');
            break;

        }
    }

}

function login($data){

    $result = $this->ln_usuarios->get_login($data);
    $json = json_encode($result);

    if($result){
        setcookie('usuario', $json, time() + 60*60*24*365);
        //$this->enviar_correo($this->ln_usuarios->get_ultimo_usuario());
        header('Location:libros.php');

    }else{

       header('Location:login_registro.php?msg=Datos Erroneos');

    }

}

function insert_usuario($data){
      
    
    if($this->ln_usuario->insert_user($data)!=false){

    }
}

function logout(){

    unset($_COOKIE['usuario']);
    setcookie('usuario', null, time()-100);

    header('Location:login_registro.php');

} 

function check_access($url){

    if(isset($_COOKIE['usuario'])){
        
        if($url == "login_registro.php"){
            $id=json_decode($_COOKIE['usuario']);
            foreach($id as $item){
            $id=$item;
            break;
            }
            header('Location:libros.php');
        }

    }else{

        if($url == 'libros.php'){

            header('Location:login_registro.php?msg= Te jodiste!');

        }
    }
}

}

?>