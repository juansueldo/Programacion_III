<?php
    /*
    Juan Sueldo 3D
    Realizar un programa que en base al valor numérico de una variable
    $num, pueda mostrarse por pantalla, el nombre del número
    que tenga dentro escrito con palabras, para los números
    entre el 20 y el 60.
    Por ejemplo, si $num = 43 debe mostrarse por pantalla
    “cuarenta y tres”.
    */

    $num = 53;

    if($num >= 20 && $num <= 60)
    {
        $decena = floor($num /10);
        $unidad = $num % 10;
    }
    switch($decena)
    {
        case 2:
            $strDecena = "Veinte";
            break;
        case 3:
            $strDecena = "Treinta";
            break;
        case 4:
            $strDecena = "Cuarenta";
            break;
        case 5:
            $strDecena = "Cincuenta";
            break;
        case 6:
            $strDecena = "Sesenta";
            break;
        default:
            $strDecena = "Valor no valido";
            break;
    }
    if($unidad > 0){
        switch($unidad){
            case 1:
                $strUnidad = "y uno";
                break;
            case 2:
                $strUnidad = "y dos";
                break;
            case 3:
                $strUnidad = "y tres";
                break;
            case 4:
                $strUnidad = "y cuatro";
                break;
            case 5:
                $strUnidad = "y cinco";
                break;
            case 6:
                $strUnidad = "y seis";
                break;
            case 7:
                $strUnidad = "y siete";
                break;
            case 8:
                $strUnidad = "y ocho";
                break;
            case 9:
                $strUnidad = "y nueve";
                break;
            default:
                $strUnidad = " ";
                break;
        }
    }
    else{
        $strUnidad = " ";
    }
    
    echo "$strDecena \n $strUnidad";
?>