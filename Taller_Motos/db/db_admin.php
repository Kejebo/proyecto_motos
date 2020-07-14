<?php

require_once('conexion.php');

class db_admin extends conexion{


    function __construct()
    {
      parent::__construct();  
    }
    function cargar($destino)
    {

        $foto = $_FILES['logo'];
        $destino = $destino . rand(1, 10) . rand(1, 10) . rand(1, 10) . $foto['name'];
        move_uploaded_file($foto['tmp_name'], $destino);

        return $destino;
    }

    function insert_admin($data){
        extract($data);
        $destino = 'assets/logo/';
        $destino = $this->cargar($destino);
        
        $sql = "insert into empresa(nombre,logo,correo,telefono,direccion,cedula_juridica) values('$nombre','$destino','$correo','$telefono','$direccion', '$cedula')";
        $result = $this->execute($sql);
        return $result;
    }

    

    function get_admin(){
        $sql = "select * from empresa;";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }

    function get_month($dia){
        return $this->get_data("call get_mes('$dia')")[0];
    }
    function update_admin($data){
        extract($data);
        $sql="update empresa e set e.nombre='$nombre', e.cedula_juridica='$cedula', e.telefono='$telefono', e.correo='$correo' 
        ,e.logo='$destino', e.direccion='$direccion' where e.id_empresa='$id_empresa';";
        $this->execute($sql);
    }
    }
?>