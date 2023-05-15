<?php
include "./Clases/Pizza.php";
/*
        PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
        retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
    */

$sabor = $_POST['sabor'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$resultado =  Buscar($sabor, $tipo);
echo $resultado;


function Buscar($sabor, $tipo)
{
    $retorno = "Error";
    $arrayPizza = Archivos::LeerArchivoJSON('./Archivos/Pizza.json');

    foreach ($arrayPizza as $pizza) {
        if ($pizza['sabor'] == $sabor && $pizza['tipo'] == $tipo) {
            $retorno =  "Si Hay";
        } else {

            if ($pizza['sabor'] != $sabor && $pizza['tipo'] == $tipo) {
                $retorno = "No existe el sabor: " . $sabor;
            } elseif ($pizza['sabor'] == $sabor && $pizza['tipo'] != $tipo) {
                $retorno = "No existe el tipo: " . $tipo;
            } else {
                $retorno = "No existe el sabor: " . $sabor . " y tipo: " . $tipo;
            }
        }
    }



    return $retorno;
}
