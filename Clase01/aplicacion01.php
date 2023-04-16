<?php
    //Alumno Juan Sueldo 3D
    /*Confeccionar un programa que sume todos los números enteros
    desde 1 mientras la suma no supere a 1000. 
    Mostrar los números sumados y al finalizar el proceso
    indicar cuantos números se sumaron.*/
    $suma = 0;
    $contador = 0;
    for($i = 1; $i < 1000; $i++)
    {
        $suma += $i;
        $contador++; 
        echo "\n $i";
    }
    echo "<br/> la cantidad de numeros sumados: $contador";
?>