<?php
    require_once('db/db_inventory.php');

    class ln_inventory{

        var $db;

        function __construct()
        {
            $this->db= new db_inventory();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->db->insert_inventory($_POST);
                        $this->rediretion();
                    break;
                    case 'delete':
                        $this->delete_material($_GET['id']);
                }
            }
        }


        function get_category(){
            return $this->db->get_category();
        }
        function get_marcas(){
            return $this->db->get_marcas();
        }
        function get_medidas(){
            return $this->db->get_medidas();
        }
        function get_inventory(){
            return $this->db->get_inventory();

        }
        function delete_material($id){
            $this->db->delete_material($id);
            $this->rediretion();
       }
       function get_material($id){
           return $this->db->get_material($id);
       }
       function rediretion(){
           header('location:inventary.php');
       }
    }
