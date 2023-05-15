<?php
    include "Pizza.php";

    $sabor = $_POST['sabor'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    
    $resultado =  Pizza::Buscar($sabor, $tipo);
    echo $resultado;

    
?>