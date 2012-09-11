<?php
header('Content-Type: text/html; charset=UTF-8');

session_start();
$datos = $_GET;
extract($_GET, EXTR_PREFIX_SAME, 'add');

$booleanReodenamiento=false;

if(!isset($tipoOrden)){
    $tipoOrden=1;
    $booleanReodenamiento=true;
}
echo $tipoOrden;

$reordenValoracion;
$reordenTitulo;
$consulta="";
switch ($tipoOrden){
    case 1:
        $consulta = "SELECT * FROM Favoritos WHERE IdUsuario=" . $_SESSION["IdUsuario"]."ORDER BY Titulo ASC";
        $reordenValoracion=3;
        $reordenTitulo=2;
        break;
    case 2:
        $consulta = "SELECT * FROM Favoritos WHERE IdUsuario=" . $_SESSION["IdUsuario"]."ORDER BY Titulo DESC";
        $reordenValoracion=3;
        $reordenTitulo=1;
        break;
    case 3:
        $consulta = "SELECT * FROM Favoritos WHERE IdUsuario=" . $_SESSION["IdUsuario"]."ORDER BY Valoracion ASC";
        $reordenValoracion=4;
        $reordenTitulo=1;
        break;
    case 4:
        $consulta = "SELECT * FROM Favoritos WHERE IdUsuario=" . $_SESSION["IdUsuario"]."ORDER BY Valoracion DESC";
        $reordenValoracion=3;
        $reordenTitulo=1;
        break;
    
}
if(!$booleanReodenamiento){
    $_SESSION["mensaje"]="Reordenamiento satisfactorio";
}

/* Establecer una conexion a favoritos.db */
$conexion = sqlite_open('db/favoritos.db') or die('no se ha podido establecer la conexión');
/* Creamos una consulta para obtener los datos de la tabla favoritos */
/* Ejecutamos la consulta */
$resQuery = sqlite_query($conexion, $consulta);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"lang="es" xml:lang="es">
    <head>
        <meta name="author" content="kienkane">
        <meta name="description" content="Desplegar contenido de Favoritos">
        <meta name="keywords" content="material de apoyo aplicaciones web">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="content-script-type" content="text/javascript">
        <meta http-equiv="content-style-type" content="text/css">
        <title>Favoritos <?php echo $_SESSION["usuario"]; ?></title>
        <link href="jqueryToastMessages/resources/css/jquery.toastmessage.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
        <script src="jqueryToastMessages/javascript/jquery.toastmessage.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                var mensaje=$("#mensajeAlerta").attr("value");
                if(mensaje!=""){
                    $().toastmessage('showNoticeToast',$("#mensajeAlertaPrincipal").attr("value"));
                }
            });
            
        
            function preguntarEliminar(idFavorito){
                var confirmacion=confirm("¿Realmente quieres eliminar el registro?");
                if(confirmacion){
                    window.location="php/eliminarFavorito.php?id="+idFavorito;
                    return;
                }
                
            }
            
        </script>
    </head>
    <body>
        <div id="container">
            <input type="hidden" id="mensajeAlertaPrincipal" value="<?php echo $_SESSION["mensaje"]; ?>">
            <table>
                <tr>
                    <td width="70%"><h2>Links favoritos de <?php echo $_SESSION["usuario"]; ?></h2></td>
                    <td width="10%"><a href="paginaAgregar.php">Agregar Favorito</a></td>
                    <td width="10%"><a href="php/cerrarSesion.php">Cerrar Sesión</a></td>
                </tr>
            </table>
            <table id="tabla">
                <thead>
                    <tr>
                        <th>Indice</th>
                        <th scope="col">Favorito</th>
                        <th scope="col">URL</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Comentarios</th>
                        <th scope="col">Categoria</th>
                        <th scope="col"><a href="paginaPrincipal.php?tipoOrden=<?php echo $reordenValoracion;?>">Valoración</a></th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $indice = 1; ?>
                    <?php while ($res = sqlite_fetch_array($resQuery, SQLITE_ASSOC)): ?>
                        <tr> 
                            <td><?php echo $indice++; ?> </td>
                            <?php foreach ($res as $key => $value): ?>
                                <?php if ($key !== 'IdUsuario' && $key !== 'IdFavorito'): ?>
                                    <td><?php echo ($key == 'Url') ? "<a href='$value'  target='_blank'>$value</a>" : $value; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><span><a onclick="preguntarEliminar(<?php echo $res["IdFavorito"]; ?>)" href="#">Eliminar</a> | <a href="editarFavorito.php?id=<?php echo $res["IdFavorito"]; ?>">Editar</a></span></td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                <th></th>
                <th><input type="button" onclick="window.location.href='paginaPrincipal.php?tipoOrden=<?php echo $reordenTitulo;?>'" value="Reordenar"/></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tfoot>
            </table>

        </div>
    </body>
</html>