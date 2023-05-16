<?php
include "./Clases/Hamburguesa.php";
include "./Clases/Venta.php";



$arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');

$venta = new Venta($_POST['mail'], $_POST['nombre'], $_POST['tipo'],$_POST['aderezo'], $_POST['cantidad']);

echo agregarHamburguesa($arrayHamburguesas, $venta);

//Recibe por parametro un array de hamburguesas y un objeto de tipo venta  si existe el nombre y el tipo de hamburguesa
//la venta se realiza, disminuyento el stock de dicha hamburguesa
function agregarHamburguesa($arrayHamburguesas, $venta)
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
            $retorno = "Se vendio la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'];
            $venta->GuardarImagenVenta();
            $arrayVentas[] = $venta;
            Archivos::GuardarObjetoJSON("./Archivos/Hamburguesa.json", $arrayHamburguesas);
            Archivos::GuardarObjetoJSON("./Archivos/Venta.json", $arrayVentas);
        }
        else{
            $retorno = "No hay stock suficiente";
        }
        
    }

    return $retorno;
}
