<?php
    require_once('db/db_admin.php');
    class ln_admin{
        var $db;
        function __construct()
        {
            $this->db= new db_admin();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                        $this->insert_admin($_POST);
                        header('Location: admin.php');

                    break;
                                        
                    case 'update':
                        $this->update_admin($_POST);
                        header('Location: admin.php?id='.$_POST['id_empresa']);
                    break;
           
                    }
            }
        }
        function insert_admin($data){
            $this->db->insert_admin($data);
            
        }
      
    
        function update_admin($data){
            $this->db->update_admin($data);
        }
    }
?>