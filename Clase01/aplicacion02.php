<?php
/*
    Juan Sueldo 3D
    Obtenga la fecha actual del servidor (función date) 
    y luego imprímala dentro de la página con
    distintos formatos (seleccione los formatos que más le guste).
    Además indicar que estación del año es.
    Utilizar una estructura selectiva múltiple. */
    $fechaActual = date("d/m/Y");
    $mes = date("m");
    switch($mes)
    {
        case 1:
        case 2:
        case 12:
            $estacion= "verano";
            break;
        case 3:
        case 4:
        case 5:
            $estacion= "otonio";
            break;
        case 6:
        case 7:
        case 8:
            $estacion= "invierno";
            break;
        case 9:
        case 10;
        case 11:
            $estacion= "primavera";
            break;
        default;
        break;

    }
    printf($fechaActual);
    echo "<br/> $estacion";
?>
