<?php
include "./Clases/Hamburguesa.php";


$arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');
$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$resultado =  Buscar($nombre, $tipo, $arrayHamburguesas);
echo $resultado;


function Buscar($nombre, $tipo, $listaHamburguesas)
{
    $retorno = "Error";
    $auxNombre = strtolower($nombre);
    $auxTipo = strtolower($tipo);

    foreach ($listaHamburguesas as $hamburguesa) {
        if ($hamburguesa['nombre'] === $auxNombre && $hamburguesa['tipo'] === $auxTipo) {
            $retorno =  "Si Hay";
            break;
        } else {

            if ($hamburguesa['nombre'] !== $auxNombre && $hamburguesa['tipo'] === $auxTipo) {
                $retorno = "No existe el nombre: " . $auxNombre;
            } elseif ($hamburguesa['nombre'] === $auxNombre && $hamburguesa['tipo'] !== $auxTipo) {
                $retorno = "No existe el tipo: " . $auxTipo;
            } else {
                $retorno = "No existe el nombre: " . $auxNombre . " y tipo: " . $auxTipo;
            }
        }
    }

    return $retorno;
}
?>