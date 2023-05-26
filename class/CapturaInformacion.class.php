<?php

session_start();
require_once('DataBase.class.php');

class CapturaInformacion {

   var $database;

    public function __construct() {
        $this->database = DataBase::getDatabaseObject(DataBase::SQL_SERVER);
    }


	
	public function getDatosUsuario($_usuario) {
        $sql = "SELECT Usuario, Nombre
                FROM Usuario
                WHERE Usuario = '" . $_usuario . "'";
        $data = $this->database->query(utf8_decode($sql));

        return $data;
    }

    function getTipoSolicitante() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoSolicitante,
                        Descripcion,
                        Estado
                FROM TipoSolicitante
                WHERE Estado='1'";
        $data = $cp->database->query($sql);

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_TipoSolicitante'] . "'>" . htmlspecialchars(ltrim(rtrim($data [$i]['Descripcion']))) . "</option>";
        }

        return $html;
    }

    function getTipoReclamoUsuario() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoReclamo,
                        Descripcion,
                        Estado,
                        Id_Padre
                FROM TipoReclamo
                WHERE Estado='1' AND Id_Padre = 7";
        $data = $cp->database->query($sql);

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_TipoReclamo'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['Descripcion'])))) . "</option>";
        }

        return $html;
    }

    function getTipoReclamoCorresponsal() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoReclamo,
                        Descripcion,
                        Estado,
                        Id_Padre
                FROM TipoReclamo
                WHERE Estado='1' AND Id_Padre = 1";
        $data = $cp->database->query(utf8_decode($sql));
	
        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_TipoReclamo'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['Descripcion'])))) . "</option>";
        }

        return $html;
    }

    function getTipoReclamoPorId($Id) {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoReclamo,
                        Descripcion,
                        Estado,
                        Id_Padre
                FROM TipoReclamo
                WHERE Estado='1' AND Id_Padre='" . $Id . "'";
        $data = $cp->database->query($sql);
        if ($data) {
            $html = "<option value ='-1'>Seleccione...</option>";
            for ($i = 0; $i < count($data); $i++) {
                $html .= "<option value='" . $data [$i]['Id_TipoReclamo'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['Descripcion'])))) . "</option>";
            }
        }

        return $html;
    }

    function getTipoCta() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoCta,
                        Descripcion,
                        Estado
                FROM TipoCta
                WHERE Estado='1'";
        $data = $cp->database->query($sql);

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_TipoCta'] . "'>" . htmlspecialchars(ltrim(rtrim($data [$i]['Descripcion']))) . "</option>";
        }

        return $html;
    }

    function getTipoTransaccion() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_TipoTransaccion,
                        Descripcion,
                        Estado
                FROM TipoTransaccion
                WHERE Estado='1'";
        $data = $cp->database->query(utf8_decode($sql));

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_TipoTransaccion'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['Descripcion'])))) . "</option>";
        }

        return $html;
    }
	

    function getBanco() {
        $cp = new CapturaInformacion();

        $sql = "SELECT  Id_Banco,
                        Descripcion,
                        Estado
                FROM Bancos
                WHERE Estado='1'";
        $data = $cp->database->query(utf8_decode($sql));

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['Id_Banco'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['Descripcion'])))) . "</option>";
        }

        return $html;
    }

    function getDepartamentos() {
        $cp = new CapturaInformacion();

        $sql = "SELECT DISTINCT
                       ci_cod_depto,
                       ci_departamen
                FROM [192.168.211.240].[Parametros].[dbo].[ciudades] order by 2 asc";
        $data = $cp->database->query(utf8_decode($sql));

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['ci_cod_depto'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['ci_departamen'])))) . "</option>";
        }

        return $html;
    }

    function getCiudades($slcDepartamento) {
        $cp = new CapturaInformacion();

        $sql = "SELECT
                       ci_cod_ciudad,
                       ci_ciudad
                FROM [192.168.211.240].[Parametros].[dbo].[ciudades] 
                WHERE ci_cod_depto='" . $slcDepartamento . "'";
        $data = $cp->database->query(utf8_decode($sql));

        $html = "<option value ='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            $html .= "<option value='" . $data [$i]['ci_cod_ciudad'] . "'>" . htmlspecialchars(utf8_encode(ltrim(rtrim($data [$i]['ci_ciudad'])))) . "</option>";
        }

        return $html;
    }

    function GuardarForm1($txtNombre, $slcTipoSolicitante, $txtCedula, $txtDireccion, $txtCelular, $txtCorreo, $slcTipoReclamoNvl1, $slcTipoReclamoNvl2, $txtFechaTran1, $txtHoraTran1, $txtIdenTerminal1, $txtNumTran1, $txtNomConvenioCorr, $txtNomConvenioErr, $txtValorTran1, $txtNumReferancia1, $txtNumCuentaAbono1,$txtNomConvenio2,$txtNumReferanciaErr,$txtNumReferanciaCorr, $slcTipoCta1, $slcBanco1, $txtNombreTitu1, $txtCedulaTitu1, $Usuario, $Nombre, $slcCiudad, $slcDepartamento, $txtObservacion) {
		
        $cp = new CapturaInformacion();
		
		
		
		$NomConvenioCorr = ($txtNomConvenioCorr != '') ? "'" . $txtNomConvenioCorr . "'" : 'NULL';
        $TipoReclamoNvl2 = ($slcTipoReclamoNvl2 != '') ? "'" . $slcTipoReclamoNvl2 . "'" : 'NULL';
        $NumCuentaAbono1 = ($txtNumCuentaAbono1 != '') ? "" . $txtNumCuentaAbono1 . "" : 'NULL';
		$NumTran1 = ($txtNumTran1 != '') ? "" . $txtNumTran1 . "" : 'NULL';
		$IdenTerminal1 = ($txtIdenTerminal1 != '') ? "'" . $txtIdenTerminal1 . "'" : 'NULL';
		$NumReferanciaErr = ($txtNumReferanciaErr != '') ? "'" . $txtNumReferanciaErr . "'" : 'NULL';
		$NumReferanciaCorr = ($txtNumReferanciaCorr != '') ? "'" . $txtNumReferanciaCorr . "'" : 'NULL';
		
		
		
		$NumReferancia1 = ($txtNumReferancia1 != '') ? "'" . $txtNumReferancia1 . "'" : 'NULL';
        $TipoCta1 = ($slcTipoCta1 != '') ? "'" . $slcTipoCta1 . "'" : 'NULL';
		$TipoCta1 = ($slcTipoCta1 != '-1') ? "'" . $slcTipoCta1 . "'" : 'NULL';
        $Banco1 = ($slcBanco1 != '') ? "'" . $slcBanco1 . "'" : 'NULL';        
        $Banco1 = ($slcBanco1 != '-1') ? "'" . $slcBanco1 . "'" : 'NULL';
		
        $sql = "INSERT INTO Gestion (
                    Tipo_Solicitante,
                    Documento,
                    Nombre,
                    Direccion,
                    Celular,
                    Correo_electronico,
                    Tipo_reclamo_nvl_1,
                    Tipo_reclamo_nvl_2,
                    Fecha_transaccion,
                    Hora_transaccion,
                    Identificacion_terminal_punto,
                    Numero_transaccion,
                    Nombre_convenio_correcto,
                    Nombre_convenio_errado,
					
					Nombre_convenio,
                    Valor_transaccion,
					Num_referencia_o_factura_errado,
					Num_referencia_o_factura_correcto,
                    
                    Num_referencia_o_factura,
                    Num_cuenta_abono,
                    Tipo_Cta,
                    Banco,
                    Nombre_titular,
                    Cedula,
                    Fecha_gestion,
                    Nombre_asesor,
                    Documento_asesor,
                    Ciudad,
                    Departamento,
                    Observacion
                ) VALUES (
                    '" . $slcTipoSolicitante . "',
                    '" . $txtCedula . "',
                    '" . $txtNombre . "',
                    '" . $txtDireccion . "',
                    '" . $txtCelular . "',
                    '" . $txtCorreo . "',
                    '" . $slcTipoReclamoNvl1 . "',
                    " . $TipoReclamoNvl2 . ",
                    '" . $txtFechaTran1 . "',
                    '" . $txtHoraTran1 . "',
                    " . $IdenTerminal1 . ",
                    " . $NumTran1 . ",
                    " . $NomConvenioCorr . ",
                    '" . $txtNomConvenioErr . "',
                    
					'" . $txtNomConvenio2. "',
					" . $txtValorTran1 . ",					
					" . $NumReferanciaErr . ",
                    " . $NumReferanciaCorr . ",
					
                    " . $NumReferancia1 . ",
                    " . $NumCuentaAbono1 . ",
                    " . $TipoCta1 . ",
                    " . $Banco1 . ",
                    '" . $txtNombreTitu1 . "',
                    '" . $txtCedulaTitu1 . "',
                    GETDATE(),
                    '" . $Nombre . "',
                    '" . $Usuario . "',
                    '" . $slcCiudad . "',
                    '" . $slcDepartamento . "',
                    '" . $txtObservacion . "'
                )";
				//echo $sql;
        $data = $cp->database->Insert($sql);
	
        

        return $data;
    }
}
