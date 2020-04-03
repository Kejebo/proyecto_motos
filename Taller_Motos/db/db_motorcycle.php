<?php
require_once('conexion.php');

    class db_motorcycle extends conexion{

        function insert_motorcycle($data){
            extract($data);
            $this->execute("call insert_motos('$cliente','$marca','$modelo','$transmision','$cilindraje'
            ,'$chasis','$placa','$kilometraje','$combustible')");
        }

        function insert_transmision($data){
            $this->execute("call insert_transmision('$data')");
        }
        
        function insert_cilindraje($data){
            $this->execute("call insert_cilindrajes('$data')");
        }

        function insert_marca($data){
            $this->execute("call insert_marcas_motos('$data')");
        }
        function insert_modelo($data){
            extract($data);
            $this->execute("call insert_modelo_motos('$nombre_marca',$ano)");
        }
        function insert_combustible($data){
            extract($data);
            $this->execute("insert into combustibles(tipo_combustible) values('$combustible)");
        }
        function get_cilindrajes(){
            return $this->get_data('select * from cilindrajes');
        }
        function get_transmisiones(){
            return $this->get_data('select * from transmisiones order by nombre_transmision asc');
        }
        function get_modelos(){
            return $this->get_data('select * from modelos_motos order by nombre_modelo asc');
        }
        function get_marcas(){
            return $this->get_data('select * from marcas_motos order by nombre_marca asc');
        }
        function get_clientes(){
            return $this->get_data("select * from clientes where estado_cliente=1 order by nombre_cliente asc");
        }
        function get_combustible(){
            return $this->get_data("select * from combustible order by tipo_combustible asc");
        }
    }
?>