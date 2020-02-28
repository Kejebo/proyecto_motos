<?php
    require_once('db/db_proveedor.php');
    class ln_proveedor{
        var $db;

        function __construct()
        {
            $this->db= new db_proveedor();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->insert_proveedor($_POST);
                        header('Location: proveedores.php');

                    break;
                    
                    case 'update':
                        $this->update($_POST);
                        header('Location: proveedores.php');
                    break;
                    

                    case 'delete':
                        $this->delete_proveedor($_GET['id']);
                        header('Location: proveedores.php');
                    break;
                    }
            }
        }
        function insert_proveedor($data){
            $this->db->insert_proveedor($data);
            
        }
        function get_proveedores(){
            return $this->db->get_proveedores();
        }
        function get_proveedor($id){
           return $this->db->get_proveedor($id);
        }
        function delete_proveedor($id){
            $this->db->delete_proveedor($id);
        }
        function update($data){
            $this->db->update_proveedor($data);
        }
    }
?>