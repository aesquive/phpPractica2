<?php
/**
 *Se encarga de autenticar a un usuario en la base de datos de favorito.db
 * mete en sesion el "IdUsuario" , "usuario","password" que se ocuparan en consultas posteriores
 *  
 */
//iniciamos la sesion 
session_start();
header('Content-Type: text/html; charset=UTF-8');
$nombreBase = "../db/favoritos.db";
$conexion = sqlite_open($nombreBase) or die("La conexion a la base de favoritos no se pudo realizar");
//revisamos si el usuario realmente existe en la base de datos , si no lo damos de alta
$usuarioAcreditado=revisarUsuarioContraseña($conexion, $_POST["nick"], $_POST["password"]);
if($usuarioAcreditado!=null){
    //metemos los datos a las variables de sesion
    $_SESSION["IdUsuario"]=$usuarioAcreditado;
    $_SESSION["usuario"]=$_POST["nick"];
    $_SESSION["password"]=$_POST["password"];
    $_SESSION["mensaje"]="Bienvenido ".$_SESSION["usuario"];
    header("Location: ../paginaPrincipal.php");
}else{
    //mandamos un mensaje al usuario
    $_SESSION["mensaje"]="Usuario o Contraseña incorrecto";
    header("Location: ../index.php");
}

/**
 *
 *
 * revisa si el login es cierto , regresa false en caso de que el usuario no exista, regresa true en otro caso;
 * @param type $conexion de la base de datos
 * @param type $usuario a validar
 * @param type $password a validar
 *  @return null|string 
 */
function revisarUsuarioContraseña($conexion,$usuario,$password){
    $consultaVerificacion="SELECT * FROM Usuario WHERE Nick='".$usuario."'and Password='".$password."'";
    $resQuery=sqlite_query($conexion,$consultaVerificacion);
    $numeroFilas = sqlite_num_rows($resQuery);
    if($numeroFilas<1){
        return null;
    }
    $resFetAll=  sqlite_fetch_all($resQuery,SQLITE_ASSOC);
    return $resFetAll[0]["IdUsuario"];
}
?>