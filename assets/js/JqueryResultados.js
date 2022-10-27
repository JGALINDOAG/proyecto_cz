$(document).ready( function () {
    // $("#cmbFolio").change(function () {
    //     var folio = $(this).val()
           dataTable()
    // });
} );
function dataTable(){
    var rol = $('#rol').html()

    var cmbFolio = $.ajax({
        method: "POST",
        url: "?accion=resultados&pag=getList"
        // data: { folio: folio }
    })

    cmbFolio.done(function( res ) {
        var dataList = JSON.parse(res)
        console.log(dataList)
        $('#listPersonas').DataTable({
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "info": "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "Dato para buscar",
                "zeroRecords": "No se han encontrado coincidencias.",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": "Ordenación ascendente",
                    "sortDescending": "Ordenación descendente"
                }
            },
            "destroy": true,
            "data": dataList,
            "columns": [
                {
                    "data": 'nombre'
                },
                {
                    "data": 'email'
                },
                {
                    "data": 'id_folio'
                },
                {
                    "data": 'institucion'
                },
                {
                    "data": 'fecha_registro'
                }
                ,
                {
                    "data": 'id_detalle', 'render': function (data, type, row) {
                        var resul = ''
                        var km = ''
                        if(row.viewResultado != null) resul = '<a href="?accion=Result&idDetalle=' + row.id_detalle + '" target="_blank"><img src="assets/img/result.svg" title="Ver resultados" width="35px"></img></a>'
                        if(rol == 1 || rol == 4) km = '<a href="?accion=Machover&idDetalle=' + row.id_detalle + '" target="_blank"><img src="assets/img/km.svg" title="Karen Machover" width="35px"></img></a>' 
                        var val = resul + km
                        return val
                    }
                }
            ],
            columnDefs: [
                { className: 'text-center', targets: [3] },
            ]
        });
    });

    cmbFolio.fail(function() {
        alert("error")
    })
}
