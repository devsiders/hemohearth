<?php

require '../model/datos.php';

$cone = new Conexion();
session_start();

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
    $sintoma = isset($_POST['sint']) ? $_POST['sint'] : null;

    $clave = hash('sha512', $clave); // Encripta la contraseña usando SHA-512.

    $conexion = $cone->conectar('hemohearth');

    try {
        // Verificar si el documento ya existe
        $sql_check = "SELECT * FROM pacientes WHERE documento = '$docu'";
        $resultado_check = $cone->ejecutar($conexion, $sql_check);

        if (mysqli_num_rows($resultado_check) > 0) {
            // Documento ya registrado
            $_SESSION['mensaje'] = "El documento ya está registrado.";
            $_SESSION['alert_type'] = "warning";
            header("Location: ../views/registro.php");
            exit();
        }

        // Inicia la transacción
        mysqli_begin_transaction($conexion);

        // Insertar nuevo paciente
        $sql = "INSERT INTO pacientes (nombre, apellido, tipo_documento, documento, eps, email, clave) VALUES ('$nombre', '$apellido', '$td', '$docu', '$eps', '$email', '$clave')";
        $consulta = $cone->ejecutar($conexion, $sql);

        if (!$consulta) {
            throw new Exception("Error al registrar el paciente: " . mysqli_error($conexion));
        }

        // Obtener el ID del paciente insertado
        $traerId = mysqli_insert_id($conexion);

        if (!$traerId) {
            throw new Exception("Error al obtener el ID del paciente insertado.");
        }

        // Insertar el rol de usuario
        $sql3 = "INSERT INTO roles_usuario (id_usuario, id_rol) VALUES ('$traerId', 2)";
        $consultaRol = $cone->ejecutar($conexion, $sql3);

        if (!$consultaRol) {
            throw new Exception("Error al asignar el rol al usuario: " . mysqli_error($conexion));
        }

        // Insertar el síntoma, si se seleccionó uno
        if ($sintoma !== null) {
            $tabla = 'patologias';
            $idS = traerId($tabla, $sintoma);

            if ($idS) {
                $sql2 = "INSERT INTO pacientes_patologias (id_paciente, id_patologia) VALUES ('$traerId', '$idS')";
                $consultaSintoma = $cone->ejecutar($conexion, $sql2);

                if (!$consultaSintoma) {
                    throw new Exception("Error al registrar la patología: " . mysqli_error($conexion));
                }
            }
        }

        // Si todo ha ido bien, se confirma la transacción
        mysqli_commit($conexion);

        // Redirigir con mensaje de éxito
        $_SESSION['mensaje'] = "Registrado con éxito.";
        $_SESSION['alert_type'] = "success";
        header("Location: ../views/login.php");
        exit();

    } catch (Exception $e) {
        // Si ocurre algún error, se deshace la transacción
        mysqli_rollback($conexion);

        // Mensaje de error
        $_SESSION['mensaje'] = "Ha ocurrido un error al registrarse: " . $e->getMessage();
        $_SESSION['alert_type'] = "danger";
        header("Location: ../views/registro.php");
        exit();
    }
} else {
    // Si faltan datos, muestra un mensaje de error
    $_SESSION['mensaje'] = "Ha ocurrido un error al registrarse. Faltan datos.";
    $_SESSION['alert_type'] = "danger";
    header("Location: ../views/registro.php");
    exit();
}

?>
