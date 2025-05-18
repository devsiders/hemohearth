<?php

require_once '../config/db.php';

class Login{
    private $conne;

    public function __construct(){
        $bd = new Conexion();
        $this->conne =  $bd->conectar();
    }

    public function iniciarSesion($email, $clave){

        $sql = "SELECT * FROM pacientes p INNER JOIN roles_usuario r ON id = r.id_usuario WHERE email = ?";
        $stmt = $this->conne->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Inicio de sesión exitoso
            $usuario = $resultado->fetch_assoc();
            if (password_verify($clave, $usuario['clave'])) {
                return $usuario;
            }
        } else {
            // Credenciales inválidas
            return false;
        }
    }
}

?>

