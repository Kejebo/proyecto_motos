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
                    }
            }
        }

        
        function get_repairs(){
          return $this->db->get_repairs();
        }
        function get_works(){
          return $this->db->get_works();
        }
    }
?>
