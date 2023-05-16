<?php
include "./Clases/Hamburguesa.php";


$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$resultado =  Buscar($nombre, $tipo);
echo $resultado;


function Buscar($nombre, $tipo)
{
    $retorno = "Error";
    $auxNombre = strtolower($nombre);
    $auxTipo = strtolower($tipo);
    $arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');

    foreach ($arrayHamburguesas as $hamburguesa) {
        if ($hamburguesa['nombre'] == $auxNombre && $hamburguesa['tipo'] == $auxTipo) {
            $retorno =  "Si Hay";
        } else {

            if ($hamburguesa['nombre'] != $auxNombre && $hamburguesa['tipo'] == $auxTipo) {
                $retorno = "No existe el nombre: " . $auxNombre;
            } elseif ($hamburguesa['nombre'] == $auxNombre && $hamburguesa['tipo'] != $auxTipo) {
                $retorno = "No existe el tipo: " . $auxTipo;
            } else {
                $retorno = "No existe el nombre: " . $auxNombre . " y tipo: " . $auxTipo;
            }
        }
    }

    return $retorno;
}
?>