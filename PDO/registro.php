<?php
    include "usuario.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $email = $_POST['email'] ?? '';
        $localidad = $_POST['localidad'] ?? '';
    
    
        if (empty($nombre) || empty($apellido)||empty($clave) || empty($email) || empty($localidad)) {
    
            echo "Error: faltan datos";
        } else {
            $usuario = new Usuario($nombre, $apellido, $clave, $email, $localidad);
            echo "Usuario creado \n";
            if($usuario->InsertarUsuario()){
                echo "Usuario agregado";
            }
            else{
                echo "Error al agregar usuario";
            }    
        }
    }
