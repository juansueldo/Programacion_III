<?php
try{
    $user = "root";

    $conStr= "mysql:host=localhost;dbname=abm";
    $pdo = new PDO($conStr, $user);
    echo("Conexión establecida");
    $sentencia = $pdo->prepare('SELECT * FROM producto');
    $sentencia->execute();
    
    $catidadFilas = $sentencia->rowCount();


    echo "cantidad de filas: ".$catidadFilas."<br>";

    /*while($fila = $sentencia->fetch(PDO::FETCH_ASSOC))
    { 
      print_r($fila['titulo'].$fila['año']."<br>");
      print("<br>\n");

    }*/
    //$consulta->fetch(PDO::FETCH_BOUND);


    echo $consulta;

   /* $sentencia = $pdo->prepare('SELECT * FROM producto WHERE id = 1001');
    $sentencia->execute(array(':id' => 1001));*/
 
}
catch(PDOException $e){
    echo ("Error: " . $e->getMessage());
}

?>