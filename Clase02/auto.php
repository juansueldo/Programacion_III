<?php
    /*
    Aplicación No 17 (Auto)
    Realizar una clase llamada “Auto” que posea los siguientes atributos

    privados: _color (String)
    _precio (Double)
    _marca (String).
    _fecha (DateTime)

    Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros: 
    i. La marca y el color.
    ii. La marca, color y el precio.
    iii. La marca, color, precio y fecha.

Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble 
por parámetro y que se sumará al precio del objeto.

Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
por parámetro y que mostrará todos los atributos de dicho objeto.

Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
devolverá TRUE si ambos “Autos” son de la misma marca.

Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
la suma de los precios o cero si no se pudo realizar la operación.

Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
    */
    class Auto{
        private $_color;
        private $_precio;
        private $_marca;
        private $_fecha;
        public function __construct($marca,$color,$precio = 0, $fecha = ""){
            if($this->ValidarString($marca)){
                $this->_marca=$marca;
            }
            if($this->ValidarString($color)){
                $this->_color=$color;
            }
            if($this->ValidarDouble($precio)){
                $this->_precio=$precio;
            }
            if($this->ValidarDate($fecha)){
                $this->_fecha=$fecha;
            }

        }
        
        function ValidarString($param){
            return is_string($param);
        }
        function ValidarDouble($param){
            return is_double($param);
        }
        function ValidarDate($param){
            $retorno = date("d/m/Y");
            if ($param instanceof DateTime) {
                $retorno = $param;
            }
            return $retorno;
        }
        public function AgregarImpuestos($impuesto){
            return $this->_precio + $impuesto;
        }

        public static function MostrarAuto($auto){
            echo "Marca: " . $auto->_marca ."<br/>";
            echo "Precio: $" . $auto->_precio ."<br/>";
            echo "Color: " . $auto->_color ."<br/>";
            echo "Fecha: " . $auto->_fecha ."<br/>" . "<br/>";
        }

        public function Equals($auto){
            $boolean = false;
            if($this->_marca == $auto->_marca){
                $boolean = true;
            }
            return $boolean;
        }
        public static function Add($autoUno, $autoDos){
            $acumPrecio = 0;
            if($autoUno->_marca == $autoDos->_marca && $autoUno->_color == $autoDos->_color){
                $acumPrecio = $autoUno->_precio + $autoDos->_precio;
            }
            return $acumPrecio;
        }
    }

?>