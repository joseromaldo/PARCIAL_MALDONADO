CREATE DATABASE registros;

CREATE TABLE ingresos (
    ingreso_id SERIAL NOT NULL,
    ingreso_nombre VARCHAR(70) NOT NULL,
    ingreso_apellido VARCHAR(70) NOT NULL,
    ingreso_fecha_ingreso DATETIME YEAR TO HOUR NOT NULL,
    ingreso_fecha_salida DATETIME YEAR TO HOUR NOT NULL,
    ingreso_razon VARCHAR(70) NOT NULL,
    PRIMARY KEY (ingreso_id)
);


