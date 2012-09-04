<?php
//creamos la estructura y la conexion
header('Content-Type: text/html; charset=UTF-8');
$nombreBase = "favoritos.db";
$conexion = sqlite_open($nombreBase) or die("La conexion a la base de favoritos no se pudo realizar");
if ($conexion) {
    echo 'La conexion se ha establecido-> la base de datos favorito.db se ha creado';
}
//create table  de favoritos
$consultaCreateFavoritos = "CREATE TABLE Favoritos(
    IdFavorito INTEGER PRIMARY KEY NOT NULL,
    IdUsuario INTEGER NOT NULL,
    Titulo VARCHAR (100),
    Url VARCHAR (100),
    Descripcion VARCHAR (100),
    Comentarios VARCHAR (100),
    Categoria VARCHAR (100),
    Valoracion INTEGER 
    );";
//create table de usuarios
$consultaCreateUsuario = "CREATE TABLE Usuario(
    IdUsuario INTEGER PRIMARY KEY NOT NULL,
    Nick VARCHAR (100),
    Password VARCHAR (100),
    Correo VARCHAR (100),
    Nombres VARCHAR(100),
    Apellidos VARCHAR(100),
    Ocupacion VARCHAR(100),
    Perfil INTEGER,
    Edad INTEGER
);";
//create table de log
$consultaCreateLog = "CREATE TABLE Log(
    IdLog INTEGER PRIMARY KEY NOT NULL,
    IdUsuario INTEGER NOT NULL,
    Fecha DATE,
    Ip VARCHAR(100),
    Navegador VARCHAR(100)
);";
//ejecucion de todos los create
$exeCreateFavs = sqlite_exec($consultaCreateFavoritos, $conexion);
$exeCreateUsu = sqlite_exec($consultaCreateUsuario, $conexion);
$exeCreateLog = sqlite_exec($consultaCreateLog, $conexion);
imprimirConsultaSatisfactoria($exeCreateFavs, "<br>La Creacion de tabla Favoritos fue satisfactoria", "<br>Error al crear tabla favoritos");
imprimirConsultaSatisfactoria($exeCreateUsu, "<br>La Creacion de tabla Usuario fue satisfactoria", "<br>Error al crear tabla usuario");
imprimirConsultaSatisfactoria($exeCreateLog, "<br>La Creacion de tabla Log fue satisfactoria", "<br>Error al crear tabla log");

//insert de los favoritos
//IdFavorito ,IdUsuario ,Titulo ,Url ,Descripcion,Comentarios ,Categoria,Valoracion 
$consultaInsertFavoritos = "INSERT INTO Favoritos (IdUsuario,Titulo,Url,Descripcion,Comentarios,Categoria,Valoracion) VALUES
                                                (1,'Google','www.google.com','Buscador genial','Buen Buscador','consultas',10);
                                                
                            INSERT INTO Favoritos (IdUsuario,Titulo,Url,Descripcion,Comentarios,Categoria,Valoracion) VALUES
                                                (2,'Gmail','www.gmail.com','Correo electronico de Google','De los mejores correos','emails',10);";

//insert de los usuarios
//IdUsuario ,Nick ,Password ,Correo,Nombres ,Apellidos,Ocupacion,Perfil ,Edad
$consultaInsertUsu = "INSERT INTO Usuario(IdUsuario,Nick,Password,Correo,Nombres,Apellidos,Ocupacion,Perfil,Edad) VALUES
                   (1,'aesquive','pas','esquivel.vega.alberto@gmail.com','Alberto Emmanuel','Esquivel Vega','Estudiante',1,1);
                   
                    INSERT INTO Usuario(IdUsuario,Nick,Password,Correo,Nombres,Apellidos,Ocupacion,Perfil,Edad) VALUES
                   (2,'jmillan','pas1','jmillan@correo.com','Josefa','Millan Carrillo','Empleado',1,1);
                                        
";
//insert de los logs
//    IdLog ,IdUsuario ,Fecha ,Ip ,Navegador 
$consultaInsertLog="INSERT INTO Log(IdUsuario,Fecha,Ip,Navegador) VALUES
                    (1,2012-09-04,'80.80.80.80','Chrome');
                    INSERT INTO Log(IdUsuario,Fecha,Ip,Navegador) VALUES
                    (2,2012-08-04,'80.80.80.80','IE');";

//ejecucion de los inserts
$exeInsertFavs=  sqlite_exec($consultaInsertFavoritos,$conexion);
$exeInsertUsu=  sqlite_exec($consultaInsertUsu,$conexion);
$exeInsertLog=  sqlite_exec($consultaInsertLog,$conexion);
imprimirConsultaSatisfactoria($exeInsertFavs, "<br>La Insercion de tabla Favoritos fue satisfactoria", "<br>Error al insertar en tabla favoritos");
imprimirConsultaSatisfactoria($exeInsertUsu, "<br>La Insercion de tabla Usuario fue satisfactoria", "<br>Error al insertar en tabla usuario");
imprimirConsultaSatisfactoria($exeInsertLog,"<br>La Insercion de tabla Log fue satisfactoria", "<br>Error al insertar en tabla log");

/**
 *Funcion que imprima si la variable es true imprime el textosatisfactorio , en otro caso el texto de error
 * @param type $variable
 * @param type $textoSatisfactorio
 * @param type $textoError 
 */
function imprimirConsultaSatisfactoria($variable, $textoSatisfactorio, $textoError) {
    if ($variable) {
        echo $textoSatisfactorio;
    } else {
        echo $textoError;
    }
}

?>
