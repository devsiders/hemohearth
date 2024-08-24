<?php
session_start();

require '../model/datos.php';

    $cone = new Conexion();
    // Comprueba si se han enviado datos por POST (formulario se ha enviado).
    if(!empty($_POST['resultado'])){
        // Obtiene los valores enviados por POST y los asigna a variables.
        $id=$_POST['id'];
        $nombre = $_POST['nombre'];
        $resultado = $_POST['resultado'];
        $tabla = 'pacientes';

        $conexion= $cone->conectar('hemohearth');

        // Antes de insertar un nuevo resultado, verificamos si ya existe uno.
        $sql_check = "SELECT * FROM resultados_medicos WHERE id_paciente = '$id'";
        $consulta_check = $cone->ejecutar($conexion, $sql_check);


        try {
            if (mysqli_num_rows($consulta_check) > 0) {
                // Si ya existe un resultado, muestra un mensaje de error.
                $_SESSION['mensaje'] = "El paciente ya cuenta con su resultado médico.";
                $_SESSION['alert_type'] = "warning";
                header("Location: ../views/admin/gstn.resultados.php");
                exit();
            } else {
                // Utiliza la función 'traerId' para obtener el ID correspondiente al valor de 'id' y 'tabla'.
                $id=traerId($tabla,$id,'id');

                $sql = "INSERT INTO resultados_medicos (id_paciente,resultado)  VALUES('$id','$resultado')";
                $consulta = $cone->ejecutar($conexion, $sql);

                // Comprueba si la consulta se ejecutó con éxito.
                if($consulta){
                    $_SESSION['mensaje'] = "Resultado médico subido exitosamente.";
                    $_SESSION['alert_type'] = "success";
                    header("Location: ../views/admin/gstn.resultados.php");
                    exit();
                    
                }else{
                    $_SESSION['mensaje'] = "Error al subir el resultado médico.";
                    $_SESSION['alert_type'] = "danger";
                    header("Location: ../views/admin/gstn.resultados.php");
                    exit();
                }
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = "Error: " . $e->getMessage();
            $_SESSION['alert_type'] = "danger";

            // Redirige a la página de error.
            header("Location: ../../views/admin/gstn.resultados.php");
            exit();
        }
        
    }

?>