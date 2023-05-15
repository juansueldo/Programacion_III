<?php
class Archivos
{
    #RECIBE LA RUTA DONDE SE GUARDA EL ARCHIVO, Y EL OBJETO A GUARDAR
    #RETORNA TRUE SI SE GUARDO Y FALSE SINO SE GUARDO
    public static function GuardarObjetoJSON($ruta, $objeto)
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
    #RECIBE LA RUTA DONDE SE GUARDA EL ARCHIVO Y LO LEE
    #RETORNA UN ARRAY CON LOS DATOS LEIDOS DEL ARCHIVO
    public static function LeerArchivoJSON($ruta)
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