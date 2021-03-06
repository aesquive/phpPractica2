<?php
header('Content-Type: text/html; charset=UTF-8');


$nombre_base = "despensa.db";

$conexion = sqlite_open($nombre_base) or die("Conexion a base de datos fallida");
if ($conexion) {
    chmod($nombre_base, 0777);
}
session_start();

if(!$_SESSION  || !$_SESSION["tipoOrdenacion"]){
    
    $_SESSION["nombreBoton"]="A-Z";
    $_SESSION["consultaOrdenacion"] ="SELECT * FROM Articulos ORDER BY Nombre ASC;";
    $_SESSION["tipoOrdenacion"]=1;

}
$resQuery = sqlite_query($conexion, $_SESSION["consultaOrdenacion"]);

function cambiarOrden(){
                 
                        switch ($_SESSION["tipoOrdenacion"]){
                            case 1:
                                $_SESSION["nombreBoton"]="Z-A";
                                $_SESSION["consultaOrdenacion"]="SELECT * FROM Articulos ORDER BY Nombre DESC";
                                $_SESSION["tipoOrdenacion"]=2;
                                break;
                            case 2:
                                $_SESSION["nombreBoton"]="A-Z";
                                $_SESSION["consultaOrdenacion"]="SELECT * FROM Articulos ORDER BY Nombre ASC";
                                $_SESSION["tipoOrdenacion"]=1;
                                break;
                                    header ("Location: verDespensa.php");	

                        }
                

}

?>
<!DOCTYPE>
<html>
    <head>
        <title>Vista de Despensa</title>
        <script type="text/javascript">
           function ordenarElementos(){
                       <?php cambiarOrden() ?>
                window.location="verDespensa.php";
            }    
        </script>
        <link type="text/css" rel="stylesheet" href="../css/despensa.css" media="all"/>
        
    </head>
    <body id="container">
        <h1 id="titulo"> Inventario de Articulos</h1>
        <table id="tablaContenido" border="1">
            <thead>
            <th  width="20%">
                <a>Id</a>
            </th>
            <th width="30%">
                <a>Nombre</a>
            </th>
            <th width="30%"><a>Departamento</a></th>
            <th width="20%"><a>Cantidad</a></th>
        </thead>
        
        <tbody>
                <?php while ($res = sqlite_fetch_array($resQuery, SQLITE_ASSOC)): ?>
                <tr>
                    <?php foreach ($res as $key => $value): ?>
                        <td><?php echo $value; ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endwhile; ?>
        </tbody>
        <tfoot>
            <th></th>
            <th>
                <input type="button" value="<?php echo $_SESSION["nombreBoton"]; ?>" onclick="ordenarElementos()"/></th>
            <th></th>
            <th></th>
        </tfoot>
    </table>
</body>
</html>
