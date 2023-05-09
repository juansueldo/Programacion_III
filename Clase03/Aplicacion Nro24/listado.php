<?php
    include("usuario.php");
    /*
    Aplicación No 24 ( Listado JSON y array de usuarios)
    Archivo: listado.php
    método:GET
    Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos usuarios).
    En el caso de usuarios carga los datos del archivo usuarios.json.
    se deben cargar los datos en un array de usuarios. Retorna los datos que contiene ese array en una lista.
    Hacer los métodos necesarios en la clase usuario
    */
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $destino = "uploads/".$_FILES['listado']['name'];
        move_uploaded_file($_FILES['listado']['tmp_name'], $destino);
        if ($destino !== null) {
            $usuarios = Usuario::cargarUsuarios($destino);
            var_dump($usuarios);
        }
    }
    
?>

<!doctype html>
<html> 
    <head>
        <title>Subir Archivos</title>
    </head>
<body>		
    <form action="upload.php" method="get" enctype="multipart/form-data" >
        <input type="file" name="listado" />
        <input type="submit" value="subir" />
    </form>
</body>
</html>