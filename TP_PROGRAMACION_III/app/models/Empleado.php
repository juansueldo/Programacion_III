<?php


require_once './models/Orden.php';
require_once './db/AccesoDatos.php';

 class Empleado{

    public $id;
    public $usuario_id;
    public $empleado_area_id;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;

    public function __construct(){}

    public static function crearEmpleado($usuario_id, $empleado_area_id, $nombre, $fecha_inicio){
        $nuevoEmpleado = new Empleado();
        $nuevoEmpleado->setUsuarioId($usuario_id);
        $nuevoEmpleado->setEmpleadoAreaId($empleado_area_id);
        $nuevoEmpleado->setNombre($nombre);
        $nuevoEmpleado->setFechaInicio($fecha_inicio);

        return $nuevoEmpleado;
    }

    public function getId(){
        return $this->id;
    }

    public function getEmpleadoAreaID(){
        return $this->empleado_area_id;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    public function getFechaFin(){
        return $this->fecha_fin;
    }

    //--- Setters ---//

    public function setId($id){
        $this->id = $id;
    }

    public function setEmpleadoAreaID($empleado_area_id){
        $this->empleado_area_id = $empleado_area_id;
    }

    public function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setFechaInicio($fecha_inicio){
        $this->fecha_inicio = $fecha_inicio;
    }

    public function setFechaFin($fecha_fin){
        $this->fecha_fin = $fecha_fin;
    }

    //--- Methods ---//

    /**
     * Prints the info of the query as a table.

    public function printSingleEntityAsTable(){
        echo "<table border='2'>";
        echo '<caption>Employee Data</caption>';
        echo "<th>[NAME]</th><th>[USER_ID]</th><th>[AREA]</th><th>[DATE_INIT]</th>";
        echo "<tr align='center'>";
        echo "<td>[".$this->getName()."]</td>";
        echo "<td>[".$this->getUserId()."]</td>";
        echo "<td>[".$this->getEmployeeAreaID()."]</td>";
        echo "<td>[".$this->getDateInit()."]</td>";
        echo "</tr>";
        echo "</table>" ;
    }


     * Prints the info of the query as a table.
     * @param array $entitiesList Array of the Employees objects.
    
    public static function printEntitiesAsTable($entitiesList){
        echo "<table border='2'>";
        echo '<caption>Employees List</caption>';
        echo "<th>[ID]</th><th>[NAME]</th><th>[USER_ID]</th><th>[AREA]</th><th>[DATE_INIT]</th>";
        foreach($entitiesList as $entity){
            echo "<tr align='center'>";
            echo "<td>[".$entity->getId()."]</td>";
            echo "<td>[".$entity->getName()."]</td>";
            echo "<td>[".$entity->getUserId()."]</td>";
            echo "<td>[".$entity->getEmployeeAreaID()."]</td>";
            echo "<td>[".$entity->getDateInit()."]</td>";
            echo "</tr>";
        }
        echo "</table><br>" ;
    }

    /**
     * Inserts an employee into the database.
     * @param Employee $employee The employee to be inserted.
     * @return int The id of the inserted employee.
     */
    public static function insertarEmpleado($empleado){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("INSERT INTO `empleados` (`usuario_id`, `empleado_area_id`, `nombre`, `fecha_inicio`)
        VALUES (:usario_id, :empleado_area_id, :nombre, :fecha_inicio);");
        $query->bindValue(':usario_id', $empleado->getUsarioId());
        $query->bindValue(':empleado_area_id', $empleado->getEmpleadoAreaID());
        $query->bindValue(':nombre', $empleado->getNombre());
        $query->bindValue(':fecha_inicio', $empleado->getFechaInicio());
        try {
            $query->execute();
        } catch (Error $error) {
            echo $error->getMessage();
        }
        
        return $objDataAccess->obtenerUltimoId();
    }

    
    public static function getEmpleadoPorId($id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("SELECT * FROM `empleados` WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchObject('Empleado');
    }

    /**
     * Gets all the employees from the database.
     *
     * @return array $employees The employees if there are any, null otherwise.
     */
    public static function getTodosEmpleados(){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("SELECT * FROM `empleados`");
        $query->execute();
        $employees = $query->fetchAll(PDO::FETCH_CLASS, 'Empleado');

        return $employees;
    }

    public static function borrarEmpleado($id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("DELETE FROM `empleados` WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->rowCount();
    }

    /**
     * Updates an employee in the database.
     *
     * @param Employee $employee The employee to update.
     * @return int $affectedRows The number of affected rows.
     */
    public static function actualizarEmpleado($empleado){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta("UPDATE `empleados` SET usuario_id = :usuario_id, empleado_area_id = :empleado_area_id, nombre = :nombre WHERE id = :id");
        $query->bindValue(':usario_id', $empleado->getUsuarioId());
        $query->bindValue(':empleado_area_id', $empleado->getEmpleadoAreaID());
        $query->bindValue(':nombre', $empleado->getNombre());
        $query->bindValue(':id', $empleado->getId());
        $query->execute();

        return $query->rowCount();
    }

 }
?>