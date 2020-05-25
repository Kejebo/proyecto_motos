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

  function update_repair($data){
    extract($data);
    $this->execute("call update_reparacion('$id''$motos','$entrada',$kilometraje)");
    $this->execute("update motos set kilometraje='$kilometraje' where id_moto='$motos';");
  }

  function insert_repair($data){
    extract($data);
    $this->execute("insert into reparaciones(id_moto,fecha_entrada,kilometraje_entrada,fecha_salida,descripcion,precio,
    kilometraje_salida,estado) values('$motos','$entrada','$kilometraje','$entrega','$descripcion','$precio','$k_actual','$estado')");
    $this->execute("update motos set kilometraje='$kilometraje' where id_moto='$motos';");
  }
  function insert_material($data,$id){
    extract($data);
    $this->execute("insert into detalle_reparacion(id_reparacion,id_material,cantidad) values('$id','$id_material','$cantidad')");

  }

  function close_work($data){
    extract($data);
    $this->execute("update reparaciones set fecha_salida='$entrega', descripcion='$descripcion'
    ,precio='$precio',kilometraje_salida='$k_actual',estado='Finalizado'
    where id_reparacion='$id';");
    $this->execute("update motos set kilometraje='$k_actual', nuevo_kilometraje='$k_proximo' where id_moto='$id_moto'");
  }

  function update_work($data){
    extract($data);
   $this->execute("update reparaciones set fecha_entrada='$entrada', id_moto='$motos', kilometraje_entrada='$kilometraje',fecha_salida='$entrega', descripcion='$descripcion'
    ,precio='$precio',kilometraje_salida='$k_actual',estado='$estado'
    where id_reparacion='$id';");
    $this->execute("update motos set kilometraje='$k_actual', nuevo_kilometraje='$k_proximo' where id_moto='$motos'");
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
