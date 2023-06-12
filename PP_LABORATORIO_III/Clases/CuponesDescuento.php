<?php
include_once "Archivos.php";

class CuponDescuento
{
    public int $id;
    public int $devolucionId;
    public string $causa;
    public float  $porcentajeDescuento;
    public string $fecha;
    public bool $estado;


    public function setID()
    {
        $this->id = count(Archivos::LeerArchivoJSON("./Archivos/Cupones.json")) + 1;
    }
    public function __construct($devolucionId, $causa, $fecha)
    {
        $this->setID();
        $this->devolucionId = $devolucionId;
        $this->causa = empty(trim($causa)) ? 'Distintos sabores' : $causa;
        $this->porcentajeDescuento = 0.9;
        $this->fecha = $this->sumarDias($fecha, 3);
        $this->estado = false;
    }
    function sumarDias($fecha, $dias)
    {

        $fechaObjeto = new DateTime($fecha);
        $fechaObjeto->add(new DateInterval('P' . $dias . 'D'));
        $fechaSumada = $fechaObjeto->format('Y-m-d');

        return $fechaSumada;
    }
}
