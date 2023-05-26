<?php

require_once('DataBase.interface.php');

class OracleDatabase implements IDataBase {
    //Datos de Conexión
    var $host = "localhost";
    var $database = "ORCLCDB";
    var $user = "PRUEBA";
    var $pass = "Sandero2023";
    var $sid = "ORCLCDB";
   
    var $conn;
    var $numRows;

    function __construct() {
        $this->conectar($this->host, $this->user, $this->pass, $this->database);
    }

    public function conectar($_host, $_user, $_password, $_database) {
        $connection = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP) (HOST = ' . $_host . ')(PORT = 1521))
                        (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = ' . $_database . ')(SID = ' . $_database . ')))';
        $this->conn = oci_connect($_user, $_password, $connection);
    }

    function query($sql) {
        if (!$this->conn) {
            $e = oci_error();
            echo $e['message'];
            die();
        }
        
        $query = oci_parse($this->conn, $sql);
        oci_execute($query);
        oci_commit($this->conn);

        $data = oci_fetch_all($query, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        oci_close($this->conn);

        return $res;
    }

    function nonReturnQuery($sql) {}
}
?>
