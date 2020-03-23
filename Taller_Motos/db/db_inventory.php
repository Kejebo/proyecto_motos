<?php

require_once('conexion.php');

class db_inventory extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_inventory($data){
        extract($data);
        if(!isset($presentacion)){
            $presentacion=0;
        }
        $sql = "call insert_material('$nombre','$marca','$categoria','$cantidad
        ','$presentacion','$precio_compra','$precio_venta','$cant_minima');";
        $result = $this->execute($sql);
        return $result;
    }

    

    function get_category(){
        $sql = "select * from categorias_material;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_inventory(){
        $sql = "call get_inventario()";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_category_medida($id){
        $sql = "select * from categorias_material c 
        inner join medidas m on m.id_medida=c.id_medida where id_categoria='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_marcas(){
        $sql = "select * from marcas_materiales;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_medidas(){
        $sql = "select * from medidas;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    
    function delete_material($id){
        $this->execute("update materiales set estado=0 where id_material='$id'");
    }
}

?>