<?php
include "./Clases/Hamburguesa.php";
include "./Clases/Venta.php";
include "./Clases/CuponesDescuento.php";


$arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');
$arrayCupones = Archivos::LeerArchivoJSON("./Archivos/Cupones.json");
$venta = new Venta($_POST['mail'], $_POST['nombre'], $_POST['tipo'],$_POST['aderezo'], $_POST['cantidad']);
$devolucionId = $_POST['devolucionId'];

echo agregarHamburguesa($arrayHamburguesas, $venta,$arrayCupones, $devolucionId);

//Recibe por parametro un array de hamburguesas y un objeto de tipo venta  si existe el nombre y el tipo de hamburguesa
//la venta se realiza, disminuyento el stock de dicha hamburguesa
function agregarHamburguesa($arrayHamburguesas, $venta,$arrayCupones, $devolucionId)
{
    $arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
    $retorno = "No se vendio ninguna hamburguesa";
    $hamburguesaExistente = null;
    foreach ($arrayHamburguesas as &$hamburguesa) {
        if ($hamburguesa['nombre'] == $venta->nombreHamburguesa && $hamburguesa['tipo'] == $venta->tipoHamburguesa) {
            $hamburguesaExistente = &$hamburguesa;
            break;
        }
    }
    if ($hamburguesaExistente != null) {
        if($hamburguesaExistente['cantidad'] > 0 && $hamburguesaExistente['cantidad'] >= $venta->cantidadHamburguesa){
            $hamburguesaExistente['cantidad'] -= $venta->cantidadHamburguesa;
            $venta->precio = $hamburguesaExistente['precio'] * $venta->cantidadHamburguesa;
            if(aplicarDescuento($arrayCupones,$devolucionId, $venta)){
                $retorno = "Se vendio la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'] . "Con el descuento";
            }
            $retorno = "Se vendio la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'];
            $venta->GuardarImagenVenta();
            $arrayVentas[] = $venta;
            Archivos::GuardarObjetoJSON("./Archivos/Hamburguesa.json", $arrayHamburguesas);
            Archivos::GuardarObjetoJSON("./Archivos/Venta.json", $arrayVentas);
            Archivos::GuardarObjetoJSON("./Archivos/Cupones.json", $arrayCupones);
        }
        else{
            $retorno = "No hay stock suficiente";
        }
        
    }

    return $retorno;
}
function aplicarDescuento($arrayCupones, $devolucionId, $venta){
    $retorno = false;
    $cuponExistente = null;
    foreach ($arrayCupones as &$cupon) {
        if ($cupon['devolucionId'] == $devolucionId && compararFechas($venta['fecha'], $cupon['fecha']) == true) {
            $cuponExistente['estado'] = false;
            $cuponExistente = &$cupon;
            break;
        }
    }
    if($cuponExistente != null){
        $venta['precio'] *= $cuponExistente['porcentajeDescuento'];
        $retorno = true;
    }
    return $retorno;
}
function compararFechas($fecha1, $fecha2) {
    $retorno = false;
    $fechaObjeto1 = new DateTime($fecha1);
    $fechaObjeto2 = new DateTime($fecha2);

    if ($fechaObjeto1 > $fechaObjeto2) {
        $retorno = true; 
    } 
    return $retorno;
}