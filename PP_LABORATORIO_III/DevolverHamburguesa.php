<?php


include "./Clases/Venta.php";
include "./Clases/Devolucion.php";
include "./Clases/CuponesDescuento.php";

$arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
$arrayCupones = Archivos::LeerArchivoJSON("./Archivos/Cupones.json");
$arrayDevoluciones = Archivos::LeerArchivoJSON("./Archivos/Devoluciones.json");

$numPedido = $_POST["numeroPedido"];
$venta = BuscarVenta($arrayVentas, $numPedido);

$indexDevolucion = Devolucion::BuscarDevolucion($arrayDevoluciones, $numPedido);

function BuscarVenta($arrayVentas, $numPedido){
	$ventaExistente = null;
    foreach ($arrayVentas as &$venta) {
        if ($venta['numeroPedido'] == $numPedido) {
            $ventaExistente = &$venta;
            break;
        }
    }
	return $ventaExistente;
}
function BuscarDevolucion($arrayVentas, $numPedido){
	$ventaExistente = null;
    foreach ($arrayVentas as &$venta) {
        if ($venta['numeroPedido'] == $numPedido) {
            $ventaExistente = &$venta;
            break;
        }
    }
	return $ventaExistente;
}


if ($venta != null) {
	if ($indexDevolucion == -1) {
		echo Devolucion::GuardarImagen($ventaExistente) ? "La imagen fue guardada\n" : "La imagen no pudo guardarse.\n";

		$cupon = new CuponDescuento($arrayDevoluciones[$indexDevolucion]->id, $_POST['causa']);
		array_push($arrayCupones, $cupon);
		Archivos::GuardarObjetoJSON( "./Archivos/Cupones.json", $arrayCupones);

		$devolucion = new Devolucion($cupon->causa, $numPedido, $cupon->id);
		array_push($arrayDevoluciones, $devolucion);
		Archivos::GuardarObjetoJSON("./Archivos/Devoluciones.json", $arrayDevoluciones);

		echo "Queja recibida! Por las molestias recibio un cupon de descuento $cupon->id";
	} else {
		echo "Ya se realizó una devolución por esta venta!\n";
	}
} else {
	echo "No existe una venta activa con número de pedido N°$numPedido.\n";
	echo "Los disponibles son:\n";
	foreach ($arrayVentas as $venta) {
		if ($venta->activo)
			echo '~ ' . $venta->numeroPedido . "\n";
	}
}