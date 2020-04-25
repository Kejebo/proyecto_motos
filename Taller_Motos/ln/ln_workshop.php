<?php
    include 'db/db_client.php';
    require_once('db/db_workshop.php');

    class ln_workshop{
        var $db;
        function __construct()
        {
            $this->db= new db_workshop();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                  case 'delete':
                    $this->delete($_GET['id']);
                    break;
                    case 'insert':
                      $this->insert($_POST);
                      header('Location: repairs.php');
                    break;
                  }
            }
        }

        function delete($id){
          $this->db->delete_work($id);
        }
        function get_repair($id){
          return $this->db->get_repair($id);
        }
        function get_repairs(){
          return $this->db->get_repairs();
        }
        function insert($data){
          $this->db->close_work($data);
        }
        function get_works(){
          return $this->db->get_works();
        }
    }
?>
