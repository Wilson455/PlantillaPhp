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

});