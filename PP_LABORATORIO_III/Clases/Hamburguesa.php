<?php
include "Archivos.php";
class Hamburguesa
{
    #region ATRIBUTOS
    public int $id = 0;
    public string $nombre;
    public string $precio;
    public string $tipo;
    public string $aderezo;
    public int $cantidad;
    #endregion

    #region SETTERS
    //Asigna el ID autoincremental
    public function setID()
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Hamburguesa.json")) + 1;
    }
    //Asigna el nombre de la hamburguesa en formato lowecase
    public function setNombre(string $nombre)
    {
        $this->nombre = strtolower($nombre);
    }
    //Asigna el precio de la hamburguesa, si esta cuesta menor o igual a 0 el valor por defecto es 1000
    public function setPrecio(float $precio)
    {
        $precio <= 0 ? $this->precio = 1000 : $this->precio = $precio;
    }
    //Asgina el tipo de hamburguesa, que solo puede ser al simple o simple, si se ingresa otro valor
    //distinto de manera aleatoria se asgina simple o simple
    public function setTipo(string $tipo)
    {
        $auxTipo = strtolower($tipo);
        if ($auxTipo == "simple" || $auxTipo == "doble") {
            $this->tipo = $auxTipo;
        } else {
            random_int(0, 1) == 0 ? $this->tipo = "simple" : $this->tipo = "doble";
        }
    }
    public function setAderezo(string $aderezo)
    {
        $auxAderezo = strtolower($aderezo);
        if ($auxAderezo == "mostaza" || $auxAderezo == "mayonesa" || $auxAderezo == "ketchup") {
            $this->aderezo = $auxAderezo;
        } else {
           $aux = random_int(0, 2);
           switch ($aux) {
                case 0:
                    $this->aderezo = "mayonesa";
                    break;
                case 1:
                    $this->aderezo = "ketchup";
                    break;
                case 2:
                    $this->aderezo = "mostaza";
                    break;
           }
        }
    }
    //Asigna la catidad de hamburguesas, la cual debe ser mayor a 0, sino de lo contrario asigna 1
    public function setCantidad(int $cantidad)
    {
        $cantidad < 0 ? $this->cantidad = 0 : $this->cantidad = $cantidad;
    }

    #endregion

    #region CONSTRUCTOR
    //Recibe por parametro los valores para generar una nueva instancia del objeto Hamburguesa
    function __construct(string $nombre, float $precio, string $tipo, string $aderezo, int $cantidad)
    {
        $this->setID();
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setTipo($tipo);
        $this->setAderezo($aderezo);
        $this->setCantidad($cantidad);
    }
    #endregion

    #region METODOS
    //Metodo de instancia que guarda una imagen 
    public function GuardarImagenHamburguesa()
    {
        is_dir(getcwd() . './ImagenesDeHamburguesas/2023') ?: mkdir(getcwd() . './ImagenesDeHamburguesas/2023',0777, true);
        $archivo = $this->tipo . '_' . $this->nombre;
        $destino = "ImagenesDeHamburguesas/2023/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];
        $retorno = false;

        if (move_uploaded_file($tmpName, $destino)) {
            echo "La foto se guardo correctamente en la carpeta /ImagenesDeHamburguesas/2023.\n";
            $retorno = true;
        } else {
            echo "La foto no pudo guardarse.\n";
        }

        return $retorno;
    }
    public function Equals($hamburguesa){
        return !strcasecmp($this->nombre, $hamburguesa->nombre) && !strcasecmp($this->tipo, $hamburguesa->tipo);
    }

    public static function BuscarHamburguesa(array $hamburguesasExistentes, Hamburguesa $hamburguesa){
        for($i = 0; $i < count($hamburguesasExistentes); $i++){
            if($hamburguesa->Equals($hamburguesasExistentes[$i])){
                return $i;
            }
        }

        return -1;
    }
    #endregion

}
