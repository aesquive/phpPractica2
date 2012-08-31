<?php

header('Content-Type: text/html; charset=UTF-8');

$nombre_base = "despensa.db";

$conexion = sqlite_open($nombre_base) or die("Conexion a base de datos fallida");
if ($conexion) {
    echo 'La conexión se ha establecido -> la base de datos' . $nombre_base . '  se ha creado';
    chmod($nombre_base, 0777);
}

//la tabla de Articulos se conforma por Id (int), Nombre (vc), Departamento(vc) , Cantidad(Date)
$consultaInsert =
        <<<SQL

   
        INSERT INTO Articulos (Nombre,Departamento,Cantidad) VALUES 
            ('Leche ','Abarrotes',10); 
   
        INSERT INTO Articulos (Nombre,Departamento,Cantidad) VALUES 
            ('Mermelada de Fresa ','Abarrotes',5); 
            

        INSERT INTO Articulos (Nombre,Departamento,Cantidad) VALUES 
            ('PS3 ','Electronica',2); 
   
        INSERT INTO Articulos (Nombre,Departamento,Cantidad) VALUES 
            ('Arroz','Abarrotes',50);
            

        INSERT INTO Articulos (Nombre,Departamento,Cantidad) VALUES 
            ('Balon Soccer','Deportes',25); 
   

   
SQL;

$resultadoCreate = sqlite_exec($consultaInsert, $conexion);
echo '<br>';
if ($resultadoCreate) {
    echo 'La insercion de elementos fue exitosa';
} else {
    echo 'La insercion de elementos no fue exitosa';
}
?>