$(document).ready(function () {
    getListaComponentes();
    getConteoComponentes();
    
    $('.example').DataTable({
        destroy: true,
        ordering: false,
        bLengthChange: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    $('.example2').DataTable({
        destroy: true,
        searching: false,
        info: false,
        ordering: false,
        bLengthChange: false,
        //paging: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    function getListaComponentes() {
       
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            type: "POST",
            datatype: "xml",
            async: false,
            data: ({
                'metodo': 'getListaComponentes'
            }),
            success: function (xml) {
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                        $("#listaComponentes").dataTable().fnClearTable();
                    } else {
                        $("#listaComponentes").dataTable({destroy: true,}).fnAddData([
                            $(this).attr('ID'),
                            $(this).attr('NOMBRE'),
                            $(this).attr('MARCA'),
                            $(this).attr('MODELO'),
                            $(this).attr('SERIAL'),
                            $(this).attr('ESTADO'),
                            $(this).attr('IDSOLICITANTE'),
                            $(this).attr('IDENCARGADO'),
                            '<button class="btn btn-primary" onclick="editar(' + $(this).attr('ID') + ')">Editar</button>'
                        ]);
                    }
                });
            }
        });
    }

    function getConteoComponentes() {
       
        $.ajax({
            url: "../../controller/CapturaInformacionController.php",
            type: "POST",
            datatype: "xml",
            async: false,
            data: ({
                'metodo': 'getConteoComponentes'
            }),
            success: function (xml) {
                $(xml).find('registro').each(function () {
                    if ($(this).text() == 'NOEXITOSO') {
                        $("#conteoComponentes").dataTable().fnClearTable();
                    } else {
                        $("#conteoComponentes").dataTable({destroy: true,}).fnAddData([
                            $(this).attr('NOMBRE'),
                            $(this).attr('MARCA'),
                            $(this).attr('MODELO'),
                            $(this).attr('ESTADO'),
                            $(this).attr('CONTEO'),
                        ]);
                    }
                });
            }
        });
    }
});

function editar(id) {
    console.log(id);
    window.location = './plantilla-editar.php';
}