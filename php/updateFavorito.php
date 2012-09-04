<?php 
//$datos = $_POST;
session_start();
extract($_POST, EXTR_PREFIX_SAME, 'add');
/*Establecer una conexion a favoritos.db*/
$conexion = sqlite_open('../db/favoritos.db') or die('no se ha podido establecer la conexión');

/*Creamos una consulta para actualizar los datos de la tabla favoritos */
$consulta ="	UPDATE favoritos SET 
	Titulo = '$titulo',
	Url = '$url',
	Descripcion = '$descripcion',
    Comentarios = '$comentarios',
    Categoria = '$categoria',
	Valoracion = $valoracion
	WHERE IdFavorito = $idFav
";

	

/*Ejecutamos la consulta*/
$exec = sqlite_exec($conexion, $consulta);

if($exec){
        $_SESSION["mensaje"]="Favorito '$titulo' editado satisfactoriamente";
	header ("Location: ../paginaPrincipal.php"); 
}else{
        $_SESSION["mensaje"]="Error al editar el favorito '$titulo'";
	header ("Location: ../editarFavorito.php"); 
}
/*Cerramos la conexion*/
sqlite_close($conexion);
?>
