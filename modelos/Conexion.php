<?php

abstract class Conexion
{

    protected static $conexion = null;

    protected static function connectar(): PDO
    {

        try {
            self::$conexion = new PDO("informix:host=host.docker.internal;service=9088;database=registros;server=informix;protocol=onsoctcp;EnableScrollableCursors=1", "informix", "in4mix");
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Sin conexión a la Base de Datos registros";
            echo "<br>";
            echo $e->getMessage();
            self::$conexion = null;
            return null;
        }

        return self::$conexion;
    }


    public function ejecutar($sql, $valores = [])
    {

        $conexion = self::connectar();

        if ($conexion == null) {
            return [
                "resultado" => false,
                "id" => null,
                "error" => "No se pudo conectar a la base de datos"
            ];
        }

        try {
            $sentencia = $conexion->prepare($sql);
            $resultado = $sentencia->execute($valores);
            $idInsertado = $conexion->lastInsertId();
        } catch (PDOException $e) {
            self::$conexion = null;
            return [
                "resultado" => false,
                "id" => null,
                "error" => $e->getMessage()
            ];
        }

        self::$conexion = null;
        return [
            "resultado" => $resultado,
            "id" => $idInsertado,
            "error" => null
        ];
    }

    public function servir($sql)
    {
        $conexion = self::connectar();
        if ($conexion === null) {
            return [];
        }

        try {
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute();
            $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            $datos = [];
            foreach ($data as $k => $v) {
                $datos[] = array_change_key_case($v, CASE_LOWER);
            }
        } catch (PDOException $e) {
            self::$conexion = null;
            return [];
        }

        self::$conexion = null;
        return $datos;
    }
}
