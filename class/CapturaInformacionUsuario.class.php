<?php

session_start();
require_once('DataBase.class.php');

class CapturaInformacion {

    var $database;
    var $codigo_campana = '00578';

//    var $BaseUsuarios = '[192.168.211.240].';

    public function __construct() {
        $this->database = DataBase::getDatabaseObject(DataBase::SQL_SERVER_USUARIO);
    }

}
