<?php

class Conexion{
	public $servidor="localhost";
    public $usuario="root";
    public $contraseña="";
    
	public function conectar($bd){
		$cnx = new mysqli($this->servidor,$this->usuario,$this->contraseña,$bd);
		return $cnx;
	}

	public function ejecutar($conexion,$sentencia){
       $resultado=$conexion->query($sentencia);
       return $resultado;
	}

	public function desconectar($conexion){
       $conexion->close();
	}
}

?>

