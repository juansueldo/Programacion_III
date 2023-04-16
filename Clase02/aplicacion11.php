<?php
    /*
    Juan Sueldo 3D
    Aplicación No 12 (Invertir palabra)
    Realizar el desarrollo de una función que reciba un Array de caracteres 
    y que invierta el orden de las letras del Array.
    Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.
    */

    function InvertirPalabra($palabra){
        $palabra_invertida = "";
        $longitud = strlen($palabra);
  
        for ($i = $longitud - 1; $i >= 0; $i--) {
        $palabra_invertida .= $palabra[$i];
  }
  
  return $palabra_invertida;
}

    echo InvertirPalabra("Hola");
?>