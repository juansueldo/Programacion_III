<?php
include ("altaProducto.php");
    /*
    Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )
    por POST , crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
    crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
    si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo renglón
    Retorna un :
    “Ingresado” si es un producto nuevo
    “Actualizado” si ya existía y se actualiza el stock.
    “no se pudo hacer“ si no se pudo hacer
    Hacer los métodos necesarios en la clase
    */

    $codigo_barra = $_POST['codigo_barra'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

// Crear un objeto Producto
$producto = new Producto($codigo_barra, $nombre, $tipo, $stock, $precio);

?>