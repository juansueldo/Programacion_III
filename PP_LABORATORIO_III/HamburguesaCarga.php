<?php
include "./Clases/Hamburguesa.php";

$cargaHamburguesa = new Hamburguesa($_POST['nombre'], $_POST['precio'], $_POST['tipo'],$_POST['aderezo'], $_POST['cantidad']);
echo agregarHamburguesa ("./Archivos/Hamburguesa.json", $cargaHamburguesa);

function agregarHamburguesa($archivo, $cargaHamburguesa)
{
    $retorno = "No se agrego ninguna hamburguesa";

    $hamburguesas = Archivos::LeerArchivoJSON($archivo);
    $hamburguesaExistente = null;
    foreach ($hamburguesas as &$hamburguesa) {
        if ($hamburguesa['nombre'] == $cargaHamburguesa->nombre && $hamburguesa['tipo'] == $cargaHamburguesa->tipo) {
            $hamburguesaExistente = &$hamburguesa;
            break;
        }
    }
    if ($hamburguesaExistente != null) {
        $hamburguesaExistente['cantidad'] += $cargaHamburguesa->cantidad;
        $hamburguesaExistente['precio'] = $cargaHamburguesa->precio;
        $retorno = "Se modifico la hamburguesa: " . $hamburguesaExistente['nombre'] . ", del tipo: " . $hamburguesaExistente['tipo'];
    } else {
        $nuevaHamburguesa= [
            'id' => $cargaHamburguesa->id,
            'nombre' => $cargaHamburguesa->nombre,
            'precio' => $cargaHamburguesa->precio,
            'tipo' => $cargaHamburguesa->tipo,
            'aderezo' => $cargaHamburguesa->aderezo,
            'cantidad' => $cargaHamburguesa->cantidad
        ];
        $hamburguesas[] = $nuevaHamburguesa;
        $cargaHamburguesa->GuardarImagenHamburguesa();
        $retorno = "Se agrego una nueva hamburguesa";
    }
    Archivos::GuardarObjetoJSON($archivo, $hamburguesas);

    return $retorno;
}

