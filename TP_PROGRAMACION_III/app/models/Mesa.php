<?php

 class Mesa {
        public $id;
        public $numero_mesa;
        public $empleado_id;
        public $estado;

        public function __construct() {}

        public static function createTable($numero_mesa, $empleado_id, $estado) {
            $mesa = new Mesa();
            $mesa->setMesaNumero($numero_mesa);
            $mesa->setEmpleadoId($empleado_id);
            $mesa->setEstado($estado);

            return $mesa;
        }

        //--- Getters ---//

        /**
        * Gets the id of the table
        *
        * @return int id of the table
        */
        public function getId(){
            return $this->id;
        }

        /**
         * Gets the code of the table
         * 
         * @return string code of the table
         */
        public function getMesaNumero(){
            return $this->numero_mesa;
        }

        /**
         * Gets the id of the employee that is assigned to the table
         * @return int id of the employee
         */
        public function getEmpleadoId(){
            return $this->empleado_id;
        }

        /**
         * Gets the state of the table
         * @return string state of the table
         */
        public function getEstado(){
            return $this->estado;
        }

        //--- Setters ---//
    
        /**
        * Sets the id of the table
        *
        * @param int $id id of the table
        */
        public function setId($id){
            $this->id = $id;
        }

        /**
         * Sets the code of the table
         * 
         * @param string $table_code code of the table
         */
        public function setMesaNumero($numero_mesa){
            $this->numero_mesa = $numero_mesa;
        }
    
        /**
        * Sets the id of the employee that is assigned to the table
        *
        * @param int $employee_id id of the employee
        */
        public function setEmpleadoId($empleado_id){
            $this->empleado_id = $empleado_id;
        }

        /**
         * Sets the state of the table
         * @param string $state state of the table
         * @return void
         */
        public function setEstado($estado){
            $this->estado = $estado;
        }

        
        public static function getMesasPorEmpleadoId($empleado_id){
            $objDataAccess = AccesoDatos::obtenerInstancia();
            $query = $objDataAccess->prepararConsulta('SELECT * FROM mesas WHERE empleado_id = :empleado_id');
            $query->bindParam(':empleado_id', $empleado_id);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, 'Mesa');
        }

        /**
         * Gets all the tables.
         * 
         * @return array of tables
         */
        public static function getTodasMesas(){
            $objDataAccess = AccesoDatos::obtenerInstancia();
            $query = $objDataAccess->prepararConsulta('SELECT * FROM mesas');
            $query->execute();

            return $query->fetchAll(PDO::FETCH_CLASS, 'Mesa');
        }

        /**
         * Gets the table with the specified id.
         * 
         * @param int $id id of the table
         * @return Table table
         */
        public static function getMesaPorId($id){
            $objDataAccess = AccesoDatos::obtenerInstancia();
            $query = $objDataAccess->prepararConsulta('SELECT * FROM mesas WHERE id = :id');
            $query->bindParam(':id', $id);
            $query->execute();

            return $query->fetchObject('Mesa');
        }

        /**
         * Inserts a Table into the db.
         * 
         * @param Table $table table to be inserted
         * @return int id of the table inserted
         */
        public static function insertarMesa($mesa){
            $objDataAccess = AccesoDatos::obtenerInstancia();
            $query = $objDataAccess->prepararConsulta('INSERT INTO mesas (numero_mesa, empleado_id, estado) 
            VALUES (:numero_mesa, :empleado_id, :estado)');
            $query->bindValue(':numero_mesa', $mesa->getMesaNumero());
            $query->bindValue(':empleado_id', $mesa->getEmpleadoId());
            $query->bindValue(':estado', $mesa->getEstado());
            $query->execute();

            return $objDataAccess->obtenerUltimoId();
        }

        
 }
?>