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

    $sql = "SELECT nombre, apellido, tipo_documento, documento, eps, email FROM pacientes";
    $consulta = $conexion->ejecutar($connect, $sql);

    return $consulta;
}

function pacientes_resultados()
{
    $conexion = new Conexion();
    $connect = $conexion->conectar('hemohearth');

    $sql = "SELECT p.id, nombre, apellido, tipo_documento, documento, eps, email, resultado FROM pacientes p LEFT JOIN examenes_medicos e ON p.id = e.id_paciente";
    $consulta = $conexion->ejecutar($connect, $sql);

    return $consulta;
}

function traerEP($id)
{
    $conexion = new Conexion();
    $connect = $conexion->conectar('hemohearth');

    $sql = "SELECT p.id, nombre, apellido, tipo_documento, documento, resultado FROM pacientes p LEFT JOIN examenes_medicos e ON p.id = e.id_paciente WHERE p.id=" . $id;
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

    $sql = "SELECT * FROM examenes_medicos where id_paciente=" . $id;
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

function pacientesConPaginacion($por_pagina, $offset) {
    $conexion = new Conexion();
    $cone = $conexion->conectar("hemohearth");

    $sql = "SELECT * FROM pacientes LIMIT $offset, $por_pagina";
    $consulta = $conexion->ejecutar($cone, $sql);

    return $consulta;
}



?>