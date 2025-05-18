<?php

require '../models/datos.php';

$bd = new Conexion();

session_start();

// Comprueba si se han enviado datos por POST (formulario se ha enviado).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los valores enviados por POST y los asigna a variables.
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $td = $_POST['td'];
    $docu = $_POST['documento'];
    $eps = $_POST['eps'];
    $email = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); 
    $sintoma = isset($_POST['sint']) ? $_POST['sint'] : null;


    $conne =  $bd->conectar();


    try {
        mysqli_begin_transaction($conne);

        // Verificar si el documento ya existe
        $sql = "SELECT * FROM pacientes WHERE documento = ?";
        $stmt = $conne->prepare($sql);
        $stmt->bind_param("s", $docu); 
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Documento ya registrado
            $_SESSION['error'] = "El documento ya está registrado.";
            mysqli_rollback($conne);
            header("Location: ../views/auth/registro.php");
            exit();
        }
        

        // Insertar nuevo paciente
        $sql_insert = "INSERT INTO pacientes (nombre, apellido, tipo_documento, documento, eps, email, clave) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conne->prepare($sql_insert);
        $stmt_insert->bind_param("sssssss", $nombre, $apellido, $td, $docu, $eps, $email, $clave);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows === 0) {
            throw new Exception("Error al registrar el paciente.");
        }


        // Obtener el ID del paciente insertado
        $traerId = mysqli_insert_id($conne);

        if (!$traerId) {
            throw new Exception("Error al obtener el ID del paciente insertado.");
        }

        // Insertar el rol de usuario
        $sql_rol = "INSERT INTO roles_usuario (id_usuario, id_rol) VALUES ('$traerId', 2)";
        $stmt_rol = $conne->prepare($sql_rol);
        $stmt_rol->execute();


        if ($stmt_rol->affected_rows === 0) {
            throw new Exception("Error al asignar el rol al usuario.");
        }

        // Insertar el síntoma, si se seleccionó uno
        if ($sintoma !== null) {
            $tabla = 'patologias';
            $idS = Datos::traerId($tabla, $sintoma);

            if ($idS) {
                $sql_asignar = "INSERT INTO pacientes_patologias (id_paciente, id_patologia) VALUES ('$traerId', '$idS')";
                $stmt_asignar = $conne->prepare($sql_asignar);
                $stmt_asignar->execute();

                if ($stmt_asignar->affected_rows === 0) {
                    throw new Exception("Error al registrar la patología.");
                }
            }
        }

        // Si todo ha ido bien, se confirma la transacción
        mysqli_commit($conexion);

        // Redirigir con mensaje de éxito
        $_SESSION['mensaje'] = "Registrado con éxito.";
        header("Location: ../views/auth/login.php");
        exit();

    } catch (Exception $e) {
        // Si ocurre algún error, se deshace la transacción
        mysqli_rollback($conexion);

        // Mensaje de error
        $_SESSION['error'] = "Ha ocurrido un error al registrarse: " . $e->getMessage();
        header("Location: ../views/auth/registro.php");
        exit();
    }
} else {
    // Si faltan datos, muestra un mensaje de error
    $_SESSION['error'] = "Ha ocurrido un error al registrarse. Faltan datos.";
    header("Location: ../views/auth/registro.php");
    exit();
}

?>
