<?php


header('Content-Type: text/html; charset=UTF-8');

$nombre_base = "despensa.db";

$conexion = sqlite_open($nombre_base) or die("Conexion a base de datos fallida");
if ($conexion) {
    echo 'La conexión se ha establecido -> la base de datos' . $nombre_base . '  se ha creado';
    chmod($nombre_base, 0777);
}

$consultaUpdate =
        <<<SQL

        UPDATE Articulos set Cantidad=Cantidad+1 where Id%2=0;
   
SQL;

$resultadoCreate = sqlite_exec($consultaUpdate, $conexion);
echo '<br>';
if ($resultadoCreate) {
    echo 'La actualizacion de elementos fue exitosa';
} else {
    echo 'La actualizacion de elementos no fue exitosa';
}

?>
