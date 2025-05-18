<?php
require_once './config/db.php';

class Datos{
    
    public static function conexion(){
        $bd = new Conexion();
        return  $bd->conectar();
    }

    public static function patologia()
    {
        $conne = self::conexion();

        $sql = "SELECT nombre FROM patologias";
        $stmt = $conne->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return $resultado;
        } else {
            return false;
        }
    }


    public static function traerId($tabla, $nombre, $campo = 'nombre')
    {
        $conne = self::conexion();

        $datos = 0;
        $sql = "SELECT id FROM $tabla where $campo='$nombre'";
        if ($stmt = $conne->prepare($sql)) {
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado->num_rows > 0) {
                $dato = $resultado->fetch_assoc();
                $datos = $dato['id'];
            }
        } else {
            print "<br> No ha podido realizarse la cosulta. Ha habido en error<br>";
            print "<¡>Error;</¡>" . mysqli_error($conne) . "<¡Codigo:</¡>" . mysqli_errno($conne);
            exit();
        }
        return $datos;
    }
}

?>