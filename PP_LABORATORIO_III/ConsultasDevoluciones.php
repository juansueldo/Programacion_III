<?php
/*
ConsultasDevoluciones.php:- 
a- Listar las devoluciones con cupones. 
b- Listar solo los cupones y su estado 
c- Listar devoluciones y sus cupones y si fueron usados

*/

include "./Clases/Devolucion.php";
include "./Clases/CuponesDescuento.php";

$arrayCupones = Archivos::LeerArchivoJSON("./Archivos/Cupones.json");
$arrayDevoluciones = Archivos::LeerArchivoJSON("./Archivos/Devoluciones.json");
$arrayCuponesUsados = array();


foreach($arrayCupones as $cupon){
    if ($cupon['estado'] == true)
        array_push($arrayCuponesUsados, $cupon);
}
if(!empty($arrayDevoluciones)){
    echo "a- Lista de devoluciones con cupones:\n";
    foreach ($arrayDevoluciones as $devolucion) {
        echo MostrarDevolucion($devolucion) . "\n";
    }
}else{
    echo "a- No hay ninguna devolución.\n";
}

if(!empty($arrayCupones)){
    echo "b- Lista de cupones:\n";
    foreach ($arrayCupones as $cupon) {
        echo MostrarCupon($cupon) . "\n";
    }
}else{
    echo "b- No hay ningún cupón.\n";
}

if(!empty($arrayCuponesUsados)){
    echo "c- Lista de cupones usados:\n";
    foreach ($arrayCuponesUsados as $cuponUsado) {
        echo MostrarCupon($cuponUsado) . "\n";
    }
}else{
    echo "c- No hay ningún cupón usado.\n";
}
function MostrarDevolucion($devolucion)
{
    $retorno = "Numero de devolucion: ". $devolucion['id'] . " Causa de devolucion: " . $devolucion['causa'] . " Pedido: " . $devolucion['numeroPedido'] . " Cupon otorgado: " . $devolucion['idCupon']. "\n";
    return $retorno;
}
function MostrarCupon($cupon)
{
    $estado = $cupon['estado'] ? "Utilizado" : "No utilizado";
    $retorno = "Numero de cupon: ". $cupon['devolucionId'] . " Porcentaje del cupon de descuento: ". $cupon['porcentajeDescuento'] . " Motivo: " . $cupon['causa'] . " Vencimiento: " . $cupon['fecha'] . " Estado: " . $estado . "\n";
    return $retorno;
}



?>