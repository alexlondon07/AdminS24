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
	
        $this->host = "localhost";
	$this->pass = "root";
	$this->user = "root";
	$this->db = "s24data_db";
        
	//Este es el timestamp que se debe ingresar, de acuerdo a la hora deseada
	//$this->server_date = 'DATE_ADD(NOW(),INTERVAL 5 HOUR)';
	$this->server_date = 'NOW()';
	$this->connection = NULL;
    }

    /**
     * Establece la connexion con la base de datos
     */
    public function openConect() {
	$this->connection = mysql_connect($this->host, $this->user, $this->pass); // or die(mysql_error());
	if (!$this->connection) {
	    throw new Exception("No fue posible conectarse al servidor MySQL");
	}
	if (!mysql_select_db($this->db, $this->connection)) {
	    throw new Exception("No se puede seleccionar la base de datos $this->db");
	}
	return $this->connection;
    }

    /**
     * Cierra la conexion con la base de datos
     */
    public function closeConect() {
	mysql_close($this->connection);
    }

    public function getServerDate() {
	return $this->server_date;
    }

}

?>
