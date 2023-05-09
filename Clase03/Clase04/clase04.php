<?php
    $destino = "uploads/".$_FILES['archivo']['name'];
    move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
    

?>
<!doctype html>
<html> 
    <head>
        <title>Subir Archivos</title>
    </head>
<body>		
    <form action="upload.php" method="post" 
    enctype="multipart/form-data" >
        <input type="file" name="archivo" />
        <input type="submit" value="subir" />
    </form>
</body>
</html>