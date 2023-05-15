<?php
class Pizza
{

    // ATRIBUTOS

    private $id = 0;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;

    // CONSTRUCTOR 
    function __construct($sabor, $precio, $tipo, $cantidad)
    {
        $this->id = Pizza::CrearIdAutoincremental();
        if ($this->ValidarString($sabor)) {
            $this->sabor = $sabor;
        }
        if ($this->ValidarFloat($precio)) {
            $this->precio = $precio;
        }
        if ($this->ValidarTipo($tipo)) {
            $this->tipo = $tipo;
        }
        $this->cantidad = $cantidad;
    }

    // ID autoincremental
    public static function CrearIdAutoincremental()
    {
        $listaPizzas = Archivos::LeerArchivo('Pizzas.json');

        if ($listaPizzas != null) {
            $id = count($listaPizzas) + 1;
        } else {
            $id = 1;
        }

        return $id;
    }


    // VALIDACIONES
    function ValidarString($param)
    {
        return is_string($param);
    }
    function ValidarFloat($param)
    {
        return is_float($param);
    }
    public function ValidarTipo($tipo)
    {
        $retorno = false;

        if (strcasecmp($tipo, "molde") == 0 || strcasecmp($tipo, "piedra") == 0) {
            $retorno = true;
        }

        return $retorno;
    }

    public static function ValidarCombinacion($tipo, $sabor)
    {
        $retorno = null;

        $listaPizzas = Archivos::LeerArchivo('Pizzas.json');

        foreach ($listaPizzas as $auxPizza) {
            if (strcasecmp($auxPizza->tipo, $tipo) == 0 && strcasecmp($auxPizza->sabor, $sabor) == 0) {
                $retorno = $auxPizza;
                break;
            }
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
        if (Archivos::guardarObjetoJSON($archivo,$pizzas)) {
            $retorno = true;
        }
        return $retorno; 
    }
    public static function Buscar($sabor, $tipo){
        $retorno =  "No se encontró coincidencia para sabor: " . $sabor . " y tipo: " . $tipo;
        $arrayPizza = Archivos::LeerArchivo('Pizza.json');
        
        foreach ($arrayPizza as $pizza) {
            if ($pizza->sabor == $sabor && $pizza->tipo == $tipo) {
                $retorno = "Si Hay";
            }
        }
        
        if (!Pizza::buscarSabor($sabor, $arrayPizza)) {
            return "No existe el sabor: " . $sabor;
        }
        
        if (!Pizza::buscarTipo($tipo, $arrayPizza)) {
            $retorno =  "No existe el tipo: " . $tipo;
        }
        return $retorno;
        
        
    }
    public static function VentaPizza($sabor, $tipo, $cantidad)
    {
        $retorno = false;
        $arrayPizza = Archivos::LeerArchivo('Pizza.json');
        foreach ($arrayPizza as $pizza) {
            if ($pizza->sabor == $sabor && $pizza->tipo == $tipo && $pizza->cantidad >= $cantidad) 
            {
                $pizza->cantidad -= $cantidad;
                $retorno = true;
                
            }
            if($retorno){
                Archivos::GuardarTodos('Pizza.json', $arrayPizza);
            }
        }
        return $retorno;
    }

    private static function buscarSabor($sabor, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza->sabor === $sabor) {
                return true;
            }
        }
        return false;
    }
    
    private static function buscarTipo($tipo, $arrayPizza) {
        foreach ($arrayPizza as $pizza) {
            if ($pizza->tipo === $tipo) {
                return true;
            }
        }
        return false;
    }
}
