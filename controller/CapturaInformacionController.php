<?php

session_start();
require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');

switch ($_POST['metodo']) {
    case 'getTipoSolicitante':
        XML::xmlResponse(getTipoSolicitante());
        break;	
	case 'getTipoReclamoUsuario':
        XML::xmlResponse(getTipoReclamoUsuario());
        break;
    case 'getTipoReclamoCorresponsal':
        XML::xmlResponse(getTipoReclamoCorresponsal());
        break;
    case 'getTipoReclamoPorId':
        XML::xmlResponse(getTipoReclamoPorId($_POST['Id']));
        break;
    case 'getTipoCta':
        XML::xmlResponse(getTipoCta());
        break;
    case 'getTipoTransaccion':
        XML::xmlResponse(getTipoTransaccion());
        break;
    case 'getBanco':
        XML::xmlResponse(getBanco());
        break;
    case 'getDepartamentos':
        XML::xmlResponse(getDepartamentos());
        break;
    case 'getCiudades':
        XML::xmlResponse(getCiudades($_POST['slcDepartamento']));
        break;
    case 'GuardarForm1':
        XML::xmlResponse(GuardarForm1($_POST['txtNombre'], $_POST['slcTipoSolicitante'], $_POST['txtCedula'], $_POST['txtDireccion'], $_POST['txtCelular'], $_POST['txtCorreo'], $_POST['slcTipoReclamoNvl1'], $_POST['slcTipoReclamoNvl2'], $_POST['txtFechaTran1'], $_POST['txtHoraTran1'], $_POST['txtIdenTerminal1'], $_POST['txtNumTran1'], $_POST['txtNomConvenioCorr'], $_POST['txtNomConvenioErr'], $_POST['txtValorTran1'], $_POST['txtNumReferancia1'], $_POST['txtNumCuentaAbono1'],  $_POST['txtNomConvenio2'], $_POST['txtNumReferanciaErr'],$_POST['txtNumReferanciaCorr'], $_POST['slcTipoCta1'], $_POST['slcBanco1'], $_POST['txtNombreTitu1'], $_POST['txtCedulaTitu1'], $_POST['Usuario'], $_POST['Nombre'], $_POST['slcCiudad'], $_POST['slcDepartamento'], $_POST['txtObservacion']));
        break;
}

function getTipoSolicitante() {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoSolicitante();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTipoReclamoUsuario() {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoReclamoUsuario();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTipoReclamoCorresponsal() {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoReclamoCorresponsal();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTipoReclamoPorId($Id) {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoReclamoPorId($Id);
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTipoCta() {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoCta();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTipoTransaccion() {
    $captura = new CapturaInformacion();
    $data = $captura->getTipoTransaccion();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function getTiposlcRetiro() {
    $captura = new CapturaInformacion();
    $data = $captura->getTiposlcRetiro();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getBanco() {
    $captura = new CapturaInformacion();
    $data = $captura->getBanco();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getDepartamentos() {
    $captura = new CapturaInformacion();
    $data = $captura->getDepartamentos();
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getCiudades($slcDepartamento) {
    $captura = new CapturaInformacion();
    $data = $captura->getCiudades($slcDepartamento);
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function GuardarForm1($txtNombre, $slcTipoSolicitante, $txtCedula, $txtDireccion, $txtCelular, $txtCorreo, $slcTipoReclamoNvl1, $slcTipoReclamoNvl2, $txtFechaTran1, $txtHoraTran1, $txtIdenTerminal1, $txtNumTran1, $txtNomConvenioCorr, $txtNomConvenioErr, $txtValorTran1, $txtNumReferancia1, $txtNumCuentaAbono1,$txtNomConvenio2,$txtNumReferanciaErr,$txtNumReferanciaCorr, $slcTipoCta1, $slcBanco1, $txtNombreTitu1, $txtCedulaTitu1, $Usuario, $Nombre, $slcCiudad, $slcDepartamento, $txtObservacion) {
    $captura = new CapturaInformacion();
    $data = $captura->GuardarForm1($txtNombre, $slcTipoSolicitante, $txtCedula, $txtDireccion, $txtCelular, $txtCorreo, $slcTipoReclamoNvl1, $slcTipoReclamoNvl2, $txtFechaTran1, $txtHoraTran1, $txtIdenTerminal1, $txtNumTran1, $txtNomConvenioCorr, $txtNomConvenioErr, $txtValorTran1, $txtNumReferancia1, $txtNumCuentaAbono1,$txtNomConvenio2,$txtNumReferanciaErr,$txtNumReferanciaCorr, $slcTipoCta1, $slcBanco1, $txtNombreTitu1, $txtCedulaTitu1, $Usuario, $Nombre, $slcCiudad, $slcDepartamento, $txtObservacion);
    if ($data) {
        $xml .= "<registro><![CDATA[" . $data . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
?>

