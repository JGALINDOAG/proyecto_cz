$(document).ready( function () {
    $('#cmbFolio').prop('disabled', true);
    $('#cmbInstitucion').on('change', function() {
        var id = $(this).val()
        $('#costo').html('')
        $('#statusPago').html('Status de pago del Folio')
        var cmbInstitucion = $.ajax({
            method: "POST",
            url: "?accion=institucionAdministrador&pag=getFolioByInst",
            data: { idInstitucion: id }
        })

        cmbInstitucion.done(function( res ) {
            var option = ''
            $('#cmbFolio').empty()
            var data = JSON.parse(res);
            option +='<option value="" selected>Selecciona un folio</option>';
            data.forEach(element => {
                var opc = new Object();
                // console.log(element)
                opc.id_folio = element.id_folio;
                opc.total = element.total;
                var myString = JSON.stringify(opc);
                option +='<option value='+ myString +'>' + element.id_folio +'</option>';
            });
            $('#cmbFolio').append(option);
            $('#cmbFolio').prop('disabled', false);
        });

        cmbInstitucion.fail(function() {
            alert("error")
        })
    });

    $("#cmbFolio").change(function () {
        var opc = 2
        var cmbFolio = $(this).val()
        var data = JSON.parse(cmbFolio)
        var folio = data.id_folio
        
        // datatable_by_folio(folio, opc)
    });
} );

function datatable_by_folio(folio, opc) {
    var result = $.ajax({
        method: "POST",
        url: "?accion=pago&pag=getPagos",
        data: { folio: folio }
    })

    result.done(function( res ) {
        var dataPagos = JSON.parse(res)
        // console.log(dataPagos)
        $('#reporte').DataTable({
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
            "data": dataPagos,
            "columns": [
                {
                    "data": ''
                },
                {
                    "data": ''
                },
                {
                    "data": '', "render": function (data, type, row) {
                        // var transaccion = JSON.parse(row.transaccion)
                        return transaccion.total
                    }
                }
            ],
            columnDefs: [
                { className: 'text-center', targets: [1,2] }
            ],
            order: []
        });

    });

    result.fail(function() {
        alert("error")
    })
    
}