<?php
include "./Clases/Pizza.php";
    /*
        PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
        retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
    */

    //if (isset($_POST['Sabor']) && isset($_POST['Tipo'])) {
            $sabor = $_POST['sabor'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            
            $resultado =  Buscar($sabor, $tipo);
            echo $resultado;
    //}
    function  Buscar($sabor, $tipo){
        $retorno = "No se encontró coincidencia para sabor: " . $sabor . " y tipo: " . $tipo;
        $arrayPizza = Archivos::leerArchivoJSON('./Archivos/Pizza.json');
        
        foreach ($arrayPizza as $pizza) {
            if ($pizza['sabor'] == $sabor && $pizza['tipo'] == $tipo) {
                $retorno =  "Si Hay";
            }
        }
        
        if (!buscarSabor($sabor, $arrayPizza) && buscarTipo($tipo, $arrayPizza)) {
            $retorno = "No existe el sabor: " . $sabor;
        }
        
        if (!buscarTipo($tipo, $arrayPizza) && buscarSabor($sabor, $arrayPizza)) {
            $retorno = "No existe el tipo: " . $tipo;
        }
        
        return $retorno;
    }
    
    function buscarSabor($sabor, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza['sabor'] === $sabor) {
                return true;
            }
        }
        return false;
    }
    
    function buscarTipo($tipo, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza['tipo'] === $tipo) {
                return true;
            }
        }
        return false;
    }
    
?>