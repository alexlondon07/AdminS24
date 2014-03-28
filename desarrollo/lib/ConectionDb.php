<?php

/**
 * Clase para conectar a la base de datos
 * @author Camilo Garzon Calle
 * @copyright Secuencia24
 * @version 1.0
 */
class ConectionDb {

    var $fechmode = PDO::FETCH_ASSOC; // Obtiene una fila de resultado como un array asociativo
    var $error_connection = "";
    var $sql_query;
    private $host, $user, $pass, $db, $connection, $server_date;

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

    function SetFetchMode($tipo) {
        //FETCH_ASSOC o 	FETCH_NUM
        $this->fechmode = $tipo;
    }

    function Execute($sql, $array = NULL) {
        $consulta = $this->connection->prepare($sql);
        $consulta->setFetchMode($this->fechmode);
        $consulta->execute($array);
        $this->sql_query = $consulta;

        return $this->sql_query;
    }

    function fetchrow() {
        return $this->sql_query->fetch($this->fechmode);
    }

    //Ver numero de registro arojado por la consulta realizada
    function numrows() {
        return $this->sql_query->rowCount();
    }

    //Para varios registros de la consulta
    function GetArray() {
        return $this->sql_query;
    }

    //Establece la connexion con la base de datos
    public function openConect() {
        try {
            $this->connection = mysql_connect($this->host, $this->user, $this->pass);
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
