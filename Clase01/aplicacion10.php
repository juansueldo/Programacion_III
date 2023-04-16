<?php
    /*
    Realizar las líneas de código necesarias para generar un Array asociativo
    y otro indexado que contengan como elementos tres Arrays del punto anterior cada uno.
    Crear, cargar y mostrar los Arrays de Arrays. 
    */
    $lapicera["uno"] = ["color"=> "azul", "marca"=> "Bic", "trazo"=> "fino", "precio" => 200];
    $lapicera["dos"] = ["color"=> "negro", "marca"=> "Parker", "trazo"=> "grueso", "precio" => 350];
    $lapicera["tres"] = ["color"=> "verde", "marca"=> "Pelican", "trazo"=> "fino", "precio" => 430];
    var_dump($lapicera);
    echo '<br/>';
    echo '<br/>';

    $lapicera[1] = ["color"=> "azul", "marca"=> "Bic", "trazo"=> "fino", "precio" => 200];
    $lapicera[2] = ["color"=> "negro", "marca"=> "Parker", "trazo"=> "grueso", "precio" => 350];
    $lapicera[3] = ["color"=> "verde", "marca"=> "Pelican", "trazo"=> "fino", "precio" => 430];
  

    var_dump($lapicera);

?>