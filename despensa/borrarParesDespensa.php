<?php
header('Content-Type: text/html; charset=UTF-8');

$nombre_base = "despensa.db";

$conexion = sqlite_open($nombre_base) or die("Conexion a base de datos fallida");
if ($conexion) {
    echo 'La conexion a la base se ha realizado';
    chmod($nombre_base, 0777);
}

$consultaDelete =
        <<<SQL
        DELETE FROM Articulos where Id%2=0;
SQL;

$resultado=  sqlite_exec($consultaDelete,$conexion);

echo '<br>';
if($resultado){
    echo 'Los registros con Id par se han eliminado';
}else{
    echo 'Fallo al borrar elementos';
}

?>


