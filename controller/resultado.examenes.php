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

        try {
            $conexion= $cone->conectar('hemohearth');
            // Utiliza la función 'traerId' para obtener el ID correspondiente al valor de 'id' y 'tabla'.
            $id=traerId($tabla,$id,'id');

            $sql = "INSERT INTO resultados_medicos (id_paciente,resultado)  VALUES('$id','$resultado')";
            $consulta = $cone->ejecutar($conexion, $sql);

            // Comprueba si la consulta se ejecutó con éxito.
            if($consulta){
                $_SESSION['mensaje'] = "Resultado médico subido exitosamente.";
                $_SESSION['alert_type'] = "success";
                
            }else{
                $_SESSION['mensaje'] = "Error al subir el resultado médico.";
                $_SESSION['alert_type'] = "danger";

                echo '<script>$(document).ready(function() { $("#miTabla").DataTable().ajax.reload(); });</script>';

                header("Location: ../../views/admin/gstn.resultados.php");
                exit();
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