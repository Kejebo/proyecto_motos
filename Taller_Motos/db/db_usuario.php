<?php 
require_once('conexion.php');


class db_usuario extends conexion{


    function __construct(){
        parent::__construct();
    }

    function get_login($data){

        extract($data);

        $sql = "call get_usuario('$correo_electronico','$contrasena','$tipo_usuario')";

        $result = $this->get_data($sql);

        if($result){

            return $result[0];

        }else {

            return false;
        }

    }

    function insert_usuario($data){
        $this->conectar();
        extract($data);
        $sql = "call insert_usuarios('$nombre','$correo','$tipo','$clave')";
        $result = $this->execute($sql);
        return $result;
        $this->desconectar();
    }

    function get_ultimo_usuario(){
        $sql = "call get_ultimo_usuario()";
        $result = $this->get_data($sql);
        return $result[0];
    }


}

?>