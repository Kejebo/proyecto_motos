<?php

class conexion{
	
	var $config;
	var $conexion;
	
	function __construct(){
		
		$this->config = array(
			'host' 	=> 'localhost',
			'user' 	=> 'root',
			'pass' 	=> '',
			'db' 	=> 'db_mighty_motors',
		);
	
	}
	
	
	function conectar(){
		
		extract($this->config);
		
		$this->conexion = mysqli_connect($host, $user, $pass, $db) or die ('No se pudo conectar');
		
	}
	
	
	function desconectar(){
		mysqli_close($this->conexion);
	}
	
	
	
	function execute($sql){
		
		$this->conectar();
		$result = mysqli_query($this->conexion, $sql);
		
		$r = array(
			'result'	=> $result,
			'error'		=> mysqli_error($this->conexion),
		);
		
		$this->desconectar();
		
		return $r;
		
	}
	
	
	
	function get_data($sql){
		
		$result = $this->execute($sql);
		
		$data = array();
		
		if($result['result']){
			
			while($row = mysqli_fetch_array($result['result'])){
				$data[] = $row;
			}
			
		}
		
		return $data;
		
	}
	
	
}

?>