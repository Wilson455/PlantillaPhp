<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Plantilla</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery1.9.js"></script>     
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/bootbox.min.js" type="text/javascript"></script>  
        <style>
            .logo {
                margin: 5% auto;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 logo">
                    <h1>Plantilla PHP</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Iniciar sesi&oacute;n</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="controller/LoginController.php" class="form-horizontal">
                                <div class="form-group">
                                    <label for="usuario" class="col-md-4 control-label">Usuario:</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="usuario" id="usuario" class="form-control text-center" autocomplete="off" />
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Contrase&ntilde;a:</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control text-center" />
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-6">
                                        <button type="submit" name="btnLogin" value="Ingresar" class="btn btn-primary pull-right" >Ingresar <span class="glyphicon glyphicon-log-in"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            <?php if ($_SESSION['error']) { ?>
                <?php unset($_SESSION['error']) ?>
                bootbox.dialog({
                    title: "Informaci&oacute;n",
                    message: "Usuario y/o contrase&ntilde;a incorrectos",
                    buttons: {
                        Aceptar: function(){
                            bootbox.hideAll();
                        }
                    }
                });
            <?php } ?>
        </script>
    </body>
</html>