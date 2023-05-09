<?php
    include "AccesoDatos.php";
    class Usuario{
        public $nombre;
        public $apellido;
        public $clave;
        public $email;
        public $localidad;
        public $fecha_de_registro;

        public function __construct($nombre,$apellido, $clave,$email,$localidad) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->clave = $clave;
            $this->email = $email;
            $this->localidad = $localidad;
            $this->fecha_de_registro = date('Y-m-d H:i:s');
        }

        public function InsertarUsuario()
        {
            $bool = false;
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre, apellido, clave, email, localidad, fecha_de_registro)
            VALUES ('$this->nombre', '$this->apellido', '$this->clave', '$this->email', '$this->localidad', '$this->fecha_de_registro')");
            if($consulta->execute()){
                $bool = true;
            }
            return $bool;
                   
   
        } 

    }
?>