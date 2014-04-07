<?php

/**
 * Clase para conectar a la base de datos
 * @author Camilo Garzon Calle
 * @copyright Secuencia24
 * @version 1.0
 */
class ConectionDb {

    private $host, $user, $pass, $db, $connection, $server_date;

    /**
     * Constructor que establece los datos de conexion a la base de datos
     */
    public function __construct() {
        try {
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "root";
            $this->db = "s24data_db";
            $this->server_date = 'DATE_ADD(NOW(),INTERVAL 1 HOUR)';
            $this->connection = NULL;
        } catch (PDOException $e) {
            $this->error_connection = $e->getMessage();
        }
        return $this->connection;
    }

    function ErrorInfo() {
        return $this->error_connection;
    }

    /**
     * Establece la connexion con la base de datos
     */
    public function openConect() {
        try {
            $this->connection =mysql_connect($this->host, $this->user, $this->pass);
            //$this->connection = new PDO("mysql:host=$this->host;dbname=$this->bd", $this->user, $this->pass);
            //$this->connection->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            if (!$this->connection) {
                throw new Exception("No fue posible conectarse al servidor MySQL");
            }
            if (!mysql_select_db($this->db, $this->connection)) {
                throw new Exception("No se puede seleccionar la base de datos $this->db");
            }
        } catch (PDOException $e) {
            $this->error_conexion = $e->getMessage();
        }
        return $this->connection;
    }

    // Cierra la connection con la base de datos
    public function closeConect() {
        mysql_close($this->connection);
    }

    public function getServerDate() {
        return $this->server_date;
    }
}
?>
