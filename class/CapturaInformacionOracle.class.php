<?php

session_start();
require_once('DataBase.class.php');

class CapturaInformacionOracle {

   var $database;

    public function __construct() {
        $this->database = DataBase::getDatabaseObject(DataBase::ORACLE);
    }

    public function prueba() {
        $sql = "SELECT * FROM TABLANUEVAPRUEBA";
        $data = $this->database->query($sql);

        return $data;
    }
}
?>