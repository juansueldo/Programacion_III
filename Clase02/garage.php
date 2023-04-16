<?php
    include "auto.php";
    /*
    Crear la clase Garage que posea como atributos privados:

    _razonSocial (String)
    _precioPorHora (Double)
    _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
    Realizar un constructor capaz de poder instanciar objetos pasándole como

    parámetros:
    i. La razón social.
    ii. La razón social, y el precio por hora.

    Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
    que mostrará todos los atributos del objeto.

    Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
    objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.

    Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
    (sólo si el auto no está en el garaje, de lo contrario informarlo).
    Ejemplo: $miGarage->Add($autoUno);

    Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
    “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo). Ejemplo:
    $miGarage->Remove($autoUno);

    En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
    los métodos.
    */
    class Garage{
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos = [];

        public function __construct($razonSocial, $precioPorHora = 0){
            if($this->ValidarString($razonSocial)){
                $this->_razonSocial=$razonSocial;
            }
            if($this->ValidarDouble($precioPorHora)){
                $this->_precioPorHora=$precioPorHora;
            }

        }
        function ValidarString($param){
            return is_string($param);
        }
        function ValidarDouble($param){
            return is_double($param);
        }
        public function MostrarGarage(){
            echo "Razon Social: " . $this->_razonSocial . "</br>";
            echo "Precio por hora: $" . $this->_precioPorHora . "<br/>";
            foreach($this->_autos as $valor){
                Auto::MostrarAuto($valor);
            }
        }
        public function Equals($auto){
            $boolean = false;
            if($auto instanceof Auto){
                if(in_array($auto,$this->_autos)){
                    $boolean = true;
                }
            }
            return $boolean;
        }
        public function Add($auto){
            $boolean = false;
            if(!$this->Equals($auto)){
                array_push($this->_autos,$auto);
                $boolean = true;
            }
            return $boolean;
        }
        public function Remove($auto){
            $boolean = false;
            $key = array_search($auto, $this->_autos);
        if ($key !== false) {
            unset($this->_autos[$key]);
            $boolean = true;
        }
        return $boolean;
        }
    }
?>