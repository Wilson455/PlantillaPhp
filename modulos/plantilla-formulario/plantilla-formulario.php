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
    <!--<link href="css/plantilla-formulario.css" rel="stylesheet" type="text/css"/>-->
    <script type="text/javascript" src="../../js/jquery1.9.js"></script>            
    <script type="text/javascript" src="../../js/jquery.numeric.js"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/bootbox.min.js" type="text/javascript"></script>
    <script src="js/plantilla-formulario.js" type="text/javascript"></script>
</head>
<body>
        <div class="container" id="datoscliente">
            <div class="row">
                <div>
                    <div class="page-header">
                        <h2>Formulario</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <form>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInput1">Nombre</label>
                            <input type="text" class="form-control" id="exampleInput1" placeholder="Ingrese el nombre" style="border-radius: 0.5rem !important;">
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                            <label for="exampleInput1">Edad</label>
                            <input type="text" class="form-control" id="exampleInput1" placeholder="Ingrese la edad" style="border-radius: 0.5rem !important;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese el correo" style="border-radius: 0.5rem !important;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Estado</label>
                            <select class="form-control" id="exampleFormControlSelect1" style="border-radius: 0.5rem !important;">
                            <option>Disponible</option>
                            <option>Devuelto</option>
                            <option>Dañado</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
<?php
}
?>