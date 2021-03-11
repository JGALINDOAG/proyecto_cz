$(document).ready(function() {
    // Bloqueamos el SELECT de Adm.
    $("#cmbAdmin").prop('disabled', true);

    $('#cmbInstitucion').on('change', function() {
        var id = $(this).val()
        var opc = 'listAdmin'
        var cmbPeriodo = $.ajax({
            method: "GET",
            url: "?accion=institucion&pag=listAdmin",
            data: { idInstitucion: id }
        })

        cmbPeriodo.done(function( res ) {
            var option = ''
            $('#cmbAdmin').empty()
            var data = JSON.parse(res);
            // console.log(data)
            option +='<option value="" selected>Selecciona un administrador</option>';
            data.forEach(element => {
                option +='<option value='+ element.id_admin +'>' + element.nombre +'</option>';
            });
            $('#cmbAdmin').append(option);
            $('#cmbAdmin').prop('disabled', false);
        });

        cmbPeriodo.fail(function() {
            alert("error")
        })
    });
});
