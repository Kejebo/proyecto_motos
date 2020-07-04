<?php
require_once('conexion.php');


class db_usuario extends conexion
{


    function __construct()
    {
        parent::__construct();
    }

    function get_login($data)
    {

        extract($data);

        $this->conectar();

        mysqli_set_charset($this->conexion, 'utf8');
        $us = mysqli_real_escape_string($this->conexion, $correo_electronico);
        $pass = mysqli_real_escape_string($this->conexion, $contrasena);

        $sql = "call get_usuario('$us','$pass')";

        $result = $this->get_data($sql);

        if ($result) {

            return $result[0];
        } else {

            return false;
        }
    }


    function update_usuario($codigo, $id)
    {

        $this->conectar();
        $sql = "call update_codigo_usuario('$codigo','$id')";
        $result = $this->executeDos($sql);
        return $result;
        $this->desconectar();
    }

    function update_estado_cambio($id)
    {


        $sql = "call update_estado_cambio('$id')";
        $result = $this->executeDos($sql);
    }

    function update_estado_cambio_negativo($id)
    {

        $sql = "call update_estado_cambio_negativo('$id')";
        $this->execute($sql);
    }

    function cambio_contrasena($data)
    {
        extract($data);

        $this->conectar();
        $sql = "call update_codigo_contrasena('$contrasenaUno','$id')";
        $result = $this->executeDos($sql);

        if ($result > 0) {

            $this->update_estado_cambio_negativo($id);
            return true;
        } else {

            return false;
        }

        $this->desconectar();
    }


    function insert_usuario($data)
    {
        $this->conectar();
        extract($data);
        $sql = "call insert_usuarios('$nombre','$correo','$tipo','$clave')";
        $result = $this->execute($sql);
        return $result;
        $this->desconectar();
    }

    function get_ultimo_usuario()
    {
        $sql = "call get_ultimo_usuario()";
        $result = $this->get_data($sql);
        return $result[0];
    }


    function get_usuario_cambio($data, $codigo)
    {

        extract($data);

        $cod = $codigo[0] . $codigo[1] . $codigo[2];


        $sql = "call get_usuario_cambio('$correo_electronico_link')";

        $result = $this->get_data($sql);

        if ($result) {

            $this->update_usuario($cod, $result[0]['id_usuario']);
            return $result[0]['id_usuario'];
        } else {
            return false;
        }
    }

    function validar_codigo($codigo, $id)
    {


        $sql = "call validar_codigo($codigo,$id)";

        $result = $this->get_data($sql);
        if ($result) {

            $this->update_estado_cambio($id);

            return true;
        } else {

            return false;
        }
    }
}
