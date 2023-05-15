<?php
include_once "Archivos.php";

class Venta
{
    #region Atributos
    public int $id;
    public int $numeroPedido;
    public string $mail;
    public string $saborPizza;
    public string $tipoPizza;
    public int $cantidadPizza;
    public string $fechaPedido;
    public float $_precioFinal;
    public bool $_activo;
    #endregion

    #region Setter

    //Asgina un numero de pedido
    public function setNumeroPedido()
    {
        $this->numeroPedido = Venta::NuevoNumPedido(Archivos::LeerArchivoJSON("./Archivos/Ventas.json"));
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
    //Asigna el sabor de la pizza en formato lowecase
    public function setSabor(string $sabor)
    {
        $this->saborPizza = strtolower($sabor);
    }
    //Asgina el tipo de pizza, que solo puede ser al molde o a la pieda, si se ingresa otro valor
    //distinto de manera aleatoria se asgina molde o piedra
    public function setTipo(string $tipo)
    {
        $auxTipo = strtolower($tipo);
        if ($auxTipo == "molde" || $auxTipo == "piedra") {
            $this->tipoPizza = $auxTipo;
        } else {
            random_int(0, 1) == 0 ? $this->tipoPizza = "molde" : $this->tipoPizza = "piedra";
        }
    }
    public function setPrecioFinal(float $precio){
        $this->_precioFinal = $precio <= 0 ? 1 : $precio;
    }
    //Asigna la catidad de pizzas, la cual debe ser mayor a 0, sino de lo contrario asigna 1
    public function setCantidad(int $cantidad)
    {
        $cantidad <= 0 ? $this->cantidadPizza = 1 : $this->cantidadPizza = $cantidad;
    }
    //Asigna la fecha del pedido de manera aletoria
    function setFecha()
    {
        $formato = "Y-m-d";
        $fecha_incio = strtotime("2019-01-01");
        $fecha_fin = strtotime("2023-12-31");
        $fecha_aleatoria = mt_rand($fecha_incio, $fecha_fin);
        $fecha =  date($formato, $fecha_aleatoria);
        $this->fechaPedido = $fecha;
    }
    #endregion

    #region CONSTRUTOR
    
    //Recibe por parametro los valores para generar una nueva instancia del objeto Venta
    public function __construct(string $mail, string $saborPizza, string $tipoPizza, int $cantidadPizza)
    {
        $this->setNumeroPedido();
        $this->setID();
        $this->setMail($mail);
        $this->setSabor($saborPizza);
        $this->setTipo($tipoPizza);
        $this->setCantidad($cantidadPizza);
        $this->setFecha();
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
                if ($numero == $venta->numeroPedido) {
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
        is_dir(getcwd() . '/ImagenesDeLaVenta') ?: mkdir(getcwd() . '/ImagenesDeLaVenta');
        $mailSeparado = explode("@", $this->mail);
        $archivo = $this->tipoPizza . '_' . $this->saborPizza . '_' . $mailSeparado[0] . '_' . $this->fechaPedido;
        $destino = "ImagenesDeLaVenta/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];
        $retorno = false;

        if (move_uploaded_file($tmpName, $destino)) {
            echo "La foto se guardó correctamente en la carpeta /ImagenesDeLaVenta.\n";
            $retorno = true;
        } else {
            echo "La foto no pudo guardarse.\n";
        }

        return $retorno;
    }
    public static function BuscarVenta(array $ventasExistentes, $numeroPedido)
    {
        for ($i = 0; $i < count($ventasExistentes); $i++) {
            if ($ventasExistentes[$i]->_numeroPedido == $numeroPedido) {
                return $i;
            }
        }

        return -1;
    }
    #endregion
}
?>