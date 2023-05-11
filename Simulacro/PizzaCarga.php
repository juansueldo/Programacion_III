<?php
include "./Clases/Pizza.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
        $sabor = $_POST['sabor'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        $cantidad = $_POST['cantidad'] ?? '';

        $pizza =  new Pizza($sabor, $precio, $tipo, $cantidad);
        if($pizza->agregarPizza('./Archivos/Pizza.json')){
            echo "Pizza agregada";
        }
}
    /* 
        PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
        guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
        identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
    */
?>
    
    
    
    
