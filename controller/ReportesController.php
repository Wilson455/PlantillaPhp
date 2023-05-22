<?php

require_once '../class/Reportes.class.php';
ini_set('set_time_limit', 0);
session_start();
switch ($_REQUEST['metodo']) {
    default:
        $metodo = $_REQUEST['metodo'];
        $data = Reportes::$metodo($_POST);
        echo json_encode($data);
        break;
}
?>