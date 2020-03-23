<?php
    require_once('db/db_inventory.php');

    class ln_inventory{

        var $db;

        function __construct()
        {
            $this->db= new db_inventory();
        }


        function get_category(){
            return $this->db->get_category();
        }

        
    }

?>