<?php
include_once "./Clases/Hamburguesa.php";
include_once "./Clases/Venta.php";
include_once "./Clases/CuponesDescuento.php";


$arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');
$cupones = './Archivos/Cupones.json';
$arrayCupones = Archivos::LeerArchivoJSON($cupones);
$venta = new Venta($_POST['mail'], $_POST['nombreHamburguesa'], $_POST['tipoHamburguesa'],$_POST['aderezoHamburguesa'], $_POST['cantidadHamburguesa']);
$devolucionId = $_POST['devolucionId'];

echo agregarHamburguesa($arrayHamburguesas, $venta, $arrayCupones, $devolucionId);

function agregarHamburguesa($arrayHamburguesas, $venta, $arrayCupones, $devolucionId)
{
    $arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
    $retorno = "No se vendió ninguna hamburguesa";
    $hamburguesaExistente = empty('');
    foreach ($arrayHamburguesas as &$hamburguesa) {
        if ($hamburguesa['nombre'] == $venta->nombreHamburguesa && $hamburguesa['tipo'] == $venta->tipoHamburguesa) {
            $hamburguesaExistente = &$hamburguesa;
            break;
        }
    }
    if (!empty($hamburguesaExistente)) {
        if ($hamburguesaExistente['cantidad'] > 0 && $hamburguesaExistente['cantidad'] >= $venta->cantidadHamburguesa) {
            $hamburguesaExistente['cantidad'] -= $venta->cantidadHamburguesa;
            $venta->precio = $hamburguesaExistente['precio'] * $venta->cantidadHamburguesa;
            if (aplicarDescuento($arrayCupones, $devolucionId, $venta)) {
                $retorno = "Se vendió la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'] . " con el descuento.";
            } else {
                $retorno = "Se vendió la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'];
            }
            $venta->GuardarImagenVenta();
            $arrayVentas[] = $venta;
            Archivos::GuardarObjetoJSON("./Archivos/Hamburguesa.json", $arrayHamburguesas);
            Archivos::GuardarObjetoJSON("./Archivos/Venta.json", $arrayVentas);
            
            return $retorno; 
        } else {
            $retorno = "No hay stock suficiente";
        }
    }

    return $retorno;
}

function aplicarDescuento(array $arrayCupones, $devolucionId, $venta)
{
    $retorno = false;
    $cuponExistente = null;
    foreach ($arrayCupones as &$cupon) {
        if ($cupon['devolucionId'] == $devolucionId && $cupon['estado'] === false && compararFechas($cupon['fecha'], $venta->fechaPedido)){
            $cuponExistente = &$cupon;
            break;
        }
    }
    if ($cuponExistente !== null) {
        $venta->precio *= $cuponExistente['porcentajeDescuento'];
        $cuponExistente['estado'] = true;
        Archivos::GuardarObjetoJSON("./Archivos/Cupones.json", $arrayCupones);
        $retorno = true;
    }
    return $retorno;
}

function compararFechas($fecha1, $fecha2)
{
    $retorno = false;
    $fechaObjeto1 = new DateTime($fecha1);
    $fechaObjeto2 = new DateTime($fecha2);

    if ($fechaObjeto1 >= $fechaObjeto2) {
        $retorno = true;
    }
    return $retorno;
}
