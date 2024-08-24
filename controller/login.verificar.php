<?php

session_start();

require '../model/config.php';

// Comprueba si se han enviado datos por POST (formulario se ha enviado).
if(!empty($_POST['email']) && !empty($_POST['contrasena'])){
    // Obtiene el valor de los campos de correo electrónico y contraseña.
    $email = $_POST['email'];
    $clave = $_POST['contrasena'];
    $clave = hash('sha512', $clave); // Encripta la contraseña usando el algoritmo SHA-512.

    $cone = new Conexion();
    $conexion= $cone->conectar('hemohearth');

    $sql = "SELECT * FROM pacientes p INNER JOIN roles_usuario r ON id = r.id_usuario WHERE email = '$email' AND clave = '$clave'";
    $consulta = $cone->ejecutar($conexion, $sql);
    // Obtiene la primera fila de resultados como un arreglo asociativo.
    $filas=mysqli_fetch_assoc($consulta);
    // Comprueba si se encontraron resultados en la consulta.
    if(mysqli_num_rows($consulta) > 0){
        $_SESSION['rol'] = $filas['id_rol'];
        $_SESSION['id_persona'] = $filas['id'];
        // Comprueba el rol del usuario y redirige según el rol.
        if ($_SESSION['rol'] == 1) {
            header("Location: ../views/admin/panel.php");
        }else {
            header("Location: ../views/user/usuario.php");
        }         
    }else{
        $_SESSION['mensaje'] = "Correo y/o contraseña incorrecta.";
        $_SESSION['alert_type'] = "danger";
        header("Location: ../views/login.php");
    }
}else {
    $_SESSION['mensaje'] = "Completa todos los campos.";
    $_SESSION['alert_type'] = "warning";
    header("Location: ../views/login.php");
}

?>