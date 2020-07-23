<?php
    require_once('db/db_sales.php');
    require_once('ln_client.php');
    require_once('ln_inventory.php');

    class ln_sales{

        var $db;
        var $inventory;
        var $client;
        function __construct()
        {
            $this->db= new db_sales();
            $this->inventory= new ln_inventory();
            $this->client= new ln_client();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                    $this->insert_sale($_POST);
                    $this->rediretion();

                    break;
                    case 'delete':
                        $this->delete_detail($_GET['id']);

                    break;
                    case 'update':
                       $this->update_sale($_POST);
                        $this->rediretion();
                }
            }
        }

        function update_sale($data){
            $this->db->update_sale($data);

            extract($data);
            $this->db->delete_detail($id);
            foreach($detalles as $lista){
              $list=json_decode($lista,true);
                $this->db->insert_detail_sale($id, $list);
            }
        }
        function insert_sale($data){
            extract($data);
           $this->db->insert_sale($data);
           foreach($detalles as $lista){
             $list=json_decode($lista,true);
               $this->db->insert_detail_sale($this->db->get_last_sale(),$list);
           }
        }

        function get_sales(){
            return $this->db->get_sales();
        }
        function get_sale($id){
            return $this->db->get_sale($id);
        }

        function delete_detail($id){
            $this->db->delete_detail($id);
            $this->db->delete_sale($id);
            $this->rediretion();
       }
       function get_inventory($id=null){
           return $this->inventory->get_inventory();
       }
       function get_client(){
           return $this->client->get_clients();
       }
       function rediretion(){
           header("Location: sales.php");
       }
    }
