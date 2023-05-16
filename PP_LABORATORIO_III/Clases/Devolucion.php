<?php
include_once "Archivos.php";

class Devolucion
{
    public int $id;
    public string $causa;
    public int $numeroPedido;
    public int $idCupon;

    public function __construct(string $causa, int $numeroDePedido, int $idCupon)
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Devoluciones.json")) + 1;
        $this->causa = $causa;
        $this->numeroPedido = $numeroDePedido;
        $this->idCupon = $idCupon;
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
        is_dir(getcwd() . '/ImagenesDeClientesEnojados') ?: mkdir(getcwd() . '/ImagenesDeClientesEnojados',0777, true);
        $mailSeparado = explode("@", $venta->mail);
        $archivo = $venta->nombreHamburguesa . '_' . $venta->tipoHamburguesa . '_' .  $mailSeparado[0] . '_' . $venta->fechaPedido;
        $destino = "ImagenesDeClientesEnojados/" . $archivo . ".jpg";
        $tmpName = $_FILES["imagen"]["tmp_name"];

        return move_uploaded_file($tmpName, $destino);
    }
    public static function GuardarImagen($venta)
    {
        is_dir(getcwd() . '/ImagenesDeClientesEnojados') ?: mkdir(getcwd() . '/ImagenesDeClientesEnojados');
        $mailSeparado = explode("@", $venta->mail);
        $archivo = $venta->tipoHamburguesa . '_' . $venta->nombreHamburguesa . '_' . $mailSeparado[0] . '_' . $venta->fechaPedido;
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
}