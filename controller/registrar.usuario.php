<?php

require '../model/datos.php';

$cone = new Conexion();
// Comprueba si se han enviado datos por POST (formulario se ha enviado).
if (!empty($_POST['nombre']) && !empty($_POST['apellido'])) {
    // Obtiene los valores enviados por POST y los asigna a variables.
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $td = $_POST['td'];
    $docu = $_POST['documento'];
    $eps = $_POST['eps'];
    $email = $_POST['correo'];
    $clave = $_POST['clave'];
    $sintoma = $_POST['sint'] ? $_POST['sint'] : null;
    $idS = null;
    // Si se seleccionó un síntoma, se intenta obtener su ID.
    if ($sintoma !== null) {
        $tabla = 'patologias';
        $idS = traerId($tabla, $sintoma);
    }

    $clave = hash('sha512', $clave); // Encripta la contraseña usando el algoritmo SHA-512.

    $conexion = $cone->conectar('hemohearth');
    $sql = "INSERT INTO pacientes (nombre, apellido, tipo_documento, documento, eps, email, clave)  VALUES('$nombre', '$apellido', '$td', '$docu', '$eps', '$email', '$clave')";

    $consulta = $cone->ejecutar($conexion, $sql);
    // Obtiene el ID insertado en la última inserción.
    $traerId = mysqli_insert_id($conexion);
    $sql3 = "INSERT INTO roles_usuario (id_usuario,id_rol)  VALUES('$traerId',2)";

    $consulta2 = $cone->ejecutar($conexion, $sql3);
    // Comprueba si las consultas se ejecutaron correctamente.
    if ($consulta && $consulta2) {
        $_SESSION['mensaje'] = "Registrado con éxito.";
        $_SESSION['alert_type'] = "success";
        header("Location: ../views/login.php");
    } elseif ($idS !== null) { // Si se proporcionó un síntoma válido, se intenta insertar'.
        $id = traerId('pacientes', $email, 'email');
        $traerID = mysqli_insert_id($conexion);
        $sql2 = "INSERT INTO pacientes_patologias (id_paciente,id_patologia)  VALUES('$traerID','$idS')";
        $consulta1 = $cone->ejecutar($conexion, $sql2, $traerID);
    } elseif ($consulta && ($idS === null || $consulta1)) {
        // Si no se proporcionó un síntoma o se insertó, redirige a la página de inicio de sesión con un mensaje de éxito.
        $_SESSION['mensaje'] = "Registrado con éxito.";
        $_SESSION['alert_type'] = "success";
        header("Location: ../views/login.php");
    }
} else {
    $_SESSION['mensaje'] = "Ha ocurrido un error al registrarse.";
    $_SESSION['alert_type'] = "danger";
    header("Location: ../views/login.php");
}

?>