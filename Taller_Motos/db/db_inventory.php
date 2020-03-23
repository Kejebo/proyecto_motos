<?php

require_once('conexion.php');

class db_inventory extends conexion{


    function __construct()
    {
      parent::__construct();  
    }


    function insert_inventory($data){
        extract($data);

        $sql = "call insert_canal('$name','$category','$digital','$destino')";
        $result = $this->execute($sql);
        return $result;
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
    
    function get_category(){
        $sql = "select * from categorias_material;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }

}

?>