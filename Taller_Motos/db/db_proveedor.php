<?php

require_once('conexion.php');

class db_proveedor extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_proveedor($data){
        extract($data);

        $sql = "call insert_proveedores('$nombre','$telefono','$correo','$cedula')";
        $result = $this->execute($sql);
        return $result;
    }

    

    function get_proveedores(){
        $sql = "select * from proveedores;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function delete_proveedor($id){
        $sql= "call delete_proveedor('$id')";
        $this->execute($sql);
    }
    function get_proveedor($id){
        $sql = "select * from proveedores where id_proveedor='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function update_proveedor($data){
        extract($data);
        $sql="update proveedores p set p.nombre='$nombre', p.cedula_juridica='$cedula', p.telefono='$telefono', p.correo='$correo' 
        where p.id_proveedor='$id_proveedor';";
        $this->execute($sql);
    }
    }
?>