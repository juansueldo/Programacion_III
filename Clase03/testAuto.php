<?php
    include "auto.php";
    /*Aplicación No 19 (Auto)
Realizar una clase llamada “Auto” que posea los siguientes atributos

privados: _color (String)
_precio (Double)
_marca (String).
_fecha (DateTime)

Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La marca y el color.

ii. La marca, color y el precio.
iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
parámetro y que se sumará al precio del objeto.
Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto” por
parámetro y que mostrará todos los atributos de dicho objeto.
Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo devolverá
TRUE si ambos “Autos” son de la misma marca.
Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son de la
misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con la suma de los
precios o cero si no se pudo realizar la operación.
Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
autos.csv.
Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
autos.csv
Se deben cargar los datos en un array de autos.
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. ● Crear
un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)*/

$autoFord1 = new Auto("Ford", "Gris");
$autoFord2 = new Auto("Ford", "Rojo");

$autoPeugeot1 = new Auto("Peugeot", "Azul", 6320.98);
$autoPeugeot2 = new Auto("Peugeot", "Azul", 5350.10);

$autoFiat = new Auto("Fiat", "Verde", 3890.40, 29/03/1994);

$autoPeugeot1->AgregarImpuestos(1500);
$autoPeugeot2->AgregarImpuestos(1500);
$autoFiat->AgregarImpuestos(1500);

$suma = Auto::Add($autoFord1, $autoFord2);
echo "La suma es: $" . $suma . "<br/>";

if($autoFord1->Equals($autoFord2)){
    echo "Son iguales <br/>";
}
else{
    echo "Son distintos <br/>";
}
if($autoFord1->Equals($autoFiat)){
    echo "Son iguales <br/>";
}
else{
    echo "Son distintos <br/>";
}
echo Auto::DarAlta($autoFord1);
echo Auto::DarAlta($autoFord2);
echo Auto::DarAlta($autoPeugeot1);
echo Auto::DarAlta($autoPeugeot2);
echo Auto::DarAlta($autoFiat);

$autos = Auto::LeerListado();

foreach($autos as $k => $valor){
    if($k % 2 !== 0){
        Auto::MostrarAuto($valor);
    }
}

?>