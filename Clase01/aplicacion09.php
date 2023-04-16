<?php
    /*
    Realizar las líneas de código necesarias para generar un Array asociativo $lapicera,
    que contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’.
    Crear, cargar y mostrar tres lapiceras.
    */
    $lapicera = [];
    $lapicera1 = ["color"=> "azul", "marca"=> "Bic", "trazo"=> "fino", "precio" => 200];
    $lapicera2 = ["color"=> "negro", "marca"=> "Parker", "trazo"=> "grueso", "precio" => 350];
    $lapicera3 = ["color"=> "verde", "marca"=> "Pelican", "trazo"=> "fino", "precio" => 430];
  

    array_push($lapicera, $lapicera1);
    array_push($lapicera, $lapicera2);
    array_push($lapicera, $lapicera2);

    foreach($lapicera as $k => $valor){
        echo "Lapicera " .$k+1 . "<br/>";
        foreach($valor as $k2 => $valor2){
            echo "$k2: $valor2<br/>";
        }
        echo "<br/>";
    }