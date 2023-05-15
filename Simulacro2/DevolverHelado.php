<?php
/* 6-
Guardar en el archivo (devoluciones.json y cupones.json):
a- Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir, se ingresa una
foto del cliente enojado,esto debe generar un cupón de descuento(id, devolucion_id, porcentajeDescuento,
estado[usado/no usadol]) con el 10% de descuento para la próxima compra.

Laporte Marcos*/

include_once "./Clases/Venta.php";
include_once "./Clases/CuponDeDescuento.php";
include_once "./Clases/Devolucion.php";

$_arrayVentas = Archivos::LeerArchivoJSON("ventas.json");
$_arrayCupones = Archivos::LeerArchivoJSON("cupones.json");
$_arrayDevoluciones = Archivos::LeerArchivoJSON("devoluciones.json");

$numPedido = empty($_POST['numeroDePedido']) ? 0 : (int)$_POST['numeroDePedido'];
$indexVenta = Venta::BuscarVenta($_arrayVentas, $numPedido);
$indexDevolucion = Devolucion::BuscarDevolucion($_arrayDevoluciones, $numPedido);

if ($indexVenta != -1) {
	if ($indexDevolucion == -1) {
		echo Devolucion::GuardarImagenClienteEnojado($_arrayVentas[$indexVenta]) ? "La imagen fue guardada con éxito!\n" : "La imagen no pudo guardarse.\n";

		$cupon = new CuponDeDescuento($_arrayDevoluciones[$indexDevolucion]->_id, $_POST['causa']);
		array_push($_arrayCupones, $cupon);
		Archivos::GuardarObjetoJSON( "cupones.json", $_arrayCupones);

		$devolucion = new Devolucion($cupon->_causa, $numPedido, $cupon->_id);
		array_push($_arrayDevoluciones, $devolucion);
		Archivos::GuardarObjetoJSON("devoluciones.json", $_arrayDevoluciones);

		echo "Queja anotada! El número de su cupón es $cupon->_id";
	} else {
		echo "Ya se realizó una devolución por esta venta!\n";
	}
} else {
	echo "No existe una venta activa con número de pedido N°$numPedido.\n";
	echo "Los disponibles son:\n";
	foreach ($_arrayVentas as $venta) {
		if ($venta->_activo)
			echo '~ ' . $venta->_numeroPedido . "\n";
	}
}