<?php

require_once('conexion.php');

class db_purchase extends conexion{


    function __construct()
    {
      parent::__construct();
    }


    function insert_purchase($data){
        extract($data);
        $usuario=json_decode($_COOKIE['usuario'],true)['id_usuario'];
        $sql = "call insert_compra('$proveedor','$usuario','$factura','$fecha')";
        $result = $this->execute($sql);
        return $result;
    }
    function get_purchases(){
        $sql = "call get_compras();";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }

    function get_purchases_diario($fecha){
        $sql = "call get_compra_diaria('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_purchases_mensual($fecha){
        $sql = "call get_compra_mensual('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }

    function get_purchases_anual($fecha){
        $sql = "call get_compra_anual('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_purcharses_periodo($inicio,$final){
        $sql = "call get_compras_periodo('$inicio','$final')";
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
        $sql = "call get_compra('$id');";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_detail_purchase($id){
        $sql = "call get_detalle_compra('$id');";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function update_purchase($data){
        extract($data);
        $usuario=json_decode($_COOKIE['usuario'],true)['id_usuario'];

        $this->execute("call update_compra('$id','$proveedor','$factura','$fecha','$usuario')");
    }
    function get_last_pucharse(){
        $sql = "select * from compras
        order by id_compra desc
        limit 1";
        $result = $this->get_data($sql);
        return $result[0]['id_compra'];
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
