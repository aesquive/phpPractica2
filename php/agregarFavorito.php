<?php
header('Content-Type: text/html; charset=UTF-8');
/* Iniciamos el manejos de sesiones */
session_start();
$usuario = $_SESSION['usuario'];
$datos = $_POST;
//generamos las variables de los datos
extract($_POST, EXTR_PREFIX_SAME, 'add');
/* Creamos una conexión */
$conexion = sqlite_open('../db/favoritos.db') or die('La conexión no se ha logrado');
/* Creamos la consulta para ingresar un favorito a la tabla favoritos dado el usuario indicado */
//IdFavorito ,IdUsuario ,Titulo ,Url ,Descripcion,Comentarios ,Categoria,Valoracion 
$consulta ="	INSERT INTO Favoritos (IdUsuario, Titulo, Url,Descripcion, Comentarios, Categoria,Valoracion) 
VALUES(".$_SESSION['IdUsuario'].",'$titulo', '$url', '$descripcion', '$comentarios', '$categoria', $valoracion);";
/* Ejecutamos la consulta */
$exec = sqlite_exec($conexion, $consulta);
/* Cerramos la conexion */
sqlite_close($conexion);

$_SESSION["mensaje"]="El favorito '$titulo' fue  agregado satisfactoriamente";
header("Location: ../paginaPrincipal.php");
?>
