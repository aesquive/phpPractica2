<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
?>
<!DOCTYPE>
<html>
    <head>
        <meta name="author" content="kienkane">
        <meta name="description" content="Desplegar contenido de Favoritos">
        <meta name="keywords" content="material de apoyo aplicaciones web">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="content-script-type" content="text/javascript">
        <meta http-equiv="content-style-type" content="text/css">
        <title>Favoritos <?php echo $_SESSION["usuario"]; ?></title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script>

            function limpiarRedireccionar(pagina){
                    <?php $_SESSION["mensaje"] = "" ?>
                        window.location=pagina;
             }    
        </script>
    </head>
    <body>
        <div id="contenedor">
            <form action='php/agregarFavorito.php' method='post'>			
                <ul>
                    <li class="izquierda">
                        <label class="titulo" for="nombre">Título<span class="requerido">*</span></label>
                        <div>
                            <span class="completo">
                                <input required="true" id="titulo" name="titulo" value="">
                                <label for="titulo">Título del link</label>
                            </span>

                            <span class="completo">
                                <input required="true" id="url" name="url" value="http://">
                                <label for="url">URL</label>
                            </span>
                        </div>
                        <p class="ayuda">No te olvides de escribir la URL iniciando con <b>http://</b> </p>
                    </li>

                    <li class="derecha">
                        <label class="titulo" >Opinión <span class="requerido">*</span></label>
                        <div>
                            <span class="completo">
                                <textarea name="descripcion"  id="descripcion" cols="50" rows="6"></textarea>
                                <label for="descripcion">Descripción</label>
                            </span>
                            <span class="completo">
                                <textarea name="comentarios"  id="comentarios" cols="50" rows="6"></textarea>
                                <label for="comentarios">Comentarios</label>
                            </span>
                            <span class="completo">
                                <select id='categoria' name='categoria'>
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
                                <input required="true" type='range' id='valoracion' name='valoracion' value='0' min='0' max='10' step='1'>
                                <p><span>0</span> <span>10</span></p>
                                <label for="valoracion">Valoración</label>
                            </span>
                        </div>
                        <p class="ayuda">Los comentarios y la descripción deben ser breves.</p>
                    </li>
                    <li class="botones">
                        <input type="button" value="Cancelar" onclick="limpiarRedireccionar('paginaPrincipal.php')"/>
                        <input type="reset" value="Borrar">
                        <input type="submit" value="Ingresar Favorito →">
                    </li>
                </ul>
            </form>
        </div>
    </body>
</html>