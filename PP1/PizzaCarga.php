<?php
include "Pizza.php";
    $sabor = $_POST['sabor'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';

    $pizza =  new Pizza($sabor, $precio, $tipo, $cantidad);
    if($pizza->agregarPizza('Pizza.json')){
        echo "Pizza agregada";
    }
?>