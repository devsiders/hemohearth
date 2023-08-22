<?php
session_start();

require 'datos.php';

    $cone = new Conexion();

    if(!empty($_GET['id'])){
        $id=$_GET['id'];
    }

    if(!empty($_POST['nombre'])){
        $id=$_POST['id'];
        $nombre = $_POST['nombre'];
        $resultado = $_POST['resultado'];
        $tabla = 'pacientes';

        $conexion= $cone->conectar('hemohearth');

        $id=traerId($tabla,$id,'id');

        $sql = "INSERT INTO examenes_medicos (id_paciente,resultado)  VALUES('$id','$resultado')";

        $consulta = $cone->ejecutar($conexion, $sql, $id);

        if($consulta==TRUE){
            $_SESSION['mensaje'] = "Resultado médico subido exitosamente.";
            $_SESSION['alert_type'] = "success";
            header('Location: ../views/admin.php');
        }else{
            $_SESSION['mensaje'] = "Error al subir los resultado médico.";
            $_SESSION['alert_type'] = "danger";
        }

    }

?>