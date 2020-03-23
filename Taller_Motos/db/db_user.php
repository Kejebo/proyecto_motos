<?php

require_once('conexion.php');

class db_user extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_user($data){
        extract($data);
        
        $sql = "insert into usuarios(nombre_completo,clave) values('$nombre','$clave')";
        $result = $this->execute($sql);
        return $result;
    }

    

    function get_users(){
        $sql = "select * from usuarios;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function delete_user($id){
        $sql= "delete from usuarios where id_usuario='$id'";
        $this->execute($sql);
    }
    function get_user($id){
        $sql = "select * from usuarios where id_usuario='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function update_user($data){
        extract($data);
        $sql="update usuarios u set u.nombre_completo='$nombre', u.clave='$clave' where u.id_usuario='$id_usuario';";
        $this->execute($sql);
    }
    }
?>