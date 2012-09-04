<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
$usuario = $_SESSION['usuario'];
$datos = $_GET;
extract($_GET, EXTR_PREFIX_SAME, 'add');

/*Creamos una conexión */
$conexion = sqlite_open('../db/favoritos.db') or die('La conexión no se ha logrado');

/*Creamos la consulta para eliminar un favorito a la tabla favoritos dado el usuario indicado*/
$consulta = "DELETE FROM Favoritos WHERE IdFavorito =".$id;
/*Ejecutamos la consulta*/
$exec = sqlite_exec($conexion, $consulta);
/*Cerramos la conexion*/
sqlite_close($conexion);

$_SESSION["mensaje"]="Registro borrado satisfactoriamente";
header ("Location: ../paginaPrincipal.php"); 
?>
