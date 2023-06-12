<?php
include_once "Archivos.php";

class Devolucion
{
    public  $id;
    public  $causa;
    public  $numeroPedido;
    public  $idCupon;


    public function setID()
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Devolucion.json")) + 1;
    }
    public function setIdCupon()
    {
        $this->idCupon = Devolucion::NuevoIdDevoluciones(Archivos::LeerArchivoJSON("./Archivos/Devolucion.json"));
    }
    public function __construct( $causa,  $numeroDePedido)
    {
        $this->setID();
        $this->causa = $causa;
        $this->numeroPedido = $numeroDePedido;
        $this->setIdCupon();
    }

    public static function BuscarDevolucion($devolucionesExistentes, $numeroPedido)
    {
        $retorno = -1;
        for ($i = 0; $i < count($devolucionesExistentes); $i++) {
            if ($devolucionesExistentes['numeroPedido'] == $numeroPedido) {
                $retorno = $i;
            }
        }

        return $retorno;
    }
    public static function GuardarImagenClienteEnojado($venta)
    {
        is_dir(getcwd() . '/ImagenesDeClientesEnojados') ?: mkdir(getcwd() . '/ImagenesDeClientesEnojados');
        $mailSeparado = explode("@", $venta['mail']);
        $archivo = $venta['tipoHamburguesa'] . '_' . $venta['nombreHamburguesa'] . '_' . $mailSeparado[0] . '_' . $venta['fechaPedido'];
        $destino = "ImagenesDeClientesEnojados/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];
        $retorno = false;

        if (move_uploaded_file($tmpName, $destino)) {
            echo "La foto se guardo correctamente en la carpeta /ImagenesDeClientesEnojados.\n";
            $retorno = true;
        } else {
            echo "La foto no pudo guardarse.\n";
        }

        return $retorno;
    }
    public static function NuevoIdDevoluciones(array $arrayCupones)
    {
        $numero = random_int(1000, 9999);
        do {
            $existe = false;
            foreach ($arrayCupones as $cupon) {
                if ($numero == $cupon->id) {
                    $numero = random_int(1000, 9999);
                    $existe = true;
                    break;
                }
            }
        } while ($existe);

        return $numero;
    }
}