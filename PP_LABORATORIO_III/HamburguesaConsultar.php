<?php
include "./Clases/Hamburguesa.php";


$nombre = $_POST['nombre'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$resultado =  Buscar($nombre, $tipo);
echo $resultado;


function Buscar($nombre, $tipo)
{
    $retorno = "Error";
    $arrayHamburguesas = Archivos::LeerArchivoJSON('./Archivos/Hamburguesa.json');

    foreach ($arrayHamburguesas as $hamburguesa) {
        if ($hamburguesa['nombre'] == $nombre && $hamburguesa['tipo'] == $tipo) {
            $retorno =  "Si Hay";
        } else {

            if ($hamburguesa['nombre'] != $nombre && $hamburguesa['tipo'] == $tipo) {
                $retorno = "No existe el nombre: " . $nombre;
            } elseif ($hamburguesa['nombre'] == $nombre && $hamburguesa['tipo'] != $tipo) {
                $retorno = "No existe el tipo: " . $tipo;
            } else {
                $retorno = "No existe el nombre: " . $nombre . " y tipo: " . $tipo;
            }
        }
    }

    return $retorno;
}
?>