<?php
    /* 
    Juan Sueldo 3D
    Aplicación No 23 (Registro JSON)
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario(nombre, clave,mail )por POST ,
    crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
    fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
    guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
    Usuario/Fotos/.
    retorna si se pudo agregar o no.
    Cada usuario se agrega en un renglón diferente al anterior.
    Hacer los métodos necesarios en la clase usuario.
    */

include('usuario.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $imagen = $_FILES['imagen'] ?? null;


    if (empty($nombre) || empty($clave) || empty($mail) || empty($imagen)) {

        echo "Error: faltan datos";
    } else {
 
        $id = rand(1, 10000);
  
        $usuario = new Usuario($nombre, $clave, $mail, $imagen);

   
        if ($usuario->agregarUsuario('usuarios.json')) {

            $destino = "Usuario/Fotos/" . $id . "_" . $nombre . "_" . $imagen['name'];
            move_uploaded_file($imagen['tmp_name'], $destino);


            echo "El usuario se ha agregado correctamente";
        } else {

            echo "Error: no se pudo agregar el usuario";
        }
    }
} else {

    echo "Error: la solicitud no es válida";
}
?>