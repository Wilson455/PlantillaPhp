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

    public function getAreas() {
        $sql = "SELECT  ID, NOMBRE
                FROM AREAS
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
        $sql = "SELECT  C.ID, C.COMPONENTE, C.MARCA, C.MODELO, C.SERIAL, E.NOMBRE AS ESTADO, C.IDENCARGADO, A.NOMBRE AS AREA
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                INNER JOIN AREAS A ON C.AREA = A.ID
                ORDER BY C.ID ASC";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function getConteoComponentes() {
        $sql = "SELECT C.COMPONENTE, C.MARCA, C.MODELO, E.NOMBRE AS ESTADO, count(*) AS CONTEO
                FROM COMPONENTES C
                INNER JOIN ESTADOS E ON C.IDESTADO = E.ID
                INNER JOIN AREAS A ON C.AREA = A.ID
                GROUP BY C.COMPONENTE, C.MARCA, C.MODELO, E.NOMBRE
                ORDER BY C.COMPONENTE ASC";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function saveGuardarComponente($componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado) {
        $id = 1;
        $select = "SELECT MAX(ID)+1 AS NEXTID FROM COMPONENTES";
        $sqlSelect = $this->databaseOracle->query($select);

        if($sqlSelect[0]['NEXTID'] > 0){
            $id = $sqlSelect[0]['NEXTID'];
        }

        $data = $this->insertComponent($id, $componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado);

        return $data;
    }

    public function insertComponent($id, $componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado){
        $sqlInsert = "insert into COMPONENTES(ID, COMPONENTE, MARCA, MODELO, SERIAL, IDESTADO, AREA, IDENCARGADO)VALUES('$id', '$componente', '$marca', '$modelo', '$serial', '$idEstado', '$area', '$idEncargado')";
        $dataInsert = $this->databaseOracle->insert($sqlInsert);

        return $dataInsert;
    }

    public function getDatosComponente($id) {
        $sql = "SELECT  C.ID, C.COMPONENTE, C.MARCA, C.MODELO, C.SERIAL, C.IDESTADO, C.AREA, C.IDENCARGADO
                FROM COMPONENTES C
                WHERE C.ID ='" . $id . "'";
        $data = $this->databaseOracle->query($sql);

        return $data;
    }

    public function getActualizarComponente($id, $componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado) {
        $sql = "UPDATE COMPONENTES SET COMPONENTE = '" . $componente . "', MARCA = '" . $marca . "', MODELO = '" . $modelo . "', SERIAL = '" . $serial . "', IDESTADO = " . $idEstado . ", AREA = " . $area . ", IDENCARGADO = " . $idEncargado . " WHERE ID =" . $id;
        $data = $this->databaseOracle->insert($sql);

        return $data;
    }

    public function eliminarComponente($id) {
        $sql = "DELETE FROM COMPONENTES
                WHERE ID ='" . $id . "'";
        $data = $this->databaseOracle->insert($sql);

        return $data;
    }
}
?>