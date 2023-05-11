<?php
include "Archivos.php";
    class Pizza{
        private $id = 0;
        public $sabor;
        public $precio;
        public $tipo;
        public $cantidad;
    
        function __construct($sabor, $precio, $tipo, $cantidad)
        {
            $this->id = random_int(1,100);
            if($this->ValidarString($sabor)){
                $this->sabor = $sabor;
            }
            $aux = $this->convertirNumero($precio);
            if($this->ValidarFloat($aux)){
                $this->precio = $aux;
            }
        
            if($this->ValidadorTipo($tipo)){
                $this->tipo = $tipo;
            }
            $this->cantidad = $cantidad;
        }
    
        private function ValidadorTipo($tipo){
            $retorno = false;
            if($tipo === "molde" || $tipo === "piedra"){
                $retorno = true;
            }
            return $retorno;
        }
        function ValidarString($param){
            return is_string($param);
        }
        function ValidarFloat($param){
            return is_float($param);
        }
        public static function convertirNumero($cadena) {
            $retorno = 0;
            if (is_numeric($cadena)) {
              $retorno = floatval($cadena);
            }
            return $retorno;
          }
        public function agregarPizza($archivo) {
            $retorno = false;
            
            $pizzas = Archivos::leerArchivoJSON($archivo);
            $pizzaExistente = null;
            foreach ($pizzas as &$pizza) {
                if ($pizza['sabor'] == $this->sabor && $pizza['tipo'] == $this->tipo) {
                    $pizzaExistente = &$pizza;
                    break;
                }
            }
            if ($pizzaExistente != null) {
                $pizzaExistente['cantidad'] += $this->cantidad;
                $pizzaExistente['precio'] = $this->precio;
            } else {
                $nuevaPizza = [
                    'id' => $this->id,
                    'sabor' => $this->sabor,
                    'precio' => $this->precio,
                    'tipo' => $this->tipo,
                    'cantidad' => $this->cantidad
                ];
                $pizzas[] = $nuevaPizza;
            }
            if (Archivos::guardarObjetoJSON($archivo,$pizzas)) {
                $retorno = true;
            }
            return $retorno; 
        }
        public static function VentaPizza($sabor, $tipo, $cantidad)
        {
            $retorno = false;
            $arrayPizza = Archivos::leerArchivoJSON('./Archivos/Pizza.json');
            $pizzaVenta = null;
            foreach ($arrayPizza as &$pizza) {
                if ($pizza['sabor'] == $sabor && $pizza['tipo'] == $tipo && $pizza['cantidad'] >= $cantidad) 
                {
                    $pizzaVenta = &$pizza;
                    break;
                }
            }
            if($pizzaVenta != null){
                $pizzaVenta['cantidad'] -= $cantidad;
            }
            $pizzas[] = $arrayPizza;
            if(Archivos::guardarObjetoJSON('./Archivos/Pizza.json', $pizzas)){
                $retorno = true;
            }
            return $retorno;
        }
    
    }

?>