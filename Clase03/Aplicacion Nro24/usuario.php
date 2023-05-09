<?php
    class Usuario {
        private $id;
        private $nombre;
        private $clave;
        private $mail;
        private $imagen;
        private $fecha;
      
        public function __construct($nombre, $mail, $clave,$imagen) {
            $this->id = rand(1, 10000);;
            $this->nombre = $nombre;
            $this->mail = $mail;
            $this->clave = $clave;
            $this->imagen = $imagen;
            $this->fecha = date('Y-m-d H:i:s');
        }
      
        public function agregarUsuario($archivo) {
            $retorno = false;

            $usuarios = json_decode(file_get_contents($archivo), true);
    
            $nuevoUsuario = [
                'id' => $this->id,
                'nombre' => $this->nombre,
                'clave' => $this->clave,
                'mail' => $this->mail,
                'imagen' => $this->imagen['name'],
                'fechaRegistro' => $this->fecha
            ];
            $usuarios[] = $nuevoUsuario;

            if (file_put_contents($archivo, json_encode($usuarios))) {
                $retorno = true;
            }
            return $retorno; 
        }
        public static function cargarUsuarios($archivo) {
            // Leer el archivo JSON
            $usuarios = json_decode(file_get_contents($archivo), true);
    
            // Retornar los datos en un array de usuarios
            return $usuarios;
        }    
    }
?>