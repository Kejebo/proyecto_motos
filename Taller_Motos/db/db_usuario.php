<?php 
require_once('conexion.php');


class db_usuario extends conexion{


    function __construct(){
        parent::__construct();
  
    }

    function get_login($data){

        extract($data);

        $this->conectar();

        mysqli_set_charset($this->conexion,'utf8');
        $us = mysqli_real_escape_string($this->conexion,$correo_electronico);
        $pass = mysqli_real_escape_string($this->conexion,$contrasena);
        $admin = mysqli_real_escape_string($this->conexion,$tipo_usuario);
    print_r($us);

        $sql = "call get_usuario('$us','$pass','$admin')";

        $result = $this->get_data($sql);

        if($result){

            return $result[0];

        }else {

            return false;
        }

    }

    function update_usuario($id){

        $this->conectar();
        extract($data);
        $sql = "call update_cambio_usuario('$id')";
        $result = $this->execute($sql);
        return $result;
        $this->desconectar();
   
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


    function get_usuario_cambio($data){

        extract($data);

        $sql = "call get_usuario_cambio('$correo_electronico_link)";

        $result = $this->get_data($sql);

        if($result){

            $this->update_usuario($result[0][0]);
            return $result[0];
           
        }else {

            return false;
        }

    }

    function validar_estado($id){

        extract($id);

        $sql = "call validar_estado($id)";

        $result = $this->get_data($sql);

        if($result){
            
            return true;
           
        }else {

            return false;
        }

    }

}

?>