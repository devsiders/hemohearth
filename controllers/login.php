<?php

require_once '../models/login.php';

class LoginController {
    private $loginModel;

    public function __construct() {
        $this->loginModel = new Login();
    }

    public function Autentificar($email = null, $clave = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $clave = $_POST['contrasena'] ?? '';

            $login = $this->loginModel->iniciarSesion($email, $clave);

            if ($login) {
                session_start();
                $_SESSION['rol'] = $login['id_rol'];
                $_SESSION['nombre'] = $login['nombre'];
                $_SESSION['id_persona'] = $login['id'];
                // Comprueba el rol del usuario y redirige según el rol.
                if ($_SESSION['rol'] == 1) {
                    header("Location: ../views/admin/index.php");
                } else {
                    header("Location: ../views/perfil/index.php");
                }
            } else {
                session_start();
                $_SESSION['error'] = "Correo y/o contraseña incorrecta.";
                header("Location: ../views/auth/login.php");
                exit();
            }

        } else {
            header("Location: ../views/auth/login.php");
            exit();
        }
        
        
    }
}

$controller = new LoginController();
$controller->Autentificar();

?>