<?php
include_once "Archivos.php";

class CuponDescuento
{
    public int $id;
    public int $devolucionId;
    public string $causa;
    public int $porcentajeDescuento;
    public string $estado;

    public function __construct(int $devolucionId, string $causa)
    {
        $this->id = CuponDescuento::NuevoId(Archivos::LeerArchivoJSON("./Archivos/Cupones.json"));
        $this->devolucionId = $devolucionId;
        $this->causa = empty(trim($causa)) ? 'Distintos sabores' : $causa;
        $this->porcentajeDescuento = 10;
        $this->estado = "no usado";
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

    public static function BuscarCuponActivo(array $cuponesExistentes, int $idCupon)
    {
        $retorno = -1;
        for ($i = 0; $i < count($cuponesExistentes); $i++) {
            if ($idCupon == $cuponesExistentes[$i]['id'] &&
                !strcasecmp($cuponesExistentes[$i]['estado'], "no usado")) {
                $retorno =  $i;
            }
        }

        return $retorno;
    }
}