<?php

require '../models/datos.php';

$bd = new Conexion();

session_start();

    // Comprueba si se han enviado datos por POST (formulario se ha enviado).
    if(!empty($_POST['resultado'])){
        // Obtiene los valores enviados por POST y los asigna a variables.
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $resultado = $_POST['resultado'];
        $tabla = 'pacientes';

        $conne =  $bd->conectar();

        try {
                // Utiliza la función 'traerId' para obtener el ID correspondiente al valor de 'id' y 'tabla'.
                $id = Datos::traerId($tabla,$id,'id');

                $sql_insert = "INSERT INTO resultados_medicos (id_paciente, resultado)  VALUES('$id', ?)";
                $stmt_insert = $conne->prepare($sql_insert);
                $stmt_insert->bind_param("s", $resultado);
                $stmt_insert->execute();
                // Comprueba si la consulta se ejecutó con éxito.
                if($stmt_insert->affected_rows > 0){
                    $_SESSION['mensaje'] = "Resultado médico subido exitosamente.";
                    header("Location: ../views/admin/paciente.php");
                    exit();
                    
                }else{
                    $_SESSION['error'] = "Error al subir el resultado médico.";
                    header("Location: ../views/admin/paciente.php");
                    exit();
                }
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            // Redirige a la página de error.
            header("Location: ../views/admin/paciente.php");
            exit();
        }
        
    }

?>