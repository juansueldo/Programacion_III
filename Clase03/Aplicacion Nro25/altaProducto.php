<?php
  /*
    Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )
    por POST , crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
    crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
    si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo renglón
    Retorna un :
    “Ingresado” si es un producto nuevo
    “Actualizado” si ya existía y se actualiza el stock.
    “no se pudo hacer“ si no se pudo hacer
    Hacer los métodos necesarios en la clase
    */
    class Producto{
        private $_id;
        private $_nombre;
        private $_tipo;
        private $_stock;
        private $_precio;
        private $_codigo_barra;

        public function __construct($codigo_barra, $nombre, $tipo, $stock, $precio) {
            $this->_id = rand(1, 10000); // ID emulado
            if($this->ValidarCodigo($codigo_barra)){
                $this->_codigo_barra=$codigo_barra;
            }
            $this->_nombre = $nombre;
            $this->_tipo = $tipo;
            $this->_stock = $stock;
            $this->_precio = $precio;
        }

        public function Equals($producto){
            $boolean = false;
            if($this->_codigo_barra == $producto->_codigo_barra){
                $boolean = true;
            }
            return $boolean;
        }

        function ValidarCodigo($num){
            $retorno = 0;
            if (strlen(strval($num)) === 6) {
               $retorno = $num;
            }
            return $retorno;
        }
    }

?>