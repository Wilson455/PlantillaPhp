$(document).ready(function () {
    
    getEstados();
    
    function getDatos() {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            type: "POST",
            datatype: "xml",
            data: ({
                'metodo': 'getDatosComponente',
                'id': $("#Id").val()
            }),
            success: function (xml) {
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                        $("#Estado").html("");
                    } else {
                        $("#Nombre").val($(this).attr('nombre'));
                        $("#Marca").val($(this).attr('marca'));
                        $("#Modelo").val($(this).attr('modelo'));
                        $("#Serial").val($(this).attr('serial'));
                        $("#Estado").val($(this).attr('idEstado'));
                        $("#IdSolicitante").val($(this).attr('idSolicitante'));
                        $("#IdEncargado").val($(this).attr('idEncargado'));
                    }
                });
            }
        });
    }

    function getEstados() {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            type: "POST",
            datatype: "xml",
            data: ({
                'metodo': 'getEstados'
            }),
            success: function (xml) {
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                        $("#Estado").html("");
                    } else {
                        $("#Estado").html($(this).text());
                    }
                });
            }
        });
    }

    $("#btnGuardar").click(function () {
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            type: "POST",
            datatype: "xml",
            data: ({
                'metodo': 'getActualizarComponente',
                'id': $("#Id").val(),
                'nombre': $("#Nombre").val(),
                'marca': $("#Marca").val(),
                'modelo': $("#Modelo").val(),
                'serial': $("#Serial").val(),
                'idEstado': $("#Estado").val(),
                'idSolicitante': $("#IdSolicitante").val(),
                'idEncargado': $("#IdEncargado").val()
            }),
            beforeSend: function () {
                bootbox.dialog({
                    message: '<table align="center"><tr><td>Cargando...</td></tr><tr><td><img src="../../imagenes/Cargando.gif"/></td></tr></table>',
                    title: "Cargando"
                });
            },
            success: function (xml) {
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                        bootbox.dialog({
                            message: '<table align="center"><tr><td>Error</td></tr><tr><td>Error al guardar.</td></tr></table>',
                            title: "Error",
                            buttons: {
                                main: {
                                    label: "Aceptar",
                                    className: "btn-primary",
                                    callback: function () {

                                    }
                                }
                            }
                        });
                    } else {
                        alert("Se ha guardado Correctamente");
                        location.href = './plantilla-tabla.php';
                        bootbox.dialog({
                            message: '<table align="center"><tr><td>Se ha guardado Correctamente</td></tr></table>',
                            title: "Guardado",
                            buttons: {
                                main: {
                                    label: "Aceptar",
                                    className: "btn-primary",
                                    callback: function () {
                                        
                                    }
                                }
                            }
                        });
                    }
                });
            }
        });
    });
    getDatos();
});