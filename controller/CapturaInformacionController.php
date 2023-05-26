<?php

session_start();
require_once('../class/CapturaInformacionOracle.class.php');
require_once('../class/XML.class.php');

switch ($_POST['metodo']) {
    case 'getEstados':
        XML::xmlResponse(getEstados());
        break;
    case 'getListaComponentes':
        XML::xmlResponse(getListaComponentes());
        break;
    case 'getConteoComponentes':
        XML::xmlResponse(getConteoComponentes());
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

function getListaComponentes() {
    $captura = new CapturaInformacionOracle();
    $data = $captura->getListaComponentes();
    if ($data) {
        $xml .= "";
        for($i = 0; $i < count($data); $i++){
            $xml .= "<registro
                        ID='".$data[$i]['ID']."'
                        NOMBRE='".$data[$i]['NOMBRE']."'
                        MARCA='".$data[$i]['MARCA']."'
                        MODELO='".$data[$i]['MODELO']."'
                        SERIAL='".$data[$i]['SERIAL']."'
                        ESTADO='".$data[$i]['ESTADO']."'
                        IDSOLICITANTE='".$data[$i]['IDSOLICITANTE']."'
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
                        NOMBRE='".$data[$i]['NOMBRE']."'
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
?>

