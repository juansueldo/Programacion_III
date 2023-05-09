<?php
include "Pizza.php";
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
        $arrayPizza = Pizza::LeerPizzas('Pizza.json');
        
        foreach ($arrayPizza as $pizza) {
            if ($pizza->sabor == $sabor && $pizza->tipo == $tipo) {
                return "Si Hay";
            }
        }
        
        if (!buscarSabor($sabor, $arrayPizza)) {
            return "No existe el sabor: " . $sabor;
        }
        
        if (!buscarTipo($tipo, $arrayPizza)) {
            return "No existe el tipo: " . $tipo;
        }
        
        return "No se encontró coincidencia para sabor: " . $sabor . " y tipo: " . $tipo;
    }
    
    function buscarSabor($sabor, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza->sabor === $sabor) {
                return true;
            }
        }
        return false;
    }
    
    function buscarTipo($tipo, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza->tipo === $tipo) {
                return true;
            }
        }
        return false;
    }
    
?>