<?php

require_once('conexion.php');

class db_sales extends conexion{


    function __construct()
    {
      parent::__construct();
    }


    function insert_sale($data){
        extract($data);

        $sql = "call insert_venta('$cliente','3','$fecha')";
        $result = $this->execute($sql);
        return $result;
    }
    function get_sales(){
        $sql = "call get_ventas()";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_sales_diario($fecha){
        $sql = "call get_ventas_diarias('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_sales_mensual($fecha){
        $sql = "call get_ventas_mensual('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }

    function get_sales_periodo($inicio,$final){
        $sql = "call get_ventas_periodo('$inicio','$final')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }

    function get_sales_anual($fecha){
        $sql = "call get_ventas_anual('$fecha')";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function delete_sale($id){
        $sql= "delete from ventas where id_venta='$id'";
        $this->execute($sql);
    }
    function get_sale($id){
        $sql = "call get_venta('$id');";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_detail_sale($id){
        $sql = "call get_detalle_venta('$id');";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function update_sale($data){
        extract($data);
        $this->execute("call update_venta('$id','$cliente','$fecha')");
    }
    function get_last_sale(){
        $sql = "select * from ventas
        order by id_venta desc
        limit 1";
        $result = $this->get_data($sql);
        return $result[0]['id_venta'];
    }
    function insert_detail_sale($id,$data){
        extract($data);
        $this->execute("call insert_venta_material('$id','$material','$cantidad','$precio');");
    }
    function delete_detail($id){
        $this->execute("delete from ventas_materiales where id_venta='$id'");
    }
    }
?>
