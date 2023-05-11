<?php
class Archivos
{
    public static function guardarObjetoJSON($ruta, $objeto)
    {
        $retorno = false;
        if (!file_exists($ruta)) {
            file_put_contents($ruta, "");
        }
        if (file_put_contents($ruta, json_encode($objeto, JSON_PRETTY_PRINT))) {
            $retorno = true;
        }
        return $retorno;
    }
    public static function leerArchivoJSON($ruta)
    {
        $datos = array();
        if (file_exists($ruta)) {
            $contenidoArchivo = file_get_contents($ruta);
            $datos = json_decode($contenidoArchivo, true);
        }
        return $datos;
    }
}
?>