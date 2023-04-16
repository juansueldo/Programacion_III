<?php
    /*
    Juan Sueldo 3D
    Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número
    (utilizar la función rand). Mediante una estructura condicional,
    determinar si el promedio de los números son mayores, menores o iguales que 6.
    Mostrar un mensaje por pantalla informando el resultado.*/

    $array = array();
    $acum= 0;
    $lenght = 5;

    for($i = 0; $i < $lenght; $i++){
        $array[$i] = rand(1,10);
        $acum += $array[$i];
    }
    $prom = round($acum / $lenght);
    if($prom > 6){
        echo "El promedio es mayor a 6: $prom";
    }
    else if($prom < 6){
        echo "El promedio es menor a 6: $prom";
    }
    else{
        echo "El promedio es igual a 6: $prom";
    }
    
?>