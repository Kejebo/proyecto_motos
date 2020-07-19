<?php

require_once('conexion.php');

class db_user extends conexion
{


    function __construct()
    {
        parent::__construct();
    }


    function insert_user($data)
    {
        extract($data);
        $sql = "insert into usuarios(nombre_completo,correo_electronico,tipo,clave) values('$nombre','$correo','$tipo','$clave')";
        $result = $this->execute($sql);
        return $result;
    }



    function get_users()
    {
        $sql = "select * from usuarios;";
        $result = $this->get_data($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    function delete_user($id)
    {
        $sql = "delete from usuarios where id_usuario='$id';";
        $this->execute($sql);
    }
    function get_user($id)
    {
        $sql = "select * from usuarios where id_usuario='$id';";
        $result = $this->get_data($sql);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }
    function get_user_correo($correo)
    {
        $sql = "select * from usuarios where correo_electronico='$correo';";
        $result = $this->get_data($sql);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }
    function update_user($data)
    {
        extract($data);
        if ($tipo == 'cliente') {
            $sql = "update usuarios u set u.nombre_completo='$nombre', u.clave='$clave', u.correo_electronico='$correo', u.tipo='$tipo' where u.id_usuario='$id_usuario';";
            $this->execute($sql);
        } else {
            $sql = "update usuarios u set u.nombre_completo='$nombre', u.clave='$clave', u.correo_electronico='$correo', u.tipo='$tipo' where u.id_usuario='$id_usuario';";
            $this->execute($sql);
        }
    }
}
