<?php
include "./Clases/Pizza.php";
include "./Clases/Venta.php";

/* 
    AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,
    si el ítem existe en Pizza.json, y hay stock guardar en la base de datos
 f   ( con la fecha, número de pedido y id autoincremental ) y se debe descontar la cantidad vendida del stock .
*/

$arrayPizza = Archivos::LeerArchivoJSON('./Archivos/Pizza.json');
$venta = new Venta($_POST['email'], $_POST['sabor'], $_POST['tipo'], $_POST['cantidad']);

echo agregarPizza($arrayPizza, $venta);

//Recibe por parametro un array de pizza y un objeto de tipo venta  si existe el sabor y el tipo de pizza
//la venta se realiza, disminuyento el stock de dicha pizza
function agregarPizza($arrayPizza, $venta)
{
    $arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
    $retorno = "No se agrego ninguna pizza";

    $pizzaExistente = null;
    foreach ($arrayPizza as &$pizza) {
        if ($pizza['sabor'] == $venta->saborPizza && $pizza['tipo'] == $venta->tipoPizza) {
            $pizzaExistente = &$pizza;
            break;
        }
    }
    if ($pizzaExistente != null) {
        if($pizzaExistente['cantidad'] > 0 && $pizzaExistente['cantidad'] >= $venta->cantidadPizza){
            $pizzaExistente['cantidad'] -= $venta->cantidadPizza;
            $retorno = "Se vendio la pizza sabor: " . $pizzaExistente['sabor'] . ", del tipo: " . $pizzaExistente['tipo'];
            $venta->GuardarImagenVenta();
            $arrayVentas[] = $venta;
            Archivos::GuardarObjetoJSON("./Archivos/Pizza.json", $arrayPizza);
            Archivos::GuardarObjetoJSON("./Archivos/Venta.json", $arrayVentas);
        }
        else{
            $retorno = "No hay stock suficiente";
        }
        
    } else {
        $retorno = "No se registro ninguna venta";
    }

    return $retorno;
}
