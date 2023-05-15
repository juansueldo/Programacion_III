<?php
include "./Clases/Pizza.php";

$cargaPizzza = new Pizza($_POST['sabor'], $_POST['precio'], $_POST['tipo'], $_POST['cantidad']);
echo agregarPizza("./Archivos/Pizza.json", $cargaPizzza);

function agregarPizza($archivo, $cargaPizzza)
{
    $retorno = "No se agrego ninguna pizza";

    $pizzas = Archivos::leerArchivoJSON($archivo);
    $pizzaExistente = null;
    foreach ($pizzas as &$pizza) {
        if ($pizza['sabor'] == $cargaPizzza->sabor && $pizza['tipo'] == $cargaPizzza->tipo) {
            $pizzaExistente = &$pizza;
            break;
        }
    }
    if ($pizzaExistente != null) {
        $pizzaExistente['cantidad'] += $cargaPizzza->cantidad;
        $pizzaExistente['precio'] = $cargaPizzza->precio;
        $retorno = "Se modifico la pizza sabor: " . $pizzaExistente['sabor'] . ", del tipo: " . $pizzaExistente['tipo'];
    } else {
        $nuevaPizza = [
            'id' => $cargaPizzza->id,
            'sabor' => $cargaPizzza->sabor,
            'precio' => $cargaPizzza->precio,
            'tipo' => $cargaPizzza->tipo,
            'cantidad' => $cargaPizzza->cantidad
        ];
        $pizzas[] = $nuevaPizza;
        $cargaPizzza->GuardarImagenPizza();
        $retorno = "Se agrego una nueva pizza";
    }
    Archivos::guardarObjetoJSON($archivo, $pizzas);

    return $retorno;
}
    /* 
        PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
        guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
        identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
    */
