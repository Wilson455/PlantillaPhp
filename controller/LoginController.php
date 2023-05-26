<?php

session_start();
require_once('../class/CapturaInformacionOracle.class.php');
$capturaO = new CapturaInformacionOracle;

$_SESSION['Usuario'] = htmlentities($_POST['usuario']);
$clave = htmlentities($_POST['password']);

$sql = "SELECT  USUARIO, NOMBRECOMPLETO
        FROM    USUARIO 
        WHERE   USUARIO = '" . $_SESSION['Usuario'] . "' 
         AND CLAVE = '" . $clave . "' AND ESTADO = 1";
$data = $capturaO->database->query($sql);

if (!$data || !$data[0]) {
    $_SESSION['error'] = 1;
    header("Location: ../login.php");
    exit;
}

$_SESSION['logged'] = true;
header("Location: ../inicio.php");
?>