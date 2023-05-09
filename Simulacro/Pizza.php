<?php
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
            //if($this->ValidarDouble($precio)){
                $this->precio = $precio;
            //}
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
        function ValidarDouble($param){
            return is_double($param);
        }
        public function agregarPizza($archivo) {
            $retorno = false;
            
            $pizzas = json_decode(file_get_contents($archivo), true);
        
            // Verificar si ya existe una pizza con el mismo tipo
            $pizzaExistente = null;
            foreach ($pizzas as &$pizza) {
                if ($pizza['sabor'] == $this->sabor && $pizza['tipo'] == $this->tipo) {
                    $pizzaExistente = &$pizza;
                    break;
                }
            }
        
            if ($pizzaExistente != null) {
                // Si ya existe, actualizar cantidad y precio
                $pizzaExistente['cantidad'] += $this->cantidad;
                $pizzaExistente['precio'] = $this->precio;
            } else {
                // Si no existe, agregar la nueva pizza
                $nuevaPizza = [
                    'id' => $this->id,
                    'sabor' => $this->sabor,
                    'precio' => $this->precio,
                    'tipo' => $this->tipo,
                    'cantidad' => $this->cantidad
                ];
                $pizzas[] = $nuevaPizza;
            }
        
            if (file_put_contents($archivo, json_encode($pizzas))) {
                $retorno = true;
            }
            return $retorno; 
        }
        public static function LeerPizzas($archivo) {
            // Leer el archivo JSON
            $usuarios = json_decode(file_get_contents($archivo), true);
    
            // Retornar los datos en un array de usuarios
            return $usuarios;
        }    
    
    }

?>