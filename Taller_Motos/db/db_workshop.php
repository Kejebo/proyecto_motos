<?php

require_once('conexion.php');

class db_workshop extends conexion{


    function __construct()
    {
      parent::__construct();
    }


    function insert_work_detail($data,$id){
      extract($data);
      $this->execute("insert into detalle_trabajo(id_reparacion,id_trabajo) values('$id','$id_trabajo')");
    }

    function delete_work($id){
      $this->delete_works($id);
      $this->delete_materialwork($id);
      $this->execute("delete from reparaciones where id_reparacion='$id'");

    }
    function delete_materialwork($id){
      $this->execute("delete from detalle_trabajo where id_reparacion='$id'");
    }
    function delete_works($id){
      $this->execute("delete from detalle_reparacion where id_reparacion='$id'");
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
    function get_repair($id){
      return $this->get_data("call get_reparacion('$id')")[0];
    }
    function get_repair_details($id){
      return $this->get_data("call get_detalle_reparacion('$id')");
    }

    function get_work_details($id){
      return $this->get_data("call get_detalle_trabajo('$id')");
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
    $this->execute("insert into detalle_reparacion(id_reparacion,id_material,cantidad) values('$id','$id_material','$cantidad')");
  }


  function get_last_id(){
    return $this->get_data("select max(id_reparacion) as id from reparaciones")[0]['id'];
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
