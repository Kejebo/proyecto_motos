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
            $this->insert_usuario($_POST);
            header('Location:login_registro.php?mex=Registro Exitoso');
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

}

?>