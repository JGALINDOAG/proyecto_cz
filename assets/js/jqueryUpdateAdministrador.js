$(document).ready(function() {
    $('#updateModal #msnUpdate').hide()

    $('#cmbInstitucion').on('change', function() {
        var idInstitucion = $(this).val()
        dataTable(idInstitucion)
    });

    $('#updateModal').on('show.bs.modal', function (event) {
        $('#cmbCargo').empty()
        $('#cmbInstitucion_modal').empty()
        $('#updateModal #msnUpdate').hide()
        var button = $(event.relatedTarget) // Button that triggered the modal
        var nombre = button.data('nombre') // Extract info from data-* attributes
        var apellido = button.data('apellido') // Extract info from data-* attributes
        var email = button.data('email') // Extract info from data-* attributes
        var telefono = button.data('telefono') // Extract info from data-* attributes
        var idRol = button.data('id_rol') // Extract info from data-* attributes
        var idAdmin = button.data('id_admin') // Extract info from data-* attributes
        // var idInstitucion = $('#cmbInstitucion').val() // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ACTUALIZAR USUARIO')
        modal.find('#txtNombre').val(nombre)
        modal.find('#txtApellido').val(apellido)
        modal.find('#txtEmail').val(email)
        modal.find('#txtTelefono').val(telefono)
        modal.find('#idAdmin').val(idAdmin)

        // $.post( "?accion=administradores&pag=ctg_institucion", function( data ) {
        //     var option = ''
        //     var json = JSON.parse(data)
        //     // console.log(json)
        //     json.forEach(element => {                   
        //         var selected = ''
        //         if(element.id_institucion == idInstitucion) selected = 'selected'
        //         option +='<option value='+ element.id_rol + ' ' + selected + '>' + element.nombre +'</option>';
        //     });
        //     $('#cmbInstitucion_modal').append(option)
        // });

        $.post( "?accion=administradores&pag=ctg_cRol", function( data ) {
            var option = ''
            var json = JSON.parse(data)
            // console.log(json)
            json.forEach(element => {                   
                var selected = ''
                if(element.id_rol == idRol) selected = 'selected'
                option +='<option value='+ element.id_rol + ' ' + selected + '>' + element.nombre +'</option>';
            });
            $('#cmbCargo').append(option)
        });

    })

    $("#formUpdate").submit(function(event){ 
        event.preventDefault();
        
        if (confirm("¿Estas seguro de actualizar está información?")) {
            
            var formData = new FormData($('#formUpdate')[0]);
            
            var request = $.ajax({
                url: "?accion=administradores&pag=update",    //Leerá la url en la etiqueta action del formulario (archivo.php)
                method: "POST", //Leerá el método en etiqueta method del formulario
                data: formData,                //Variable serializada más arriba 
                cache: false,
                contentType: false,
                processData: false
            });

            //Este bloque se ejecutará si no hay error en la petición
            request.done(function (respuesta) {
                // var data = JSON.parse(respuesta);
                $('#updateModal #msnUpdate').show()
            });

            //Este bloque se ejecuta si hay un error
            request.fail(function (jqXHR, textStatus) {
                alert("Hubo un error: " + textStatus);
            });

        }
    });
});

function dataTable(idInstitucion) {
    
        var cmbInstitucion = $.ajax({
            method: "POST",
            url: "?accion=administradores&pag=getAdmin",
            data: { idInstitucion: idInstitucion }
        })

        cmbInstitucion.done(function( res ) {
            var dataList = JSON.parse(res)
            // console.log(dataList)

            $('#listPersonal').DataTable({
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
                        "data": 'nombre', 'render': function (data, type, row) {
                            return row.nombre + ' ' + row.apellidos
                        }
                    },
                    {
                        "data": 'id_admin', 'render': function (data, type, row) {
                            var resul = '<img type="button" src="assets/img/edit_user.svg" title="Editar usuario" width="35px" data-toggle="modal" data-target="#updateModal"'
                            + ' data-nombre="'+row.nombre+'" data-apellido="'+row.apellidos+'" data-email="'+row.email+'" data-telefono="'+row.telefono+'"'
                            + ' data-id_rol="'+row.id_rol+'" data-id_admin="'+row.id_admin+'"></img>'
                            return resul
                        }
                    }
                ],
                columnDefs: [
                    { "orderable": false, "targets": [1] },
                    { className: 'text-center', targets: [1] },
                ]
            });

        });

        cmbInstitucion.fail(function() {
            alert("error")
        })
}
