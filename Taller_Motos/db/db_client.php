<?php

require_once('conexion.php');
require_once('db_usuario.php');

class db_client extends conexion{


    var $db_usuario;

    function __construct()
    {
      $this->db_usuario = new db_usuario();
      parent::__construct();  
    }

    function insert_client($data){
        extract($data);

        $array = array(
            'nombre' => $nombre,
            'correo' => $correo,
            'tipo' => 'cliente',
            'clave' => $clave
        );
      
        $this->conectar();
        $sql = "call insert_clientes('$cedula','$nombre','$correo','$telefono','$clave')";
        $result = $this->executeDos($sql);
        
        if ($result > 0) {

            $this->db_usuario->insert_usuario($array);
            return true;
        } else {

            return false;
        }
        $this->desconectar();
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
    function delete_client($id){
        $sql= "delete from clientes where id_cliente='$id'";
        $this->execute($sql);
    }
    function get_client($id){
        $sql = "select * from clientes where id_cliente='$id';";
        $result = $this->get_data($sql);
            if($result){
                return $result[0];
            }else{
        return false;
            }
    }
    function update_client($data){
        extract($data);
        echo $id_cliente;
        $sql="update clientes c set c.nombre_cliente='$nombre', c.cedula_juridica='$cedula', c.telefono='$telefono', c.correo='$correo' 
        ,c.clave='$clave' where c.id_cliente='$id_cliente';";
        $this->execute($sql);
    }
    }
