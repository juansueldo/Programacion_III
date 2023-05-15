<?php
include "./Clases/Venta.php";
/*
ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.
*/

$listaDeVentas = array();
$listaDeJSON = Archivos::leerArchivoJSON("./Archivos/Venta.json");

$datos = json_decode(file_get_contents("php://input"), true);


if($listaDeJSON!=null &&count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $ventaJson)
    {
        $ventaAuxiliar = new Venta ($ventaJson["mail"],
        $ventaJson["saborPizza"],$ventaJson["tipoPizza"],$ventaJson["cantidadPizza"]);
        $ventaAuxiliar->id = $ventaJson['id'];
        $ventaAuxiliar->fechaPedido = $ventaJson['fechaPedido'];
        $ventaAuxiliar->numeroPedido = $ventaJson['numeroPedido'];
        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

foreach ($listaDeVentas as $venta ) {
    if($venta->numeroPedido == $datos["numeroPedido"] && $venta->mail == $datos["mail"])
    {
        $venta->saborPizza = $datos["saborPizza"];
        $venta->tipoPizza = $datos["tipoPizza"];
        $venta->cantidadPizza = $datos["cantidadPizza"];
        echo "Se modificó la venta\n";

    }
}


Archivos::guardarObjetoJSON("./Archivos/Venta.json",$listaDeVentas);


?>