<?php

header('Content-Type: text/html; charset=UTF-8');

$nombre_base="despensa.db";

$conexion = sqlite_open($nombre_base) or die("Conexion a base de datos fallida");
if ($conexion) {
    echo 'La conexión se ha establecido -> la base de datos'.$nombre_base.'  se ha creado';
    chmod($nombre_base, 0777);
}

$consulta =
        <<<SQL
CREATE TABLE Articulos(
        Id INTEGER PRIMARY KEY NOT NULL,
        Nombre VARCHAR(100) NOT NULL,
        Departamento VARCHAR(100) NOT NULL,
        Cantidad INTEGER
);
SQL;

$resultadoCreate = sqlite_exec($consulta, $conexion);
echo '<br>';
if ($resultadoCreate) {
    echo 'La creacion de la tabla ha sido exitosa';
} else {
    echo 'La creacion de la tabla no fue exitoso';
}

?>
