$(document).ready( function () {
    $('#user').DataTable({
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
        dom: 'Plfrtip',
        searchPanes: {
            layout: 'columns-1'
        },
        columnDefs: [
            { "orderable": false, "targets": [1] },
            {
                searchPanes: {
                    show: true
                },
                targets: [3],
            }
        ]
    });

   $("#MarcarTodos").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      if($(this).prop("checked")) $("#active").html('&nbsp;Desactivar');
      else $("#active").html('&nbsp;Activar');
   });

} );