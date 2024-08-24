<?php
require 'config.php';

function patologia()
{
    $conexion = new Conexion();
    $connect = $conexion->conectar('hemohearth');

    $sql = "SELECT nombre FROM patologias";
    $consulta = $conexion->ejecutar($connect, $sql);

    return $consulta;
}

function leerPacientes()
{
    $conexion = new Conexion();
    $connect = $conexion->conectar('hemohearth');

    $sql = "SELECT nombre, apellido, tipo_documento, documento, eps, email FROM pacientes 
    INNER JOIN roles_usuario ON roles_usuario.id_usuario=pacientes.id INNER JOIN roles ON 
    roles.id_rol=roles_usuario.id_rol WHERE roles.id_rol = 2 ORDER BY pacientes.id DESC";
    $consulta = $conexion->ejecutar($connect, $sql);

    return $consulta;
}

function pacientes_resultados()
{
    $conexion = new Conexion();
    $connect = $conexion->conectar('hemohearth');

    $sql = "SELECT DISTINCT p.id, p.nombre, apellido, tipo_documento, documento, eps, email, e.resultado
    FROM pacientes p 
    LEFT JOIN resultados_medicos e ON p.id = e.id_paciente 
    LEFT JOIN pacientes_patologias pp ON pp.id_paciente = p.id 
    LEFT JOIN patologias pt ON pt.id = pp.id_patologia
    WHERE pp.id_paciente IS NOT NULL ORDER BY p.id DESC";
    $consulta = $conexion->ejecutar($connect, $sql);

    return $consulta;
}

function traerP($id)
{
    $conexion = new Conexion();
    $cone = $conexion->conectar("hemohearth");

    $sql = "SELECT * FROM pacientes where id=" . $id;
    $consulta = $conexion->ejecutar($cone, $sql);

    return $consulta;
}

function resultados($id)
{
    $conexion = new Conexion();
    $cone = $conexion->conectar("hemohearth");

    $sql = "SELECT * FROM resultados_medicos where id_paciente=" . $id;
    $consulta = $conexion->ejecutar($cone, $sql);

    return $consulta;
}

function traerId($tabla, $nombre, $campo = 'nombre')
{
    $conexion = new Conexion();
    $cone = $conexion->conectar("hemohearth");
    $datos = 0;
    $sql = "SELECT id FROM $tabla where $campo='$nombre'";
    if ($conexion->ejecutar($cone, $sql)) {
        $consulta = $conexion->ejecutar($cone, $sql);
        $dato = $consulta->fetch_assoc();
        $dato['id'];
        $datos = $dato['id'];

    } else {
        print "<br> No ha podido realizarse la cosulta. Ha habido en error<br>";
        print "<¡>Error;</¡>" . mysqli_error($cone) . "<¡Codigo:</¡>" . mysqli_errno($cone);
        exit();
    }
    return $datos;
}

?>