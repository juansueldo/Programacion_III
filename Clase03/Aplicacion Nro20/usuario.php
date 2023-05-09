<?php
    class Usuario {
        private $clave;
        private $mail;
      
        public function __construct($mail, $clave) {
          $this->mail = $mail;
          $this->clave = $clave;
        }
      
        public static function DarAlta($usuario){
            $retorno = "El archivo no se pudo guardar <br/>";
            if($archivo = fopen('usuarios.csv', 'a+')){
                if(fputcsv($archivo, [$usuario->mail, $usuario->clave])){
                    $retorno = "Archivo guardado <br/>";
                }
                else{
                    $retorno = "No se pudo guardar <br/>";
                }
            }
            fclose($archivo);
            return $retorno;
        }
    }
?>