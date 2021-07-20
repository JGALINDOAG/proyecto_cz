$(document).ready(function() {
    $('#confirm').hide()

    $('#msnEmail').on('click', function() {
        var email = $(this).attr('data-email')
        var nombre = $(this).attr('data-nombre')
        var usuario = $(this).attr('data-usuario')
        var clave = $(this).attr('data-clave')
        
        var cmbPeriodo = $.ajax({
            method: "POST",
            url: "?accion=administradores&pag=messageEmail",
            data: { email: email, nombre: nombre, usuario: usuario, clave: clave }
        })

        cmbPeriodo.done(function( res ) {
            $('#confirm').show()
        });

        cmbPeriodo.fail(function() {
            alert("error")
        })
    });
});
