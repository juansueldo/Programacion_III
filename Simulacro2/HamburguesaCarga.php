<?php
include "./Clases/Hamburguesa.php";

$cargaHamburguesa = new Hamburguesa($_POST['nombre'], $_POST['precio'], $_POST['tipo'], $_POST['cantidad']);
echo agregarPizza("./Archivos/Hamburguesa.json", $cargaHamburguesa);

function agregarPizza($archivo, $cargaHamburguesa)
{
    $retorno = "No se agrego ninguna hamburguesa";

    $hamburguesas = Archivos::LeerArchivoJSON($archivo);
    $hamburguesaExistente = null;
    foreach ($hamburguesas as &$hamburguesa) {
        if ($hamburguesa['sabor'] == $cargaHamburguesa->sabor && $hamburguesa['tipo'] == $cargaHamburguesa->tipo) {
            $hamburguesaExistente = &$hamburguesa;
            break;
        }
    }
    if ($hamburguesaExistente != null) {
        $hamburguesaExistente['cantidad'] += $cargaHamburguesa->cantidad;
        $hamburguesaExistente['precio'] = $cargaHamburguesa->precio;
        $retorno = "Se modifico la pizza sabor: " . $hamburguesaExistente['sabor'] . ", del tipo: " . $hamburguesaExistente['tipo'];
    } else {
        $nuevaHamburguesa= [
            'id' => $cargaHamburguesa->id,
            'sabor' => $cargaHamburguesa->sabor,
            'precio' => $cargaHamburguesa->precio,
            'tipo' => $cargaHamburguesa->tipo,
            'cantidad' => $cargaHamburguesa->cantidad
        ];
        $hamburguesas[] = $nuevaHamburguesa;
        $cargaHamburguesa->GuardarImagenPizza();
        $retorno = "Se agrego una nueva pizza";
    }
    Archivos::guardarObjetoJSON($archivo, $hamburguesas);

    return $retorno;
}

