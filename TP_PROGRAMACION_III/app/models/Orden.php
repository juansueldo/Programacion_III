<?php

require_once './db/AccesoDatos.php';
require_once './models/Empleado.php';
require_once './models/Table.php';

class Orden{

    public $id;
    public $mesa_id;
    public $orden_estado;
    public $cliente_nombre;
    public $orden_imagen;
    public $orden_costo;

    public function __construct(){}

    public static function createOrder($mesa_id, $orden_estado, $cliente_nombre, $orden_imagen, $orden_costo = 0){
        $nuevaOrden = new Orden();
        $nuevaOrden->setMesaId($mesa_id);
        $nuevaOrden->setOrdenEstado($orden_estado);
        $nuevaOrden->setClienteNombre($cliente_nombre);
        $nuevaOrden->setOrdenImagen($orden_imagen);
        $nuevaOrden->setOrdenCosto($orden_costo);

        return $nuevaOrden;
    }

    //--- Getters ---//

    /**
     * Gets The order ID.
     *
     * @return int The order ID.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Gets The table ID.
     *
     * @return int The table ID.
     */
    public function getMesaId(){
        return $this->mesa_id;
    }

    /**
     * Gets The order status.
     *
     * @return string The order status.
     */
    public function getOrdenEstado(){
        return $this->orden_estado;
    }

    /**
     * Gets The customer name.
     *
     * @return string The customer name.
     */
    public function getClienteNombre(){
        return $this->cliente_nombre;
    }

    /**
     * Gets The order picture.
     *
     * @return string The order picture.
     */
    public function getOrdenImagen(){
        return $this->orden_imagen;
    }

    /**
     * Gets The order cost.
     *
     * @return float The order cost.
     */
    public function getOrdenCosto(){
        return $this->orden_costo;
    }
    
    //--- Setters ---//

    /**
     * Sets The order ID.
     *
     * @param int $id The order ID.
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * Sets The table ID.
     *
     * @param int $table_id The table ID.
     */
    public function setMesaId($mesa_id){
        $this->mesa_id = $mesa_id;
    }

    /**
     * Sets The order status.
     *
     * @param string $order_status The order status.
     */
    public function setOrdenEstado($orden_estado){
        $this->orden_estado = $orden_estado;
    }

    /**
     * Sets The customer name.
     *
     * @param string $customer_name The customer name.
     */
    public function setClienteNombre($cliente_nombre){
        $this->cliente_nombre = $cliente_nombre;
    }

    /**
     * Sets The order picture.
     *
     * @param string $order_picture The order picture.
     */
    public function setOrdenImagen($orden_imagen){
        $this->orden_imagen = $orden_imagen;
    }

    /**
     * Sets The order cost.
     *
     * @param float $order_cost The order cost.
     */
    public function setOrdenCosto($orden_costo){
        $this->orden_costo = $orden_costo;
    }

   
    //--- Create Table into DB ---//

    //--- CRUD ---//

    /**
     * Creates a new order in the database.
     *
     * @param Order $order The order to be created.
     * @return bool True if the order was created, false otherwise.
     */
    public static function insertarOrden($orden){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('INSERT INTO ordenes (mesa_id, orden_estado, cliente_nombre, orden_imagen, orden_costo) 
        VALUES (:mesa_id, :orden_estado, :cliente_nombre, :orden_imagen, :orden_costo)');
        $query->bindValue(':mesa_id', $orden->getMesaId());
        $query->bindValue(':orden_estado', $orden->getOrdenEstado());
        $query->bindValue(':cliente_nombre', $orden->getClienteNombre());
        $query->bindValue(':orden_imagen', $orden->getOrdenImagen());
        $query->bindValue(':orden_costo', $orden->getOrdenCosto());
        $query->execute();

        return $objDataAccess->obtenerUltimoId();
    }

    /**
     * Gets all the orders from the database.
     *
     * @return array An array of all the orders.
     */
    public static function getTodos(){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT * FROM ordenes');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Orden');
    }

    /**
     * Gets the order with the given ID.
     *
     * @param int $id The ID of the order to be retrieved.
     * @return Order The order with the given ID.
     */
    public static function getOrdenPorId($id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT * FROM ordenes WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetchObject('Orden');
    }

    /**
     * Gets the order with the given table bassed on its id.
     * 
     * @param Table $table The table to get all its orders.
     * @return array An array of all the orders of the table.
     */
    public static function getOrdernesPorMesa($mesa){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT * FROM ordenes WHERE mesa_id = :mesa_id');
        $query->bindParam(':mesa_id', $mesa);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Orden');
    }

    /**
     * Gets all the orders bassed on an employee id.
     * 
     * @param Employee $employee The employee to get all its orders.
     * @return array An array of all the orders of the employee.
     */
    public static function getOrdenPorEmpleado($empleado){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT o.id, o.mesa_id, o.orden_estado 
        FROM ordenes AS o
        LEFT JOIN mesas AS t ON o.mesa_id = t.id
        LEFT JOIN empleados AS e ON t.empleado_id = :id');
        $query->bindValue(':id', $empleado->getId());
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Orden');
    }

    /**
     * TODO: Check if this is the better way to handle this.
     */
    public static function getOrdernPorTipoUsuario($tipo){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT o.id, o.mesa_id, o.orden_estado 
        FROM ordenes AS o
        LEFT JOIN mesas AS t ON o.mesa_id = t.id
        LEFT JOIN empleados AS e ON t.empleado_id = e.id
        LEFT JOIN usuarios AS u ON e.usuario_id = u.id
        WHERE u.tipo_usuario = :type;');
        $query->bindParam(':tipo', $tipo);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC, 'Order');
    }

    /**
     * Updates the order with the given ID.
     *
     * @param Order $order The order to be updated.
     * @return bool True if the order was updated, false otherwise.
     */
    public static function actualizarOrden($orden){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('UPDATE ordenes 
        SET orden_estado = :orden_estado, orden_costo = :orden_costo 
        WHERE id = :id');
        $query->bindValue(':id', $orden->getId());
        $query->bindValue(':orden_estado', $orden->getOrdenEstado());
        $query->bindValue(':orden_costo', $orden->getOrderCost());
        $query->execute();

        return $query->rowCount() > 0;
    }

    /**
     * Updates the picture of the order with the given ID.
     * 
     * @param int $order_id The order to be updated.
     * @param string $picturePath The order picture to be updated.
     * @return bool True if the order picture was updated, false otherwise.
     */
    public static function actualizarImagen($orden){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('UPDATE ordenes SET orden_imagen = :orden_imagen WHERE id = :id');
        $query->bindValue(':id', $orden->getId());
        $query->bindValue(':orden_imagen', $orden->getOrdenImagen());
        $query->execute();

        return $query;
    }

    /**
     * Deletes the order with the given ID.
     *
     * @param int $id The ID of the order to be deleted.
     * @return bool True if the order was deleted, false otherwise.
     */
    public static function borrarOrdenPorId($id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('DELETE FROM ordenes WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        
        return $objDataAccess->rowCount() > 0;
    }

    /**
     * Gets the order with the given table ID.
     *
     * @param int $table_id The ID of the table.
     * @return Order The order with the given table ID.
     */
    public static function getPorMesaId($mesa_id){
        $objDataAccess = AccesoDatos::obtenerInstancia();
        $query = $objDataAccess->prepararConsulta('SELECT * FROM ordenes WHERE mesa_id = :mesa_id');
        $query->bindParam(':mesa_id', $mesa_id);
        $query->execute();

        return $query->fetchObject('Orden');
    }

    
}
?>