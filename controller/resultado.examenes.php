<?php
session_start();

require '../model/datos.php';

    $cone = new Conexion();
    // Comprueba si se proporcionó un valor en la variable GET llamada 'id'.
    if(!empty($_GET['id'])){
        $id=$_GET['id'];
    }
    // Comprueba si se han enviado datos por POST (formulario se ha enviado).
    if(empty($_POST['resultado'])){
        // Obtiene los valores enviados por POST y los asigna a variables.
        $id=$_POST['id'];
        $nombre = $_POST['nombre'];
        $resultado = $_POST['resultado'];
        $tabla = 'pacientes';

        $conexion= $cone->conectar('hemohearth');
        // Utiliza la función 'traerId' para obtener el ID correspondiente al valor de 'id' y 'tabla'.
        $id=traerId($tabla,$id,'id');

        $sql = "INSERT INTO examenes_medicos (id_paciente,resultado)  VALUES('$id','$resultado')";

        $consulta = $cone->ejecutar($conexion, $sql, $id);
        // Comprueba si la consulta se ejecutó con éxito.
        if($consulta){
            $_SESSION['mensaje'] = "Resultado médico subido exitosamente.";
            $_SESSION['alert_type'] = "success";
            header("Location: ../views/admin.php");
        }else{
            $_SESSION['mensaje'] = "Error al subir el resultado médico.";
            $_SESSION['alert_type'] = "danger";
            header("Location: ../views/formulario.examenes.php");
        }

    }else {
        $_SESSION['mensaje'] = "Completa el campo.";
        $_SESSION['alert_type'] = "warning";
        header("Location: ../views/formulario.examenes.php");
    }

?>