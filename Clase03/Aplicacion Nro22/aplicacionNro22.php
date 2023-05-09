<?php
include('usuario.php');
    $mail = $_POST['mail'];
    $clave = $_POST['clave'];
    
    $usuario = new Usuario($mail, $clave);
    $resultado = $usuario->verificarUsuario();
    
    echo $resultado;
    
?>