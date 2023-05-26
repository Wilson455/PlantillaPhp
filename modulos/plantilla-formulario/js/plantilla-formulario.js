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
                'metodo': 'getGuardarComponente',
                'nombre': $("#Nombre").val(),
                'marca': $("#Marca").val(),
                'modelo': $("#Modelo").val(),
                'serial': $("#Serial").val(),
                'idEstado': $("#IdEstado").val(),
                'idSolicitante': $("#IdSolicitante").val(),
                'idEncargado': $("#IdEncargado").val()
            }),
            success: function (xml) {
                bootbox.hideAll();
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                       console.log("NOEXITOSO");
                    } else {
                        console.log("EXITOSO");
                    }
                });
            }
        });
    });

});