<?php

class Conexion{
	private $servidor = "localhost";
    private $usuario = "root";
    private $contraseña = "";
	private $bd = "hemohearth";
	public $conne;
    
	public function conectar(){
		$this->conne = new mysqli($this->servidor,$this->usuario,$this->contraseña,$this->bd);
		if ($this->conne->connect_error) {
			die("Error de conexión: " . $this->conne->connect_error);
		}
		
		return $this->conne;
		
	}


	public function desconectar(){
       $this->conne->close();
	}
}

?>

