<?php
include "./Clases/Pizza.php";
include "./Clases/Venta.php";
    /* 
    AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,
    si el ítem existe en Pizza.json, y hay stock guardar en la base de datos
    ( con la fecha, número de pedido y id autoincremental ) y se debe descontar la cantidad vendida del stock .
    */

    $email = $_POST['email'];
    $sabor = $_POST['sabor'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];

    $venta =  new Venta($email, 1);
    if(Pizza::VentaPizza($sabor, $tipo, $cantidad)){
        echo "Vendido";
        Archivos::guardarObjetoJSON("./Archivos/Venta.json", $venta);
    }
    else{
        echo "no se vendio";
    }
?>