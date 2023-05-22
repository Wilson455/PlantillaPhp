<?php
ini_set('set_time_limit', 0);
session_start();
include 'class/CapturaInformacion.class.php';
if (!isset($_SESSION['Usuario'])) {
    //si no existe usuario
    header('Location: pages/AccesoDenegado.php');
} else {
    $cedula = $_SESSION['Usuario'];
    // echo $cedula;
    $modulo = new CapturaInformacion();
    $result = $modulo->getDatosUsuario($cedula);

    if (sizeof($result) == 0) {
//        header('Location: pages/AccesoDenegado.php');
    } else {
        $usuario = utf8_encode($result[0]['Usuario']);
        $nombre = utf8_encode($result[0]['Nombre']);
        $perfil = 'prueba';
        //$menu = $modulo->getMenuCompleto($result[0]['perfil']);
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
                <title>Plantilla</title>
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <!--<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />-->
                <link href="css/site.css" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
                <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
                <script src="js/jquery1.9.js"></script>
                <script src="js/bootbox.min.js" type="text/javascript"></script>
                <!--<script src="js/jquery.dataTables.js" type="text/javascript"></script>-->
                <script src="js/bootstrap.min.js" type="text/javascript"></script>
                <script src="js/AdminLTE/app.js" type="text/javascript"></script>
                <script src="js/inicio.js" type="text/javascript"></script>

                <style>
                    #spannumber {
                        border-radius: 50%;
                        position: absolute;
                        top: 7px;
                        right: 2px;
                        font-size: 10px;
                        font-weight: normal;
                        width: 15px;
                        height: 15px;
                        line-height: 1.0em;
                        text-align: center;
                        padding: 2px;
                    }
                </style>
            </head>
            <body class="skin-blue">
                <input type="hidden" id="txtAsesor" value="<?php echo $cedula ?>" />
                <nav class="navbar navbar-default navbar-static-top barra-sup">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a href="#">
                                <label style="font-size: 25px;color:#fff; padding-top: 7px;">Plantilla PHP</label>
                            </a>
                            <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="fa fa-bars"></i>
                                <span></span>
                            </button>
                        </div>
                        <div class="navbar-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="glyphicon glyphicon-user"></i>
                                        <span><?php echo $usuario ?><i class="caret"></i></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header bg-light-blue">                                                     
                                            <br/>
                                            <br/>
                                            <p>
                                                <font color='#0C223F'><?php echo $nombre; ?></font>
                                            </p>
                                        </li>                                
                                        <!-- Menu Footer-->
                                        <li class="user-footer">                                 
                                            <div class="pull-right">
                                                <a id="btnCerrarSession" href="controller/destroysession.php?type=2" class="btn btn-default btn-flat">Salir</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="wrapper">
                    <div id="sidebar" class="menu-lateral sidebar">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p><strong>Hola, <?php echo $nombre; ?></strong></p>
                                <span style="display: none;"><i class="fa fa-circle text-success"></i> En linea</span>
                            </li>
                            <ul class="sidebar-menu">
                                <!--Aca se carga el menu php-->
                                <li  id="1">
                                    <li>
                                        <a  class="Bloqueo" target="centerframe" href="modulos/plantilla-tabla/plantilla-tabla.php">
                                            <i class="fa fa-table"></i> <span>Menú Tabla</span>
                                        </a>
                                    </li>
                                </li>
                                <li  id="2">
                                    <li>
                                        <a  class="Bloqueo" target="centerframe" href="modulos/plantilla-formulario/plantilla-formulario.php">
                                            <i class="fa fa-list"></i> <span>Menú Formulario</span>
                                        </a>
                                    </li>
                                </li>
                                <!-- fin menu-->
                            </ul>
                        </ul>
                    </div>
                    <div id="content">
                        <iframe src="pages/blanco.php" name="centerframe" frameborder="0" class="contenido"></iframe>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#sidebarCollapse').on('click', function () {
                            $('#sidebar').toggleClass('active');
                        });
                    });
                </script>
            </body>
        </html>
        <?php
    }
}
?>