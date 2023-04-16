<?php
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
        public static function DarAlta($auto){
            $retorno = "El archivo no se pudo guardar <br/>";
            if($archivo = fopen('autos.csv', 'a+')){
                if(fputcsv($archivo, [$auto->_marca, $auto->_color, $auto->_fecha, $auto->_precio])){
                    $retorno = "Archivo guardado <br/>";
                }
            }
            fclose($archivo);
            return $retorno;
        }
        public static function LeerListado() {
            $autos = [];
        
            if (($archivo = fopen('autos.csv', 'r')) !== false) {
              while (($datos = fgetcsv($archivo)) !== false) {
                $auto = new Auto($datos[0], $datos[1], $datos[2], $datos[3]);
                $autos[] = $auto;
              }
              fclose($archivo);
            }
        
            return $autos;
          }
    }

?>