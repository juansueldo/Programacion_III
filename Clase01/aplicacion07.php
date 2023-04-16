<?php
    /*
    Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
    Luego imprimir (utilizando la estructura for) cada uno en una línea distinta
    (recordar que el salto de línea en HTML es la etiqueta <br/>).
    Repetir la impresión de los números utilizando las estructuras while y foreach.
    */
    $array = array();
    $num = 0;
    echo "Impresion desde el for <br/>";
    for($i = 0; $i < 10; $i++){
        if($i % 2 != 0){
            $array[$i] = $i;
            echo "$array[$i] <br/>";
        }
    }
    echo "Impresion desde el foreach <br/>";
    foreach($array as $valor){
        echo "$valor <br/>";
    }
    echo "Impresion desde el while <br/>";
    while($num < 10){
        if($num % 2 != 0){
            echo "$array[$num] <br/>";
        }
        $num++;
    }
?>