<?php
ini_set('set_time_limit', 0);
session_start();
if (!isset($_SESSION['Usuario'])) {
    //si no existe usuario
    header('Location: ../../pages/AccesoDenegado.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />                        
    <link href="../../css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../css/datepicker.css" rel="stylesheet" type="text/css"/>   
    <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />          
    <script type="text/javascript" src="../../js/jquery1.9.js"></script>            
    <script type="text/javascript" src="../../js/jquery.numeric.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/bootbox.min.js" type="text/javascript"></script>
    <script src="js/plantilla-tabla.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <h1>Inventario TI </h1>
        
        <div style="width:50%;margin: auto;text-align: center;">
            <h3>Conteo de Componentes</h3>
            <table id="conteoComponentes" class="table table-striped example2" style="width:100%;">
                <thead>
                    <tr>
                        <th>COMPONENTE</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>ESTADO</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div style="margin: auto;text-align: center;">
            <h3>Lista de Componentes</h3>
            <table id="listaComponentes" class="table table-striped example" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>COMPONENTE</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>SERIAL</th>
                        <th>ESTADO</th>
                        <th>IDENCARGADO</th>
                        <th>AREA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody >
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
}
?>