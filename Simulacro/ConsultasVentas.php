<?php
include "./Clases/Pizza.php";
include "./Clases/Venta.php";

/* 
   ConsultasVentas.php: necesito saber :
    a- la cantidad de pizzas vendidas
    b- el listado de ventas entre dos fechas ordenado por sabor.
    c- el listado de ventas de un usuario ingresado
    d- el listado de ventas de un sabor ingresado
*/
$arrayVentas = Archivos::leerArchivoJSON("./Archivos/Venta.json");
$sabor = $_POST['sabor'];
$mail = $_POST['mail'];

echo "a - Se vendieron " . PizzasVendidas($arrayVentas) . " de pizzas";
echo "\n********************************************************\n";
echo VentasPorSabor("01-01-2019", "31-12-2023", $arrayVentas);
echo "\n********************************************************\n";
echo MostrarVentasUsuario($mail, $arrayVentas);
echo "\n********************************************************\n";
echo MostrarVentasSabor($sabor, $arrayVentas);

function PizzasVendidas($arrayVentas)
{
    $retorno = 0;
    foreach ($arrayVentas as $venta) {
        $retorno += $venta['cantidadPizza'];
    }
    return $retorno;
}
function VentasPorSabor($fechaInicio, $fechaFin, $arrayVentas)
{
    foreach ($arrayVentas as $venta) {
        if ($venta['fechaPedido'] >= $fechaInicio && $venta['fechaPedido'] <= $fechaFin) {
            usort($arrayVentas, 'callbackSaboresFecha');
        }
    }
    return "b - Listado de ventas ordenadas por sabor: \n". MostrarVentas($arrayVentas);
}

function callbackSaboresFecha($venta1, $venta2)
{
    return strcmp($venta1['saborPizza'], $venta2['saborPizza']);
}

function MostrarVentas($ventas)
{
    $retorno = '';
    foreach ($ventas as $venta) {
        $retorno .= "\n Nro de pedido: " . $venta['numeroPedido'] . "- Fecha: " . $venta['fechaPedido'] . " - Sabor: " . $venta['saborPizza'] . " - Tipo: " . $venta['tipoPizza'] ;
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

function MostrarVentasSabor($sabor, $arrayVentas){
    $retorno = "No se registraron compras de la pizza sabor: ".$sabor;
    foreach ($arrayVentas as $venta){
        if ($venta['saborPizza'] == $sabor) {
            $auxVentas[] = $venta;

            $retorno ="d - Ventas del sabor: $sabor\n". MostrarVentas($auxVentas);
        }
    }
    return $retorno;
}