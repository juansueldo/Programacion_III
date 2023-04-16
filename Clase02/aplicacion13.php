<?php
    include "auto.php";

    $autoFord = new Auto("Ford", "Gris", 790.80, '29/04/1991');
    $autoFord2 = new Auto("Ford", "Gris", 690.80, '29/03/1989');
    $autoFiat = new Auto("Fiat", "Rojo", 500.50, '21/03/1990');
    $autoFiat2 = new Auto("Fiat", "Rojo");


    echo "El valor es:$" . Auto::Add($autoFord, $autoFiat) . "<br/>";
    echo "El valor es:$" . Auto::Add($autoFord2, $autoFord) . "<br/>";
    echo "El valor es:$" . Auto::Add($autoFiat, $autoFiat2) . "<br/>";
    echo "<br/>";


    echo "Son iguales?: ";
    var_dump($autoFord->Equals($autoFord2));
    echo "<br/>";
    echo "Son iguales?: ";
    var_dump($autoFord->Equals($autoFiat));
    echo "<br/>";
    echo "<br/>";
    Auto::MostrarAuto($autoFord);
    Auto::MostrarAuto($autoFord2);
    Auto::MostrarAuto($autoFiat);
    Auto::MostrarAuto($autoFiat);
?>