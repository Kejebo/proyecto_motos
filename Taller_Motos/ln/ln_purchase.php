<?php
    require_once('db/db_purchase.php');
    require_once('ln_proveedor.php');
    require_once('ln_inventory.php');

    class ln_purchase{

        var $db;
        var $inventory;
        var $proveedor;
        function __construct()
        {
            $this->db= new db_purchase();
            $this->inventory= new ln_inventory();
            $this->proveedor= new ln_proveedor();
        }

        function action_controller(){
            if(isset($_GET['action'])){
                switch($_GET['action']){
                    case 'insert':
                      print_r($this->insert_purchase($_POST));
                        $this->rediretion();
                    break;
                    case 'delete':
                        $this->delete_detail($_GET['id']);

                    break;
                    case 'update':
                    $this->update_purchase($_POST);
                      $this->rediretion();
                }
            }
        }

        function update_purchase($data){
            extract($data);
            $this->db->delete_detail($id);
            $this->db->update_purchase($data);
            foreach($detalles as $lista){
              $list=json_decode($lista,true);
                $this->db->insert_detail_purchase($id,$list);
            }
        }
        function insert_purchase($data){
           $this->db->insert_purchase($data);
           extract($data);
           foreach($detalles as $lista){
             $list=json_decode($lista,true);
             $this->db->insert_detail_purchase($this->db->get_last_pucharse(),$list);
           }
        }

        function get_purchases(){
            return $this->db->get_purchases();
        }
        function get_purchase($id){
            return $this->db->get_purchase($id);
        }

        function delete_detail($id){
            $this->db->delete_detail($id);
            $this->db->delete_purchase($id);
            $this->rediretion();
       }
       function get_inventory($id=null){
           return $this->inventory->get_inventory();
       }
       function get_proveedor(){
           return $this->proveedor->get_proveedores();
       }
       function rediretion(){
           header("Location: purchases.php");
       }
    }
