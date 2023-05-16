<?php
include_once "Archivos.php";

class CuponDescuento
{
    public  $id;
    public  $devolucionId;
    public  $causa;
    public  $porcentajeDescuento;
    public  $fecha;
    public  $estado;


    public function setID()
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Cupones.json")) + 1;
    }
    public function __construct($devolucionId,  $causa, $fecha)
    {
        $this->setID();
        $this->devolucionId = $devolucionId;
        $this->causa = empty(trim($causa)) ? 'Distintos sabores' : $causa;
        $this->porcentajeDescuento = 0.10;
        $this->fecha = $this->sumarDias($fecha, 3);
        $this->estado = false;
    }

    public static function NuevoId(array $arrayCupones)
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

    public static function BuscarCuponActivo(array $cuponesExistentes, int $id)
    {
        $retorno = -1;
        for ($i = 0; $i < count($cuponesExistentes); $i++) {
            if (
                $id == $cuponesExistentes[$i]['id'] &&
                !strcasecmp($cuponesExistentes[$i]['estado'], "no usado")
            ) {
                $retorno =  $i;
            }
        }

        return $retorno;
    }
    function sumarDias($fecha, $dias)
    {

        $fechaObjeto = new DateTime($fecha);
        $fechaObjeto->add(new DateInterval('P' . $dias . 'D'));
        $fechaSumada = $fechaObjeto->format('Y-m-d');

        return $fechaSumada;
    }
}
