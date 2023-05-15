<?php
class Archivos
{
    public static function GuardarTodos($ruta, $lista)
    {
        $retorno = false;

        $archivo = fopen($ruta, "w");

        foreach ($lista as $objeto) {
            fwrite($archivo, json_encode($objeto) . PHP_EOL);
        }

        fclose($archivo);

        if (file_exists($ruta)) {
            $retorno = true;
        }

        return $retorno;
    }

    public static function GuardarUno($ruta, $dato)
    {
        $retorno = false;

        $archivo = fopen($ruta, "a");

        fwrite($archivo, json_encode($dato) . PHP_EOL);

        fclose($archivo);

        if (file_exists($ruta)) {
            $retorno = true;
        }

        return $retorno;
    }
    public static function LeerArchivo($ruta)
        {
            $lista = array();

            if(file_exists($ruta))
            {             
                $archivo = fopen($ruta, "r");           

                while(!feof($archivo))
                {
                    $objeto = json_decode(fgets($archivo));

                    if($objeto != null)
                    {
                        array_push($lista, $objeto);
                    }
                }
                
                fclose($archivo);        
            }

            return $lista;
        }
}
