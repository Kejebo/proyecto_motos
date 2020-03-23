<?php
    require_once('db/db_user.php');
    class ln_user{
        var $db;

        function __construct()
        {
            $this->db= new db_user();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->insert_user($_POST);
                        header('Location: users.php');

                    break;
                    
                    case 'update':
                        $this->update_user($_POST);
                        header('Location: users.php');
                    break;
                    

                    case 'delete':
                        $this->delete_user($_GET['id']);
                        header('Location: users.php');
                    break;
            }
        }
    }
        function insert_user($data){
            $this->db->insert_user($data);
            
        }
        function get_users(){
            return $this->db->get_users();
        }
        function get_user($id){
           return $this->db->get_user($id);
        }
        function delete_user($id){
            $this->db->delete_user($id);
        }
        function update_user($data){
            $this->db->update_user($data);
        }
    }
?>