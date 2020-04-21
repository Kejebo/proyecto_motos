<?php

require_once('conexion.php');

class db_workshop extends conexion{


    function __construct()
    {
      parent::__construct();
    }


    function insert_work($data){
        extract($data);

        $sql = "insert into trabajos(nombre_trabajo,precio) values('$nombre','$precio')";
        $result = $this->execute($sql);
        return $result;
    }



    function get_works(){
        $sql = "select * from trabajos;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    function get_inventory()
    {
        $sql = "call get_inventario()";
        $result = $this->get_data($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

  function insert_repair($data){
    extract($data);
    $this->execute("insert into reparaciones(id_moto,fecha_entrada) values('$moto','$fecha')");
  }
  function insert_material($data,$id){
    extract($data);
    $this->execute("insert_into detalle_reparacion(id_reparacion,id_material,cantidad) values('$id','$id_material','$cantidad')");
  }
  function get_last_id(){
    return $this->get_data("select max(id_reparacion) as id from reparaciones")[0];
  }
  function get_repairs(){
    $sql = "call get_reparaciones();";
    $result = $this->get_data($sql);
        if($result){
            return $result;
        }else{
    return false;
        }
}
    function get_clients(){
        $sql = "select * from clientes;";
        $result = $this->get_data($sql);
            if($result){
                return $result;
            }else{
        return false;
            }
    }
    }
?>
