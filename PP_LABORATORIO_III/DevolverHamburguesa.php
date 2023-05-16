<?php


include "./Clases/Venta.php";
include "./Clases/Devolucion.php";
include "./Clases/CuponesDescuento.php";

$arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
$arrayCupones = Archivos::LeerArchivoJSON("./Archivos/Cupones.json");
$arrayDevoluciones = Archivos::LeerArchivoJSON("./Archivos/Devoluciones.json");

$numeroPedido = $_POST["numeroPedido"];
$causa = $_POST["causa"];

$ventas = Archivos::LeerArchivoJSON(".Ventas.json");
$ventaExistente = DevolverVenta($arrayVentas, $numeroPedido);


if($ventaExistente != null ){
    echo "Pedido encontrado \n";
    $devolucion = new Devolucion($causa, $ventaExistente['numeroPedido'], 904);
    Archivos::GuardarObjetoJSON("./Archivos/Devoluciones.json",$devolucion);
    Devolucion::GuardarImagenClienteEnojado($ventaExistente);
    $cupon = new CuponDescuento($devolucion->idCupon, $devolucion->causa,$ventaExistente['fechaPedido']);
    Archivos::GuardarObjetoJSON("./Archivos/Cupones.json",$cupon);
    echo ModificarVenta("./Archivos/Venta.json", $ventaExistente);
}
else{
    echo "El pedido no existe \n";
}


function DevolverVenta($arrayVentas, $numeroPedido){
    $venta = null;
    foreach ($arrayVentas as &$auxVenta) {
        if ($auxVenta['numeroPedido'] == $numeroPedido && $auxVenta['activo'] == true) {
            $venta = &$auxVenta;
            break;
        }
    }
    return $venta;
}
function ModificarVenta($archivo, $ventaExistente)
{
    $retorno = "No se modifico ninguna venta";

    $ventas = Archivos::LeerArchivoJSON($archivo);
    $ventaAuxiliar = null;
    foreach ($ventas as &$aux) {
        if ($aux['numeroPedido'] == $ventaExistente['numeroPedido']) {
            $ventaAuxiliar = &$aux;
            break;
        }
    }
    if ($ventaAuxiliar != null) {
        if($ventaAuxiliar['activo'] == true){
            $ventaAuxiliar['activo'] = false;
            $retorno = "Se modifico la venta";
        }
        else{
            $retorno = "La venta ya tiene una devolucion";
        }
    }
    Archivos::GuardarObjetoJSON($archivo, $ventas);

    return $retorno;
}




