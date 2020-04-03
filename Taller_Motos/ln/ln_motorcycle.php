<?php
    require_once('db/db_motorcycle.php');

    class ln_motorcycle{
        var $db;

        function __construct()
        {
            $this->db= new db_motorcycle;
        }

        function insert($data){

        }
        function get_marcas(){
            return $this->db->get_marcas();
        }
        function get_modelos(){
            return $this->db->get_modelos();
        }
        function get_clientes(){
            return $this->db->get_clientes();
        }
        function get_transmision(){
            return $this->db->get_transmisiones();
        }
        function get_cilindraje(){
            return $this->db->get_cilindrajes();
        }
        function get_combustible(){
            return $this->db->get_combustible();
        }
    }
?>