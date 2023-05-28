<?php

session_start();
require_once('DataBase.class.php');

class CapturaInformacionOracle {

   public $databaseOracle;

    public function __construct() {
        $this->databaseOracle = DataBase::getDatabaseObject(DataBase::ORACLE);
    }

    public function prueba() {
        $sql = "SELECT * FROM TABLANUEVAPRUEBA";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function getDatosUsuario($_usuario) {
        $sql = "SELECT USUARIO, NOMBRECOMPLETO
                FROM USUARIO
                WHERE USUARIO = '" . $_usuario . "'";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function getEstados() {
        $sql = "SELECT  ID, NOMBRE
                FROM ESTADOS
                WHERE ESTADO = 1
                ORDER BY ID ASC";
        $data = $this->databaseOracle->query($sql);

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['ID'] . "'>" . $data [$i]['NOMBRE'] . "</option>";
        }

        return $html;
    }

    public function getListaComponentes() {
        $sql = "SELECT  C.ID, C.NOMBRE, C.MARCA, C.MODELO, C.SERIAL, E.NOMBRE AS ESTADO, C.IDSOLICITANTE, C.IDENCARGADO
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                ORDER BY C.ID ASC";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function getConteoComponentes() {
        $sql = "SELECT C.NOMBRE, C.MARCA, C.MODELO, E.NOMBRE AS ESTADO, count(*) AS CONTEO
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                GROUP BY C.NOMBRE, C.MARCA, C.MODELO, E.NOMBRE
                ORDER BY C.NOMBRE ASC";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function saveGuardarComponente($nombre, $marca, $modelo, $serial, $idEstado, $idSolicitante, $idEncargado) {
        
        $select = "SELECT MAX(ID)+1 AS NEXTID FROM COMPONENTES";
        $id = $this->databaseOracle->query($select);

        $data = $this->insertComponent($id[0]['NEXTID'], $nombre, $marca, $modelo, $serial, $idEstado, $idSolicitante, $idEncargado);

        return $data;
    }

    public function insertComponent($id, $nombre, $marca, $modelo, $serial, $idEstado, $idSolicitante, $idEncargado){
        $sqlInsert = "insert into COMPONENTES(ID, NOMBRE, MARCA, MODELO, SERIAL, IDESTADO, IDSOLICITANTE, IDENCARGADO)VALUES('$id', '$nombre', '$marca', '$modelo', '$serial', '$idEstado', '$idSolicitante', '$idEncargado')";
        $dataInsert = $this->databaseOracle->insert($sqlInsert);

        return $dataInsert;
    }

    public function getActualizarComponente($id, $nombre, $marca, $modelo, $serial, $idEstado, $idSolicitante, $idEncargado) {
        $sql = "UPDATE COMPONENTES SET NOMBRE = '" + $nombre + "', MARCA = '" + $marca + "', MODELO = '" + $modelo + "', SERIAL = '" + $serial + "', IDESTADO = " + $idEstado + ", IDSOLICITANTE = " + $idSolicitante + ", IDENCARGADO = " + $idEncargado + " WHERE ID =" + $id;
        $data = $this->databaseOracle->query($sql);

        var_dump($data);
        die();

        return $data;
    }
}
?>