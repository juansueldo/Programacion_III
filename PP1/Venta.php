<?php
include "Archivos.php";
    class Venta{
        private $id;
        private $email;
        private $sabor;
        private $tipo;
        private $cantidad;
        private $fecha;

        function __construct($email, $sabor, $tipo, $cantidad)
        {
            $this->id;
            $this->email = $email;
            $this->sabor = $sabor;
            $this->tipo = $tipo;
            $this->cantidad = $cantidad;
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
    
        public static function GuardarVenta($venta)
        {
            $ruta = "./Venta.json";
            $guardo = false;       
    
    
            Archivos::GuardarUno($ruta, $venta);
    
            $guardo = true;
            
              
            return $guardo;
        } 
    
    
        public static function TraerVentas()
        {
            $ruta = "./Venta.json";
            
            $listaVentas = Archivos::LeerArchivo($ruta);
            
            return $listaVentas;
        }

    }
?>