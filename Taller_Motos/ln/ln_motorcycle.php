<?php
    require_once('db/db_motorcycle.php');

    class ln_motorcycle{
        var $db;

        function __construct()
        {
            $this->db= new db_motorcycle;
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->insert_moto($_POST);
                        $this->redireccion();
                    break;
                    case 'update':
                        $this->update_moto($_POST);
                     //   $this->redireccion();
                    break;
                    case 'delete':
                        $this->db->delete($_GET['id']);
                        $this->redireccion();
                    break;
                }
            }
        }
        function insert_moto($data){
            $this->db->insert_motorcycle($data);
        }
        function get_motos(){
            return $this->db->get_motos();
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
        function update_moto($data){
            $this->db->update_moto($data);
        }
        function redireccion(){
            header('Location: motorcycle.php');
        }
    }
?>