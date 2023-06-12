<?php
include_once "Archivos.php";

class Venta
{
    #region Atributos
    public int $id;
    public int $numeroPedido;
    public string $mail;
    public string $nombreHamburguesa;
    public string $tipoHamburguesa;
    public string $aderezoHamburguesa;
    public int $cantidadHamburguesa;
    public float $precio;
    public string $fechaPedido;
    public bool $activo;
    #endregion

    #region Setter

    //Asgina un numero de pedido
    public function setNumeroPedido()
    {
        $this->numeroPedido = Venta::NuevoNumPedido(Archivos::LeerArchivoJSON("./Archivos/Venta.json"));
    }
    //Asigna el ID autoincremental
    public function setID()
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Venta.json")) + 1;
    }
    //Asigna el mail del cliente siempre que cumpla con el formato establecido
    public function setMail(string $mail)
    {
        $auxMail = strtolower($mail);
        $this->mail = Venta::ValidarEmail($auxMail) ? $auxMail : 'Email invalido';
    }
    //Asigna el nombre de la hamburguesa en formato lowecase
    public function setNombre(string $nombreHamburguesa)
    {
        $this->nombreHamburguesa = strtolower($nombreHamburguesa);
    }
    //Asgina el tipo de hamburguesa, que solo puede ser al simple o doble, si se ingresa otro valor
    //distinto de manera aleatoria se asgina simple o doble
    public function setTipo(string $tipoHamburguesa)
    {
        $auxTipo = strtolower($tipoHamburguesa);
        if ($auxTipo == "molde" || $auxTipo == "piedra") {
            $this->tipoHamburguesa = $auxTipo;
        } else {
            random_int(0, 1) == 0 ? $this->tipoHamburguesa = "simple" : $this->tipoHamburguesa = "doble";
        }
    }
    public function setAderezo(string $aderezo)
    {
        $auxAderezo = strtolower($aderezo);
        if ($auxAderezo == "mostaza" || $auxAderezo == "mayonesa" || $auxAderezo == "ketchup") {
            $this->aderezoHamburguesa = $auxAderezo;
        } else {
           $aux = random_int(0, 2);
           switch ($aux) {
                case 0:
                    $this->aderezoHamburguesa = "mayonesa";
                    break;
                case 1:
                    $this->aderezoHamburguesa = "ketchup";
                    break;
                case 2:
                    $this->aderezoHamburguesa = "mostaza";
                    break;
           }
        }
    }

    //Asigna la catidad de hamburguesas, la cual debe ser mayor a 0, sino de lo contrario asigna 1
    public function setCantidad(int $cantidad)
    {
        $cantidad <= 0 ? $this->cantidadHamburguesa = 1 : $this->cantidadHamburguesa = $cantidad;
    }

    //Asigna la fecha del pedido de manera aletoria
    function setFecha()
    {
        $this->fechaPedido = date("Y-m-d");
    }
    public function setPrecio(float $precio)
    {
        $precio <= 0 ? $this->precio = 1000 : $this->precio = $precio;
    }
    #endregion

    #region CONSTRUTOR
    
    //Recibe por parametro los valores para generar una nueva instancia del objeto Venta
    public function __construct(string $mail, string $nombre, string $tipo, string $aderezo, int $cantidad)
    {
        $this->setNumeroPedido();
        $this->setID();
        $this->setMail($mail);
        $this->setNombre($nombre);
        $this->setTipo($tipo);
        $this->setAderezo($aderezo);
        $this->setCantidad($cantidad);
        $this->setFecha();
        $this->activo = true;
    }
    #endregion

     #region METODOS

     //Metodo de clase que recibe un string y valida que este sea un email
    private static function ValidarEmail(string $email)
    {
        $condicion = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($condicion, $email)) {
            return true;
        } else {
            return false;
        }
    }
    //Metodo de clase que recibe un array y retorna un numero de pedido aleatorio que no se encuentre dentro del array de objetos
    public static function NuevoNumPedido(array $arrayVentas)
    {
        $numero = random_int(1000, 9999);
        do {
            $existe = false;
            foreach ($arrayVentas as $venta) {
                if ($numero == $venta['numeroPedido']) {
                    $numero = random_int(1000, 9999);
                    $existe = true;
                    break;
                }
            }
        } while ($existe);

        return $numero;
    }
    //Metodo de instancia que guarda una imagen 
    public function GuardarImagenVenta()
    {
        is_dir(getcwd() . '/ImagenesDeLaVenta/2023') ?: mkdir(getcwd() . '/ImagenesDeLaVenta/2023');
        $mailSeparado = explode("@", $this->mail);
        $archivo = $this->tipoHamburguesa . '_' . $this->nombreHamburguesa . '_' . $mailSeparado[0] . '_' . $this->fechaPedido;
        $destino = "ImagenesDeLaVenta/2023/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];
        $retorno = false;

        if (move_uploaded_file($tmpName, $destino)) {
            echo "La foto se guardo correctamente en la carpeta /ImagenesDeLaVenta/2023.\n";
            $retorno = true;
        } else {
            echo "La foto no pudo guardarse.\n";
        }

        return $retorno;
    }
    public static function BuscarVenta(array $ventasExistentes, $numeroPedido)
    {
        $retorno = null;
        for ($i = 0; $i < count($ventasExistentes); $i++) {
            if ($ventasExistentes[$i]['numeroPedido'] == $numeroPedido) {
                $retorno = $ventasExistentes[$i];
            }
        }

        return $retorno;
    }
    public function MostrarVenta(){
        $retorno = "Nro pedido: " . $this->numeroPedido . "\n ID: " . $this->id . "\n Email: ". $this->mail . "\n Nombre: ". 
        $this->nombreHamburguesa . "\n Tipo: ". $this->tipoHamburguesa . "\n Aderezo: ". $this->aderezoHamburguesa . 
        "\n Cantidad: " . $this->cantidadHamburguesa . "\n Fecha: ". $this->fechaPedido  .  $this->activo ? "\n activo" : "\n no esta activa" ."\n";
        return $retorno;
    }
    #endregion
}
?>