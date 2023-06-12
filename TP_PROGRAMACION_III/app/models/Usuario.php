<?php


require_once './db/AccesoDatos.php';
require_once './models/Empleado.php';

class Usuario{
    
    //--- Attributes ---//
    public $id;
    public $usuario_nombre;
    public $password;
    public $esAdmin;
    public $usuario_tipo;
    public $estado;
    public $fecha_inicio;
    public $fecha_fin;

    //--- Default Constructor ---//
    public function __construct(){}

    public static function crearUsuario($usuario_nombre, $password, $esAdmin, $usuario_tipo, $estado, $fecha_inicio){
        $usuario = new Usuario();
        $usuario->setUsuarioNombre($usuario_nombre);
        $usuario->setPassword($password);
        $usuario->setEsAdmin($esAdmin);
        $usuario->setUsuarioTipo($usuario_tipo);
        $usuario->setEstado($estado);
        $usuario->setFechaInicio($fecha_inicio);
        return $usuario;
    }

    //--- Getters ---//

    /**
     * Get the user with the given id.
     * @return int The user id.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Get the user with the given username.
     * @return string The user username.
     */
    public function getUsuarioNombre(){
        return $this->usuario_nombre;
    }

    /**
     * Get the user with the given password.
     * @return string The user password.
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Get the user with the given isAdmin.
     * @return bool The user isAdmin.
     */
    public function getEsAdmin(){
        return $this->esAdmin;
    }

    /**
     * Get the user with the given user_type.
     * @return string The user user_type.
     */
    public function getUsuarioTipo(){
        return $this->usuario_tipo;
    }

    /**
     * Get the user with the given status.
     * @return string The user status.
     */
    public function getEstado(){
        return $this->estado;
    }

    /**
     * Get the user with the given dateInit.
     * @return string The user dateInit.
     */
    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    /**
     * Get the user with the given dateEnd.
     * @return string The user dateEnd.
     */
    public function getFechaFin(){
        return $this->fecha_fin;
    }

    //--- Setters ---//

    /**
     * Set the user id.
     * @param int $id The user id.
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set the user's username.
     * @param string $username The new username.
     */
    public function setUsuarioNombre($usuario_nombre){
        $this->usuario_nombre = $usuario_nombre;
    }

    /**
     * Set the user's password.
     * @param string $password The new password.
     */
    public function setPassword($password){
        $this->password = $password;
    }

 
    /**
     * Set the user's admin status.
     * @param bool $isAdmin The new admin status.
     */
    public function setEsAdmin($esAdmin){
        $this->esAdmin = $this->validateBool($esAdmin);
    }

    /**
     * Set the user's user_type.
     * @param string $user_type The new user_type.
     */
    public function setUsuarioTipo($usuario_tipo){
        $this->usuario_tipo = $usuario_tipo;
    }

    /**
     * Set the user's status.
     * @param string $status The new status.
     */
    public function setEstado($estado){
        $this->estado = $estado;
    }
    
    /**
     * Set the user's dateInit.
     * @param string $dateInit The new dateInit.
     */
    public function setFechaInicio($fecha_inicio){
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * Set the user's dateEnd.
     * @param string $dateEnd The new dateEnd.
     */
    public function setFechaFin($fecha_fin){
        $this->fecha_fin = $fecha_fin;
    }

    //--- Other Methods ---//

    /**
     * Check if the user is an admin.
     * @return bool True if the user is an admin, false otherwise.
     */
    public function esAdmin(){
        return $this->getEsAdmin();
    }

    /**
     * Converts the string 'True' or 'False' to a boolean like 1 for true and 0 for false.
     *
     * @param string $bool The string to be converted to a boolean value in numeric format.
     * @return int The converted boolean value in numeric format.
     */
    private function validateBool($bool){
        return strtolower($bool) == "true";
    }

    public static function insertartUsuario($usuario){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("INSERT INTO usuarios (usuario_nombre, password, esAdmin, usuario_tipo, estado, fecha_inicio) 
        VALUES (:usuario_nombre, :password, :esAdmin, :usuario_tipo, :estado, :fecha_inicio)");
        $passwordHash = password_hash($usuario->getPassword(), PASSWORD_DEFAULT);
        $query->bindValue(':usuario_nombre', $usuario->getUsuarioNombre(), PDO::PARAM_STR);
        $query->bindValue(':password', $passwordHash);
        $query->bindValue(':esAdmin', $usuario->getEsAdmin(), PDO::PARAM_INT);
        $query->bindValue(':usuario_tipo', $usuario->getUsuarioTipo(), PDO::PARAM_STR);
        $query->bindValue(':estado', $usuario->getEstado(), PDO::PARAM_STR);
        $query->bindValue(':fecha_inicio', $usuario->getFechaInicio(), PDO::PARAM_STR);
        $query->execute();

        return $objDataAccess->obtenerUltimoId();
    }


    public static function getTodosUsuarios(){

        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("SELECT * FROM usuarios");
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }

    public static function getUsuario($empleado){

        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("SELECT * FROM usuarios AS u
        JOIN empleados AS e
        ON :id = u.id");
        $query->bindValue(':id', $empleado->getUsuarioId(), PDO::PARAM_INT);
        $query->execute();

        return $query->fetchObject('Usuario');
    }

    
    public static function getUsuarioPorId($id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("SELECT * FROM usuarios WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $usuario = $query->fetchObject('Usuario');
        if(is_null($usuario)){
            throw new Exception("Usuario no encontrado");
        }
        return $usuario;
    }

 
    public static function modificarUsuario($usuario){

        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("UPDATE usuarios SET usuario_nombre = :usuario_nombre, password = :password WHERE id = :id");
        try {
            $query->bindValue(':usuario_nombre', $usuario->getUsuarioNombre(), PDO::PARAM_STR);
            $query->bindValue(':password', $usuario->getPassword(), PDO::PARAM_STR);
            $query->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
            $query->execute();
        } catch (Error $error) {
            echo $error->getMessage();
        }

        return $query;
    }

    public static function borrarUsuario($usuario){

        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("DELETE FROM usuarios WHERE id = :id");
        $query->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);
        $query->execute();

        return $query;
    }
}
?>