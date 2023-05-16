<?php
include "./Clases/Venta.php";


$listaDeVentas = array();
$listaDeJSON = Archivos::LeerArchivoJSON("./Archivos/Venta.json");

$datos = json_decode(file_get_contents("php://input"), true);


if($listaDeJSON!=null && count($listaDeJSON)>0)
{
    foreach ($listaDeJSON as $ventaJson)
    {
        $ventaAuxiliar = new Venta ($ventaJson["mail"], $ventaJson["nombreHamburguesa"],
        $ventaJson["tipoHamburguesa"], $ventaJson["aderezoHamburguesa"], $ventaJson["cantidadHamburguesa"]);
        $ventaAuxiliar->id = $ventaJson['id'];
        $ventaAuxiliar->fechaPedido = $ventaJson['fechaPedido'];
        $ventaAuxiliar->numeroPedido = $ventaJson['numeroPedido'];
        $ventaAuxiliar->precio = $ventaJson['precio'];
        array_push($listaDeVentas,$ventaAuxiliar);
    }
}

foreach ($listaDeVentas as $venta ) {
    if($venta->numeroPedido == $datos["numeroPedido"] && $venta->mail == $datos["mail"])
    {
        $venta->nombreHamburguesa = $datos["nombreHamburguesa"];
        $venta->tipoHamburguesa = $datos["tipoHamburguesa"];
        $venta->aderezoHamburguesa = $datos["aderezoHamburguesa"];
        $venta->cantidadHamburguesa = $datos["cantidadHamburguesa"];
        $venta->precio = $datos["precio"];
        echo "Se modificó la venta\n";

    }
  
}




Archivos::GuardarObjetoJSON("./Archivos/Venta.json",$listaDeVentas);


?>