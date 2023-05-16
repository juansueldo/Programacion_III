<?php
include "./Clases/Hamburguesa.php";
include "./Clases/Venta.php";

/* 
   a- La cantidad de Hamburguesas vendidas en un día en particular, si no se pasa fecha, se muestran sólo las
del día de ayer.
b- El listado de ventas entre dos fechas ordenado por nombre.
c- El listado de ventas de un usuario ingresado.
d- El listado de ventas de un tipo ingresado.
e- Listado de ventas de aderezo “Ketchup”
*/
$arrayVentas = Archivos::LeerArchivoJSON("./Archivos/Venta.json");
$fecha = $_POST['fecha'];
$fechaIncio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$tipo = $_POST['tipo'];
$mail = $_POST['mail'];

echo "a - Se vendieron " . HamburguesasVendidas($arrayVentas, $fecha) . " de hamburguesas";
echo "\n********************************************************\n";
echo VentasPorNombre($fechaIncio, $fechaFin, $arrayVentas);
echo "\n********************************************************\n";
echo  MostrarVentasUsuario($mail, $arrayVentas);
echo "\n********************************************************\n";
echo MostrarVentasTipo($tipo, $arrayVentas);
echo "\n********************************************************\n";
echo MostrarVentasAderezo("ketchup",$arrayVentas);

function HamburguesasVendidas($arrayVentas, $fecha = '14-05-2023')
{
    $retorno = 0;
    foreach ($arrayVentas as $venta) {
        if($venta['fechaPedido'] == $fecha){
            $retorno += $venta['cantidadHamburguesa'];
        }
    }
    return $retorno;
}
function VentasPorNombre($fechaInicio, $fechaFin, $arrayVentas)
{
    foreach ($arrayVentas as $venta) {
        if ($venta['fechaPedido'] >= $fechaInicio && $venta['fechaPedido'] <= $fechaFin) {
            usort($arrayVentas, 'callbackNombreFecha');
        }
    }
    return "b - Listado de ventas ordenadas por nombre: \n". MostrarVentas($arrayVentas);
}

function callbackNombreFecha($venta1, $venta2)
{
    return strcmp($venta1['nombreHamburguesa'], $venta2['nombreHamburguesa']);
}

function MostrarVentas($ventas)
{
    $retorno = '';
    foreach ($ventas as $venta) {
        $retorno .= "\n Nro de pedido: " . $venta['numeroPedido'] . "- Fecha: " . $venta['fechaPedido'] . " - Nombre: " . $venta['nombreHamburguesa'] . " - Tipo: " . $venta['tipoHamburguesa'] ;
    }

    return $retorno;
}
function MostrarVentasUsuario($usuario, $arrayVentas){
    $retorno = "No se registraron compras por el usuario: ".$usuario;
    foreach ($arrayVentas as $venta){
        if ($venta['mail'] == $usuario) {
            $auxVentas[] = $venta;

            $retorno = "c - Compras realizadas por el usuario: $usuario\n". MostrarVentas($auxVentas);
        }
    }
    return $retorno;
}

function MostrarVentasTipo($tipo, $arrayVentas){
    $retorno = "No se registraron compras de la hamburguesa del tipo: ".$tipo;
    foreach ($arrayVentas as $venta){
        if ($venta['tipoHamburguesa'] == $tipo) {
            $auxVentas[] = $venta;

            $retorno ="d - Ventas de la hamburguesa: $tipo\n". MostrarVentas($auxVentas);
        }
    }
    return $retorno;
}

function MostrarVentasAderezo($aderezo, $arrayVentas){
    $retorno = "No se registraron compras de la hamburguesa del aderezo: ".$aderezo;
    foreach ($arrayVentas as $venta){
        if ($venta['aderezoHamburguesa'] == $aderezo) {
            $auxVentas[] = $venta;

            $retorno ="d - Ventas de la hamburguesa: $aderezo\n". MostrarVentas($auxVentas);
        }
    }
    return $retorno;
}