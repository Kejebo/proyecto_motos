<?php

require_once('conexion.php');

class db_client extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_client($data){
        extract($data);
        
        $sql = "call insert_clientes('$cedula','$nombre','$correo','$telefono','$clave')";
        $result = $this->execute($sql);
        return $result;
    }

    

    function get_clients(){
        $sql = "select * from clientes;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function delete_client($id){
        $sql= "delete from clientes where id_cliente='$id'";
        $this->execute($sql);
    }
    function get_client($id){
        $sql = "select * from clientes where id_cliente='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function update_client($data){
        extract($data);
        $sql="update clientes c set c.nombre_cliente='$nombre', c.cedula_juridica='$cedula', c.telefono='$telefono', c.correo='$correo' 
        ,c.clave='$clave' where c.id_cliente='$id_cliente';";
        $this->execute($sql);
    }
    }
?>