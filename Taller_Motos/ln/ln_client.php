<?php
    require_once('db/db_client.php');
    require_once('db/db_user.php');
    class ln_client{
        var $db;
        var $user;
        function __construct()
        {
            $this->db= new db_client();
            $this->user= new db_user();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->insert_client($_POST);
                        header('Location: clients.php');

                    break;
                    
                    case 'insert_client_user':
                        $this->insert_client($_POST);
                        $this->user->insert_user($_POST);
                        header('Location: clients.php');
                    break;
                    
                    case 'update':
                        $this->update_client($_POST);
                        header('Location: clients.php');
                    break;
                    

                    case 'delete':
                        $this->delete_client($_GET['id']);
                        header('Location: clients.php');
                    break;
                    }
            }
        }
        function insert_client($data){
            $this->db->insert_client($data);
            
        }
        function get_clients(){
            return $this->db->get_clients();
        }
        function get_client($id){
           return $this->db->get_client($id);
        }
        function delete_client($id){
            $this->db->delete_client($id);
        }
        function update_client($data){
            $this->db->update_client($data);
        }
    }
?>