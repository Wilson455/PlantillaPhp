$(document).ready(function () {
    getEstados();
    
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
                'id': $("#id").val(),
                'nombre': $("#nombre").val(),
                'marca': $("#marca").val(),
                'modelo': $("#modelo").val(),
                'serial': $("#serial").val(),
                'idEstado': $("#idEstado").val(),
                'idSolicitante': $("#idSolicitante").val(),
                'idEncargado': $("#idEncargado").val()
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
                        bootbox.dialog({
                            message: '<table align="center"><tr><td>Se ha guardado Correctamente</td></tr></table>',
                            title: "Guardado",
                            buttons: {
                                main: {
                                    label: "Aceptar",
                                    className: "btn-primary",
                                    callback: function () {
                                        location.href = '';
                                    }
                                }
                            }
                        });
                    }
                });
            }
        });
    });

});