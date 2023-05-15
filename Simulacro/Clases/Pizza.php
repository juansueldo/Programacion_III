<?php
include "Archivos.php";
class Pizza
{
    #region ATRIBUTOS
    public int $id = 0;
    public string $sabor;
    public string $precio;
    public string $tipo;
    public int $cantidad;
    #endregion

    #region SETTERS
    //Asigna el ID autoincremental
    public function setID()
    {
        $this->id = count(Archivos::leerArchivoJSON("./Archivos/Pizza.json")) + 1;
    }
    //Asigna el sabor de la pizza en formato lowecase
    public function setSabor(string $sabor)
    {
        $this->sabor = strtolower($sabor);
    }
    //Asigna el precio de la pizza, si esta cuesta menor o igual a0 el valor por defecto es 1000
    public function setPrecio(float $precio)
    {
        $precio <= 0 ? $this->precio = 1000 : $this->precio = $precio;
    }
    //Asgina el tipo de pizza, que solo puede ser al molde o a la pieda, si se ingresa otro valor
    //distinto de manera aleatoria se asgina molde o piedra
    public function setTipo(string $tipo)
    {
        $auxTipo = strtolower($tipo);
        if ($auxTipo == "molde" || $auxTipo == "piedra") {
            $this->tipo = $auxTipo;
        } else {
            random_int(0, 1) == 0 ? $this->tipo = "molde" : $this->tipo = "piedra";
        }
    }
    //Asigna la catidad de pizzas, la cual debe ser mayor a 0, sino de lo contrario asigna 1
    public function setCantidad(int $cantidad)
    {
        $cantidad < 0 ? $this->cantidad = 0 : $this->cantidad = $cantidad;
    }

    #endregion

    #region CONSTRUCTOR
    //Recibe por parametro los valores para generar una nueva instancia del objeto Pizza
    function __construct(string $sabor, float $precio, string $tipo, int $cantidad)
    {
        $this->setID();
        $this->setSabor($sabor);
        $this->setPrecio($precio);
        $this->setTipo($tipo);
        $this->setCantidad($cantidad);
    }
    #endregion

    #region METODOS
    //Metodo de instancia que guarda una imagen 
    public function GuardarImagenPizza()
    {
        is_dir(getcwd() . '/ImagenesDePizzas') ?: mkdir(getcwd() . '/ImagenesDePizzas');
        $archivo = $this->sabor . '_' . $this->tipo;
        $destino = "ImagenesDePizzas/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];
        $retorno = false;

        if (move_uploaded_file($tmpName, $destino)) {
            echo "La foto se guardó correctamente en la ruta /ImagenesDePizzas.\n";
            $retorno = true;
        } else {
            echo "La foto no pudo guardarse.\n";
        }

        return $retorno;
    }
    #endregion

}
