<?php 

require_once('db/db_usuario.php');


class ln_usuarios{

    var $db;

    function __construct(){

        $this->db = new db_usuario();

    }

    function insert_user($data){

        return $this->db->insert_usuario($data);

    }

    function get_login($data){

        return $this->db->get_login($data);

    }

    function get_ultimo_usuario(){

        return $this->db->get_ultimo_usuario();

    }

}

?>