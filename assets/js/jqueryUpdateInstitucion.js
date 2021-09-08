$(document).ready(function() {
    $('#cmbInstitucion').on('change', function() {
        var id = $(this).val()

        var cmbPeriodo = $.ajax({
            method: "POST",
            url: "?accion=institucion&pag=getInstitucion",
            data: { idInstitucion: id }
        })

        cmbPeriodo.done(function( res ) {
            
            var json = JSON.parse(res)
            var option = ''
            // console.log(json)
            $('#txtNombreInst').val(json['nombre'])
            $('#txtAbreviatura').val(json['abreviatura'])
            $('#txtRFC').val(json['rfc'])
            $('#txtEmail').val(json['email'])
            $('#txtTelefono').val(json['telefono'])
            $('#cmbPrueba').empty()
            if (id == 1) $('#cmbPrueba').prop('disabled', true)
            else $('#cmbPrueba').prop('disabled', false)
            // console.log(json['pruebas'])
            $.post( "?accion=institucion&pag=listPruebas", function( data ) {
                var jsonPruebas = JSON.parse(data)
                // console.log(jsonPruebas)
                jsonPruebas.forEach(element => {                   
                    var pruebas = json['pruebas'].split(",")
                    // console.log(pruebas)
                    var selected = ''
                    pruebas.forEach(result => {
                        if(result === element.id_prueba) selected = 'selected'
                    });
                    option +='<option value='+ element.id_prueba +' ' + selected + '>' + element.prueba +'</option>';
                });
                $('#cmbPrueba').append(option)
            });
            
        });

        cmbPeriodo.fail(function() {
            alert("error")
        })
    });
});
