<?php

require_once('DataBase.interface.php');

class SQLServerDatabase implements IDataBase {

    //  Pruoduccion
    var $host = "localhost\\SQLEXPRESS";
    var $database = "Prueba";
    var $user = "usr_microservices";
    var $pass = "123456789";
   
    var $conn;
    var $numRows;

    function __construct() {
        $this->conectar($this->host, $this->user, $this->pass, $this->database);
    }

    public function conectar($_host, $_user, $_password, $_database) {
        $connectionInfo = array("DATABASE" => $_database, "UID" => $_user, "PWD" => $_password, "ReturnDatesAsStrings" => true, "MultipleActiveResultSets" => false);
        $this->conn = sqlsrv_connect("$_host", $connectionInfo) or die(print_r(print_r(sqlsrv_errors())));
    }

    function query($sql) {
        sqlsrv_query($this->conn, 'SET ANSI_WARNINGS ON') or die(print_r(sqlsrv_errors()));
        sqlsrv_query($this->conn, 'SET ANSI_NULLS ON') or die(print_r(sqlsrv_errors()));

        $result = sqlsrv_query($this->conn, $sql) or die(print_r(sqlsrv_errors()));
        // echo print_r(sqlsrv_errors());
        $resultados = array();

        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
            $resultados[] = $row;
        // var_dump($resultados);
        return $resultados;
    }

    function exportQuery($sql) {
        sqlsrv_query($this->conn, 'SET ANSI_WARNINGS ON') or die(print_r(sqlsrv_errors()));
        sqlsrv_query($this->conn, 'SET ANSI_NULLS ON') or die(print_r(sqlsrv_errors()));

        $result = sqlsrv_query($this->conn, $sql) or die(print_r(sqlsrv_errors()));
        return $result;
    }
	
	function exportQuery2($sql) {
        sqlsrv_query($this->conn, 'SET ANSI_WARNINGS ON') or die(print_r(sqlsrv_errors()));
        sqlsrv_query($this->conn, 'SET ANSI_NULLS ON') or die(print_r(sqlsrv_errors()));

        $result = sqlsrv_query($this->conn, $sql) or die(print_r(sqlsrv_errors()));
	}

    function nonReturnQuery($sql) {
        sqlsrv_query($this->conn, 'SET ANSI_WARNINGS ON') or die(print_r(sqlsrv_errors()));
        sqlsrv_query($this->conn, 'SET ANSI_NULLS ON') or die(print_r(sqlsrv_errors()));
        try {
            $estado = @sqlsrv_query($this->conn, $sql);
            if ($estado === false)
                return -1;
        } catch (Exception $e) {
            throw $e;
            //die();
        }
        return 1;
    }

    function Insert($sql) {
        $result = sqlsrv_query($this->conn, $sql . "; SELECT SCOPE_IDENTITY()") or die(print_r(sqlsrv_errors()));
        sqlsrv_next_result($result);
        sqlsrv_fetch($result);
        return sqlsrv_get_field($result, 0);
    }

    /**
     * Realiza una consulta en la basa de datos segun parametros
     * 
     * @version 1,0
     * @author Fabio Quintero 2014-01-17
     * @author Ivan Camilo Cano <Co-Author>
     * @param String $tabla Tabla valida de la base de datos
     * @param Array $campos Campos de la tabla para seleccionar
     * @param Array $parametros Default NULL, campos por los cuales se va a filtrar
     * @param Array $operadores Default NULL, operadores  =, !=, >, >=, <, <=, LIKE
     * @param Array $valores Default NULL, valores de busqueda
     * @param Array $operadoresLogico Default NULL, And , Or
     * @param String $orderBy Description Default NULL, cvampo por el cual se av aordenar la consulta
     * @param String $orderMethod Default ASC, Asc, Desc
     * @return Array resultados de la busqueda
     * 
     * @throws Exception
     */
    function SelectSimple($tabla, $campos, $parametros = null, $operadores = null, $valores = null, $operadoresLogico = null, $orderBy = null, $orderMethod = "ASC") {

        if (empty($tabla) || is_null($tabla))
            throw new Exception("La tabla no puede ser vacia");
        $sql = "Select ";
        $whereStr = "WHERE ";

        if (!is_array($campos) || count($campos) == 0)
            throw new Exception("Los campos deben ser un arreglo con longitud > 1");

        $sql .= implode(",", $campos) . " FROM $tabla ";

        // if(!is_null($operadoresLogico)&& !is_array($operadoresLogico) || count($operadoresLogico) == 0) throw new Exception ("se espera al menos un ooperador logico");

        if (!is_null($parametros) && !is_null($operadores) && !is_null($valores)) {
            if ($paramVals = array_combine($parametros, $valores)) {

                //Operador tiene un posicion o tiene la misma cantidad que el paramVals
                if (count($operadores) == 1) {
                    $operador = $operadores[0];
                } else if (count($operadores) != count($paramVals))
                    throw new Exception("cantidad de parametros con operadores no coincide");

                if ((count($paramVals) > 1)) {
                    if (count($operadoresLogico) == 0)
                        throw new Exception("Operadores logicos esperados");
                    else if (count($operadoresLogico) == 1)
                        $operadorLogico = $operadoresLogico[0];
                    else if (!count($operadoresLogico) != (count($paramVals) - 1))
                        throw new Exception("Operadores logicos debe ser count(paramvals -1");
                }

                $index = 0;
                foreach ($paramVals as $parametro => $valor) {


                    $whereStr .= isset($operador) ? $parametro . " " . $operador : $parametro . " " . $operadores[$index];
                    $whereStr .= "'" . $valor . "' ";
                    $whereStr .= isset($operadorLogico) && $index < count($paramVals) - 1 ? $operadorLogico . " " : $operadoresLogico[$index] . " ";
                    $index++;
                }
            } else
                throw new Exception("No se puede combinar parametros y valores");
        }

        $sql .= $whereStr;
        if (!is_null($orderBy))
            $sql .= " ORDER BY " . $orderBy . " " . $orderMethod;


        $result = sqlsrv_query($this->conn, $sql) or die(print_r(sqlsrv_errors()));
        $resultados = array();
        while ($row = sqlsrv_fetch_array($result))
            array_push($resultados, $row);

        return $resultados;
    }

    /**
     * Realiza una consulta en la basa de datos segun parametros y retorna un combo
     * 
     * @version 1,0
     * @author Ivan Camilo Cano
     * @param String $idCombo Id del combo a crear
     * @param String $tabla Tabla valida de la base de datos
     * @param Array $campos Areglo donde recibe en la posicion 0 EL id y en la posicion 1 El nombre o descripcion de la base
     * @param Array $parametros Default NULL, campos por los cuales se va a filtrar
     * @param Array $operadores Default NULL, operadores  =, !=, >, >=, <, <=, LIKE
     * @param Array $valores Default NULL, valores de busqueda
     * @param Array $operadoresLogico Default NULL, And , Or
     * @param String $orderBy Description Default NULL, cvampo por el cual se av aordenar la consulta
     * @param String $orderMethod Default ASC, Asc, Desc
     * @return Array objeto Html con option y values
     * 
     * @throws Exception
     */
    function SelectCombo($tabla, $campos, $parametros = null, $operadores = null, $valores = null, $operadoresLogico = null, $orderBy = null, $orderMethod = "ASC") {

        if (empty($tabla) || is_null($tabla))
            throw new Exception("La tabla no puede ser vacia");
        $sql = "Select ";
        $whereStr = "WHERE ";

        if (!is_array($campos) || count($campos) == 0)
            throw new Exception("Los campos deben ser un arreglo con longitud > 1");

        $sql .= implode(",", $campos) . " FROM $tabla ";

        // if(!is_null($operadoresLogico)&& !is_array($operadoresLogico) || count($operadoresLogico) == 0) throw new Exception ("se espera al menos un ooperador logico");

        if (!is_null($parametros) && !is_null($operadores) && !is_null($valores)) {
            if ($paramVals = array_combine($parametros, $valores)) {

                //Operador tiene un posicion o tiene la misma cantidad que el paramVals
                if (count($operadores) == 1) {
                    $operador = $operadores[0];
                } else if (count($operadores) != count($paramVals))
                    throw new Exception("cantidad de parametros con operadores no coincide");

                if ((count($paramVals) > 1)) {
                    if (count($operadoresLogico) == 0)
                        throw new Exception("Operadores logicos esperados");
                    else if (count($operadoresLogico) == 1)
                        $operadorLogico = $operadoresLogico[0];
                    else if (!count($operadoresLogico) != (count($paramVals) - 1))
                        throw new Exception("Operadores logicos debe ser count(paramvals -1");
                }

                $index = 0;
                foreach ($paramVals as $parametro => $valor) {


                    $whereStr .= isset($operador) ? $parametro . " " . $operador : $parametro . " " . $operadores[$index];
                    $whereStr .= "'" . $valor . "' ";
                    $whereStr .= isset($operadorLogico) && $index < count($paramVals) - 1 ? $operadorLogico . " " : $operadoresLogico[$index] . " ";
                    $index++;
                }
            } else
                throw new Exception("No se puede combinar parametros y valores");
        }

        $sql .= $whereStr;
        if (!is_null($orderBy))
            $sql .= " ORDER BY " . $orderBy . " " . $orderMethod;


        $result = sqlsrv_query($this->conn, $sql) or die(print_r(sqlsrv_errors()));
        $resultados = array();
        while ($row = sqlsrv_fetch_array($result))
            array_push($resultados, $row);





        $htmlObject .= '<option value="-1">Seleccione...</option>';

        for ($i = 0; $i < count($resultados); $i++)
            $htmlObject .= '<option value="' . $resultados[$i][$campos[0]] . '">' . utf8_encode($resultados[$i][$campos[1]]) . '</option>';


        return $htmlObject;
    }

    /**
     * Realiza una insercion simple a una base de datos.
     * 
     * Los campos y los valores deben estar en el mismo orden para una insercion exitosa
     * 
     * @version 1,0
     * @param String $tabla Tabla valida para la insercion
     * @param Array $campos campos validos apra la insercion de los datos
     * @param Array $valores valores a insertar
     * @return True o numero de filas afectadas
     * @throws Exception
     */
    function Insertar($tabla, $campos, $valores) {

        $mapCamVal = array_combine($campos, $valores);

        if (empty($tabla) || is_null($tabla))
            throw new Exception("La tabla no puede ser vacia");
        if (!is_array($campos) || count($campos) == 0)
            throw new Exception("Los campos deben ser un arreglo con longitud > 1");
        if (!is_array($valores) || count($valores) == 0)
            throw new Exception("Los valores deben ser un arreglo con longitud > 1");

        $sqlCampos = array();
        $sqlValores = array();
        foreach ($mapCamVal as $key => $value) {

            if ($value !== "" && $value != null && $value != "null") {

                array_push($sqlCampos, $key);
                array_push($sqlValores, "'" . $value . "'");
            }
        }
        $sql = "Insert into $tabla (" . implode(',', $sqlCampos) . ") values (" . implode(',', $sqlValores) . "); SELECT SCOPE_IDENTITY() AS Id";

        try {
            $estado = sqlsrv_query($this->conn, utf8_decode($sql));

            if ($estado === false)
                throw new Exception(print_r(sqlsrv_errors()) . " check this: " . $sql);
        } catch (Exception $e) {
            throw $e;
            //die();
        }
        if ($estado === true) {
            return true;
        } else {

            $estado = sqlsrv_fetch_array($estado);

            return $estado["Id"];
        }
    }

    /**
     * Realiza una actualizacion simple a una Tabla de base de datos.
     * 
     * Los campos y los valores deben estar en el mismo orden para una actualizacion exitosa
     * 
     * @version 1,0
     * @param String $tabla Tabla valdia para actualizacion de los datos
     * @param Array $campos Campos validos a actualizar de la tabla
     * @param Array $valores Valores para actualizar los campos
     * @param String $condicion Default="" Condicion para actualizacion Ejem: "Documento=123"
     * @return True Tambien puede retornar numero de filas afectadas
     * @throws Exception
     */
    function Update($tabla, $campos, $valores, $condicion = "") {

        if (empty($tabla) || is_null($tabla))
            throw new Exception("La tabla no puede ser vacia");
        if (!is_array($campos) || count($campos) == 0)
            throw new Exception("Los campos deben ser un arreglo con longitud > 1");
        if (!is_array($valores) || count($valores) == 0)
            throw new Exception("Los valores deben ser un arreglo con longitud > 1");

        $mapCamVal = array_combine($campos, $valores);
        $arraySql = array();
        $sql = "Update $tabla set ";
        $where;
        foreach ($mapCamVal as $key => $value) {

            array_push($arraySql, "$key='" . ereg_replace("'", '"', $value) . "'");
        }

        if ($condicion != "") {
            $where = "Where $condicion";
        } else {
            $where = "";
        }

        $sql .= implode(",", $arraySql) . " $where";
        try {
            $estado = sqlsrv_query($this->conn, utf8_decode($sql));
            if (!$estado)
                throw new Exception(print_r(sqlsrv_errors()) . " check this: " . $sql);
        } catch (Exception $e) {
            throw $e;
            //die();
        }
        if ($estado === true) {
            return true;
        } else {
            return sqlsrv_rows_affected($estado);
        }
    }
	
	
	
    function query2($sql) {
        sqlsrv_query('SET ANSI_WARNINGS ON', $this->conn) or die(sqlsrv_errors());
        sqlsrv_query('SET ANSI_NULLS ON', $this->conn) or die(sqlsrv_errors());

        $result = sqlsrv_query($sql, $this->conn) or die(sqlsrv_errors());
        $resultados = array();
        while ($row = sqlsrv_fetch_array($result))
            $resultados[] = $row;
        return $resultados;
    }

}

?>
