<?php

require_once('db/db_usuario.php');


class ln_usuarios
{

    var $db;

    function __construct()
    {

        $this->db = new db_usuario();
    }

    function insert_user($data)
    {

        return $this->db->insert_usuario($data);
    }

    function get_usuario_cambio($data, $codigo)
    {

        return $this->db->get_usuario_cambio($data, $codigo);
    }

    function get_usuario($correo)
    {

        return $this->db->get_usuario($correo);
    }




    function get_login($data)
    {

        return $this->db->get_login($data);
    }

    function get_ultimo_usuario()
    {

        return $this->db->get_ultimo_usuario();
    }

    function validar_codigo($codigo, $id)
    {


        return $this->db->validar_codigo($codigo, $id);
    }

    function cambio_contrasena($data)
    {

        return $this->db->cambio_contrasena($data);
    }

    function update_usuario($codigo, $id)
    {

        return $this->db->update_usuario($codigo, $id);
    }

    function  update_estado_cambio_negativo($id)
    {

        $this->db->update_estado_cambio_negativo($id);
    }
}
