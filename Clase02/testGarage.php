<?php
    include "garage.php";

    $autoFord = new Auto("Ford", "Gris", 790.80, '29/04/1991');
    $autoFord2 = new Auto("Ford", "Gris", 690.80, '29/03/1989');
    $autoFiat = new Auto("Fiat", "Rojo", 500.50, '21/03/1990');
    $autoFiat2 = new Auto("Fiat", "Rojo");

    $garage1 = new Garage("Max SRL", 60.40);

    if($garage1->Add($autoFord)){
        echo "Auto agregado <br/>";
    }
    else{
        echo "no se pudo agregar <br/>";
    }

    if($garage1->Add($autoFord2)){
        echo "Auto agregado <br/>";
    }
    else{
        echo "no se pudo agregar <br/>";
    }

    if($garage1->Add($autoFiat)){
        echo "Auto agregado <br/>";
    }
    else{
        echo "no se pudo agregar <br/>";
    }
    $garage1->MostrarGarage();
    if($garage1->Remove($autoFiat)){
        echo "Auto eliminado <br/>";
    }
    $garage1->MostrarGarage();
?>