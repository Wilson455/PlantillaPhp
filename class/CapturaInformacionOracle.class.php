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

    public function getDatosUsuario($_usuario) {
        $sql = "SELECT USUARIO, NOMBRECOMPLETO
                FROM USUARIO
                WHERE USUARIO = '" . $_usuario . "'";
        $data = $this->database->query($sql);

        return $data;
    }

    function getEstados() {
        $sql = "SELECT  ID, NOMBRE
                FROM ESTADOS
                WHERE ESTADO = 1
                ORDER BY ID ASC";
        $data = $this->database->query($sql);

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['ID'] . "'>" . $data [$i]['NOMBRE'] . "</option>";
        }

        return $html;
    }

    function getListaComponentes() {
        $sql = "SELECT  C.ID, C.NOMBRE, C.MARCA, C.MODELO, C.SERIAL, E.NOMBRE AS ESTADO, C.IDSOLICITANTE, C.IDENCARGADO
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                ORDER BY C.ID ASC";
        $data = $this->database->query($sql);

        return $data;
    }

    function getConteoComponentes() {
        $sql = "SELECT C.NOMBRE, C.MARCA, C.MODELO, E.NOMBRE AS ESTADO, count(*) AS CONTEO
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                GROUP BY C.NOMBRE, C.MARCA, C.MODELO, E.NOMBRE
                ORDER BY C.NOMBRE ASC";
        $data = $this->database->query($sql);

        return $data;
    }
}
?>