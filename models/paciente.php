<?php

require_once __DIR__ . '/../config/db.php';

class Paciente
{
    public static function conexion(){
        $bd = new Conexion();
        return  $bd->conectar();
    }

    public static function pacientes()
    {
        $conne = self::conexion();

        $sql = "SELECT DISTINCT p.id, p.nombre, apellido, tipo_documento, documento, eps, email, e.resultado
                FROM pacientes p 
                LEFT JOIN resultados_medicos e ON p.id = e.id_paciente 
                LEFT JOIN pacientes_patologias pp ON pp.id_paciente = p.id 
                LEFT JOIN patologias pt ON pt.id = pp.id_patologia
                WHERE pp.id_paciente IS NOT NULL ORDER BY p.id DESC";
        $stmt = $conne->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado;
        } else {
            return false;
        }
    }

    public static function traerP($id)
    {
        $conne = self::conexion();

        $sql = "SELECT * FROM pacientes where id=" . $id;
        $stmt = $conne->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function resultados($id)
    {
        $conne = self::conexion();

        $sql = "SELECT * FROM resultados_medicos where id_paciente = ?";
        $stmt = $conne->prepare($sql);
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado;
        } else {
            return false;
        }
    }

}
