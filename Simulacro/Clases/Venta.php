<?php
//include "Archivos.php";
    class Venta{
        public $id;
        public $email;
        public $fecha;
        public $nroPedido;

        function __construct($email, $nroPedido)
        {
            $this->id;
            $this->email = $email;
            $this->nroPedido = $nroPedido;
            $this->fecha = date('Y-m-d H:i:s');
        }

        public static function CrearIdAutoincremental()
        {
            $listaVentas = Venta::TraerVentas();
    
            if($listaVentas != null)
            {
                $id = count($listaVentas) + 1;
            }
            else
            {
                $id = 1;
            }
    
            return $id;
        }
    
        public static function TraerVentas()
        {
            $ruta = "./Venta.json";
            
            $listaVentas = Archivos::leerArchivoJSON($ruta);
            
            return $listaVentas;
        }

    }
?>