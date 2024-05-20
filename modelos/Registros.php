<?php
require 'Conexion.php';


class Registros extends Conexion {
    public $ingreso_id;
    public $ingreso_nombre;
    public $ingreso_apellido;
    public $ingreso_fecha_ingreso;
    public $ingreso_fecha_salida;
    public $ingreso_razon;

    public function __construct($args = []) {
        $this->ingreso_id = $args['ingreso_id'] ?? null;
        $this->ingreso_nombre = $args['ingreso_nombre'] ?? '';
        $this->ingreso_apellido = $args['ingreso_apellido'] ?? '';
        $this->ingreso_fecha_ingreso = $args['ingreso_fecha_ingreso'] ?? 0;
        $this->ingreso_fecha_salida = $args['ingreso_fecha_salida'] ?? 0;
        $this->ingreso_razon = $args['ingreso_razon'] ?? 1;
    }

    // Método para el ingreso de una persona al CIT
    public function guardar() {
        $sql = "INSERT INTO ingresos (ingreso_nombre, ingreso_apellido, ingreso_fecha_ingreso, ingreso_fecha_salida, ingreso_razon) VALUES (?, ?, ?, ?, ?)";
        $valores = [$this->ingreso_nombre, $this->ingreso_apellido, $this->ingreso_fecha_ingreso, $this->ingreso_fecha_salida, $this->ingreso_razon];
        $resultado = $this->ejecutar($sql, $valores);

        if ($resultado['resultado'] === false) {
            throw new PDOException($resultado['error']);
        }

        return $resultado['resultado'];
    }

//metodo para buscar una persona dentro del registro del CIT
    public function buscar(...$columnas) {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM ingresos WHERE ingreso_id > 0";

        
        if (!empty($this->ingreso_nombre)) {
            $sql .= " AND ingreso_nombre LIKE :nombre";
        }
        if (!empty($this->ingreso_apellido)) {
            $sql .= " AND ingreso_apellido LIKE :apellido";
        }
        if (!empty($this->ingreso_fecha_ingreso)) {
            $sql .= " AND ingreso_fecha_ingreso = :fecha";
        }
        if (!empty($this->ingreso_fecha_salida)) {
            $sql .= " AND ingreso_fecha_salida = :salida";
        }
        if (!empty($this->ingreso_razon)) {
            $sql .= " AND ingreso_razon = :razon";
        }
        
        $conexion = self::connectar();
        if ($conexion === null) {
            throw new PDOException("No se pudo conectar a la base de datos");
        }
        
        $sentencia = $conexion->prepare($sql);
        if (!empty($this->ingreso_nombre)) {
            $sentencia->bindValue(':nombre', '%' . $this->ingreso_nombre . '%');
        }
        if (!empty($this->ingreso_apellido)) {
            $sentencia->bindValue(':apellido', '%' . $this->ingreso_apellido . '%');
        }
        if (!empty($this->ingreso_fecha_ingreso)) {
            $sentencia->bindValue(':fecha', $this->ingreso_fecha_ingreso, PDO::PARAM_INT);
        }
        if (!empty($this->ingreso_fecha_salida)) {
            $sentencia->bindValue(':salida', $this->ingreso_fecha_salida, PDO::PARAM_INT);
        }
        if (!empty($this->ingreso_razon)) {
            $sentencia->bindValue(':razon', $this->ingreso_razon, PDO::PARAM_INT);
        }
        
        $sentencia->execute();
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        self::$conexion = null;
    
        return $data;
    }
       }
    

