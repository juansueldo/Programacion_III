<?php
    class Usuario {
        private $clave;
        private $mail;
        private $usuariosRegistrados = array(
          array('mail' => 'juan@gmail.com', 'clave' => '123456'),
          array('mail' => 'natalia@gmail.com', 'clave' => 'abcdef'),
          array('mail' => 'emilia@gmail.com', 'clave' => 'qwerty')
        );
      
        public function __construct($mail, $clave) {
          $this->mail = $mail;
          $this->clave = $clave;
        }
      
        public function verificarUsuario() {
          foreach($this->usuariosRegistrados as $usuario) {
            if($usuario['mail'] === $this->mail)
            {
              if($usuario['clave'] === $this->clave)
              {
                return "Verificado";
              }
              else 
              {
                return "Error en los datos";
              }
            }
          }
          return "Usuario no registrado";
        }
      }
      
?>