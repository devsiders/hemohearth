<?php

session_start();

require '../model/config.php';

if(!empty($_POST['email']) && !empty($_POST['contrasena'])){

    $email = $_POST['email'];
    $clave = $_POST['contrasena'];
    $clave = hash('sha512', $clave);

    $cone = new Conexion();
    $conexion= $cone->conectar('hemohearth');

    $sql = "SELECT * FROM pacientes p INNER JOIN roles_usuario r ON id = r.id_usuario WHERE email = '$email' AND clave = '$clave'";
    $consulta = $cone->ejecutar($conexion, $sql);

    $filas=mysqli_fetch_assoc($consulta);

    if(mysqli_num_rows($consulta) > 0){
        $_SESSION['rol'] = $filas['id_rol'];
        $_SESSION['id_persona'] = $filas['id'];
        if ($_SESSION['rol'] == 1) {
            $_SESSION['mensaje'] = "Inicio de sesión exitosamente.";
            $_SESSION['alert_type'] = "success";
            header("Location: ../views/admin.php");
        }else {
            $_SESSION['mensaje'] = "Inicio de sesión exitosamente.";
            $_SESSION['alert_type'] = "success";
            header("Location: ../views/usuario.php");
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
    exit;
}

?>