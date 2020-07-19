<?php
require_once('conexion.php');

    class db_motorcycle extends conexion{

        function insert_motorcycle($data){
            extract($data);
            $this->execute("call insert_motos('$cliente','$marca','$modelo','$transmision','$cilindraje','$chasis','$placa','$kilometraje','$combustible')");
        }

        function insert_transmision($data){

            $this->execute("call insert_transmisiones('$data')");
        }

        function insert_cilindraje($data){
            $this->execute("call insert_cilindrajes('$data')");
        }

        function insert_marca($data){
            $this->execute("call insert_marcas_motos('$data')");
        }
        function insert_modelo($data){
            extract($data);
            $this->execute("call insert_modelos_motos('$nombre_modelo','$ano')");
        }
        function insert_combustible($data){
            $this->execute("insert into combustible(tipo_combustible) values('$data')");
        }
        function get_motos(){
            $sql = "call get_motos_activas";
            $result = $this->get_data($sql);
                if($result){
                    return $result;
                }else{
            return false;
                }
        }
        function get_motos_client($id)
        {
            $sql = "call get_motos_cliente('$id')";
            $result = $this->get_data($sql);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
        function update_moto($data){
            extract($data);
           $result= $this->execute("call update_motos('$cliente','$marca','$modelo','$transmision','$cilindraje','$chasis','$placa','$kilometraje','$combustible','$id');");
        }
        function get_moto($id){
            return $this->get_data("call get_moto('$id')")[0];

        }
        function delete($id){
            $this->execute("update motos set estado_moto=false where id_moto=$id");
        }
        function get_cilindrajes(){
            return $this->get_data('select * from cilindrajes order by tamano_cilindraje asc');
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
