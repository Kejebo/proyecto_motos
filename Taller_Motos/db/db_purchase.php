<?php

require_once('conexion.php');

class db_purchase extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_purchase($data){
        extract($data);
        
        $sql = "call insert_compra('$proveedor','3','$factura')";
        $result = $this->execute($sql);
        return $result;
    }
    function get_purchases(){
        $sql = "select * from compras;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function delete_purchase($id){
        $sql= "delete from compras where id_compra='$id'";
        $this->execute($sql);
    }
    function get_purchase($id){
        $sql = "select * from compras where id_compra='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function update_purchase($data){
        extract($data);
        $this->execute($sql);
    }
    function get_last_pucharse(){
        $sql = "select max(id_compra) as id from compras;";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function insert_detail_purchase($id,$data){
        extract($data);
        $this->execute("call insert_compra_material('$id','$material','$precio','$cantidad');");
    }
    function delete_detail($id){
        $this->execute("delete from compras_materiales where id_compra='$id'");
    }   
    }
?>