<?php
header('Content-Type: text/html; charset=UTF-8');
/* Iniciamos el manejos de sesiones */
session_start();
$usuario = $_SESSION['usuario'];
$datos = $_GET;
extract($_GET, EXTR_PREFIX_SAME, 'add');

/* Creamos una conexión */
$conexion = sqlite_open('db/favoritos.db') or die('La conexión no se ha logrado');

/* Creamos la consulta para eliminar un favorito a la tabla favoritos dado el usuario indicado */
$consulta = "SELECT * FROM Favoritos WHERE IdFavorito =" .$id;
/* Ejecutamos la consulta */
$resQuery = sqlite_query($conexion, $consulta);
/* Convertimos el resultado en un array asociativo */
$res = sqlite_fetch_array($resQuery, SQLITE_ASSOC);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"lang="es" xml:lang="es">
    <head>
        <meta name="author" content="kienkane">
        <meta name="description" content="Editar un favorito">
        <meta name="keywords" content="material de apoyo aplicaciones web">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="content-script-type" content="text/javascript">
        <meta http-equiv="content-style-type" content="text/css">
        <title>Favoritos <?php echo $usuario; ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>   
        <script>
            function limpiarRedireccionar(pagina){
                <?php $_SESSION["mensaje"]="" ?>
                        window.location=pagina;
            }
    </script>
    </head>
    <body>
        <div id="container">
            <h2>Editar el favorito "<?php echo $res['Titulo']; ?>"</h2>
            <div class="mensajeAcc"><?php echo $_SESSION["mensaje"]; ?></div>
            <div id="contenedor">
                <form action="php/updateFavorito.php" method="post">			
                    <ul>
                        <li class="izquierda">
                            <label class="titulo" for="nombre">Título<span class="requerido">*</span></label>
                            <div>
                                <span class="completo">
                                    <input id="titulo" name="titulo" value="<?php echo $res['Titulo']; ?>">
                                    <label for="titulo">Título del link</label>
                                </span>

                                <span class="completo">
                                    <input id="url" name="url" value="<?php echo $res['Url']; ?>">
                                    <label for="url">URL</label>
                                </span>
                            </div>
                            <p class="ayuda">No te olvides de escribir la URL iniciando con <b>http://</b> </p>
                        </li>

                        <li class="derecha">
                            <label class="titulo" >Opinión <span class="requerido">*</span></label>
                            <div>
                                <span class="completo">
                                    <textarea name="descripcion"  id="descripcion" cols="50" rows="6"><?php echo $res['Descripcion']; ?></textarea>
                                    <label for="descripcion">Descripción</label>
                                </span>
                                <span class="completo">
                                    <textarea name="comentarios"  id="comentarios" cols="50" rows="6"><?php echo $res['Comentarios']; ?></textarea>
                                    <label for="comentarios">Comentarios</label>
                                </span>
                                <span class="completo">
                                    <select id='categoria' name='categoria' value="<?php echo $res['Categoria']; ?>">
                                        <option value='consultas'>consultas</option>
                                        <option value='deportes'>deportes</option>
                                        <option value='diversion'>diversión</option>
                                        <option value='emails'>emails</option>
                                        <option value='libros'>libros</option>
                                        <option value='foros'>foros</option>
                                    </select>
                                    <label for="categoria">Categoría</label>
                                </span>
                                <span class="completo" id="range">
                                    <input type='range' id='valoracion' name='valoracion' value="<?php echo $res['Valoracion']; ?>" min='0' max='10' step='1'>
                                    <p><span>0</span> <span>10</span></p>
                                    <label for="valoracion">Valoración</label>
                                </span>
                            </div>
                            <p class="ayuda">Los comentarios y la descripción deben ser breves.</p>
                        </li>
                        <li class="botones">
                            <input type="button" value="Cancelar" onclick="limpiarRedireccionar('paginaPrincipal.php');"/>
                            <input type="hidden" name="idFav" value="<?php echo $res["IdFavorito"]; ?>">
                            <input type="reset" value="Borrar Cambios">
                            <input id="alta" type="submit" value="Actualizar Favorito →">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
/* Cerramos la conexion */
sqlite_close($conexion);
?>
