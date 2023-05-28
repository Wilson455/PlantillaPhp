<?php

session_start();
require_once('../class/CapturaInformacionOracle.class.php');
require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');

switch ($_POST['metodo']) {
    case 'getEstados':
        XML::xmlResponse(getEstados());
        break;
    case 'getAreas':
            XML::xmlResponse(getAreas());
            break;
    case 'getListaComponentes':
        XML::xmlResponse(getListaComponentes());
        break;
    case 'getConteoComponentes':
        XML::xmlResponse(getConteoComponentes());
        break;
    case 'saveGuardarComponentes':
        XML::xmlResponse(saveGuardarComponentes($_POST['componente'], $_POST['marca'], $_POST['modelo'], $_POST['serial'], $_POST['idEstado'], $_POST['area'], $_POST['idEncargado']));
        break;
    case 'getActualizarComponente':
        XML::xmlResponse(getActualizarComponente($_POST['id'], $_POST['componente'], $_POST['marca'],$_POST['modelo'],$_POST['serial'],$_POST['idEstado'], $_POST['area'],$_POST['idEncargado']));
        break;
    case 'getDatosComponente':
        XML::xmlResponse(getDatosComponente($_POST['id']));
        break;
    case 'eliminarComponente':
        XML::xmlResponse(eliminarComponente($_POST['id']));
        break;
}

function getEstados() {
    $captura = new CapturaInformacionOracle();
    $data = $captura->getEstados();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getAreas() {
    $captura = new CapturaInformacionOracle();
    $data = $captura->getAreas();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getListaComponentes() {
    $captura = new CapturaInformacionOracle();
    $data = $captura->getListaComponentes();
    if ($data) {
        $xml .= "";
        for($i = 0; $i < count($data); $i++){
            $xml .= "<registro
                        ID='".$data[$i]['ID']."'
                        COMPONENTE='".$data[$i]['COMPONENTE']."'
                        MARCA='".$data[$i]['MARCA']."'
                        MODELO='".$data[$i]['MODELO']."'
                        SERIAL='".$data[$i]['SERIAL']."'
                        ESTADO='".$data[$i]['ESTADO']."'
                        AREA='".$data[$i]['AREA']."'
                        IDENCARGADO='".$data[$i]['IDENCARGADO']."'
                    >EXITOSO</registro>";
        }
       
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getConteoComponentes() {
    $captura = new CapturaInformacionOracle();
    $data = $captura->getConteoComponentes();
    if ($data) {
        $xml .= "";
        for($i = 0; $i < count($data); $i++){
            $xml .= "<registro
                        COMPONENTE='".$data[$i]['COMPONENTE']."'
                        MARCA='".$data[$i]['MARCA']."'
                        MODELO='".$data[$i]['MODELO']."'
                        ESTADO='".$data[$i]['ESTADO']."'
                        CONTEO='".$data[$i]['CONTEO']."'
                    >EXITOSO</registro>";
        }
       
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function saveGuardarComponentes($componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado) {    
    $captura = new CapturaInformacionOracle();
    $data = $captura->saveGuardarComponente($componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado);

    $xml = "";
    if ($data) {
        $xml .= "<registro><![CDATA[". $data ."]]></registro>";
    } else {
        $xml .= "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getDatosComponente($id) {    
    $captura = new CapturaInformacionOracle();
    $data = $captura->getDatosComponente($id);

    $xml = "";

    if ($data) {
        for ($i=0; $i < count($data); $i++) { 
            $xml .= "<registro componente='" . $data[$i]['COMPONENTE'] . "' marca='" . $data[$i]['MARCA'] . "' modelo='" . $data[$i]['MODELO'] . "' serial='" . $data[$i]['SERIAL'] . "' idEstado='" . $data[$i]['IDESTADO'] . "' idEncargado='" . $data[$i]['IDENCARGADO'] . "' area='" . $data[$i]['AREA'] . "'><![CDATA[". $data[$i]['ID'] ."]]></registro>";
        }
    } else {
        $xml .= "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getActualizarComponente($id, $componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado) {
    $captura = new CapturaInformacionOracle();
   
    $data = $captura->getActualizarComponente($id, $componente, $marca, $modelo, $serial, $idEstado, $area, $idEncargado);

    if ($data) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function eliminarComponente($id) {
    $captura = new CapturaInformacionOracle();
   
    $data = $captura->eliminarComponente($id);

    if ($data) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

?>

