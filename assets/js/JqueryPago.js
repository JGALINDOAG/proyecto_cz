$(document).ready( function () {
    $('#pay').hide();
    $('#file').hide();
    $('#cmbFormaPago').prop('disabled', true);
    $('#cantidad').prop('disabled', true);
    $("#cmbFolio").change(function () {
        var folio = $(this).val()
        var cmbFolio = $.ajax({
            method: "POST",
            url: "?accion=institucionAdministrador&pag=getFolio",
            data: { folio: folio }
        })

        cmbFolio.done(function( res ) {
            $('#cantidad').empty()
            $('#cmbFormaPago').prop('disabled', false);
            var data = JSON.parse(res)
            $('#cantidad').val(data[0].costo)
        });

        cmbFolio.fail(function() {
            alert("error")
        })
    });

    $("#cmbFormaPago").change(function () {
        if($(this).val() == 1) {
            $("#hidenCarga").prop('required', false);
            $('#pay').show();
            $('#file').hide();
            $("#pagar").hide();
            $('#paypal-button-container').html('');
            // Render the PayPal button into #paypal-button-container
            paypal.Buttons({
                
                // Set up the transaction
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: $('#cantidad').val()
                            }
                        }]
                    });
                },

                // Finalize the transaction
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        if(details.status == "COMPLETED") window.location.href = '?accion=pago&pag=index&m=1'
                    });
                }
            }).render('#paypal-button-container');

        } else if($(this).val() == 2) {
            $("#hidenCarga").prop('required', false);
            $('#pay').hide();
            $('#file').hide();
            $("#pagar").show();
        } else {
            $('#pay').hide();
            $('#file').show();
            $("#hidenCarga").prop('required', true);
            $("#pagar").show();
        }
    });

    //Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        alert(fileSize)
        if(fileSize > 1000000){
            alert('El archivo no debe superar el 1MB');
            this.value = '';
            this.files[0].name = '';
        }else{
            // recuperamos la extensión del archivo
            // var ext = fileName.split('.').pop();
            // Convertimos en minúscula porque la extensión del archivo puede estar en mayúscula
            // ext = ext.toLowerCase();
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);  
        }
    });

    $( "#cantidad" ).keydown(function(evento) {
        const elemento = evento.target;
        const teclaPresionada = evento.key;
        const teclaPresionadaEsUnNumero =
        Number.isInteger(parseInt(teclaPresionada));
        const sePresionoUnaTeclaNoAdmitida = 
        teclaPresionada != 'ArrowDown' &&
        teclaPresionada != 'ArrowUp' &&
        teclaPresionada != 'ArrowLeft' &&
        teclaPresionada != 'ArrowRight' &&
        teclaPresionada != 'Backspace' &&
        teclaPresionada != 'Delete' &&
        teclaPresionada != 'Enter' &&
        !teclaPresionadaEsUnNumero;
        const comienzaPorCero = 
        elemento.value.length === 0 &&
        teclaPresionada == 0;
        if (sePresionoUnaTeclaNoAdmitida || comienzaPorCero) {
        evento.preventDefault(); 
        }
    });

    // Funcion tentativa
    $("#folio").change(function(){
        var folio=$("#folio").val();
        $.ajax({
            url: "index.php?accion=VerificaFolio",
            type: "POST",
            data: {
                folio: folio
            },
            cache: false,
            success:function(data){
                $('#info').empty();
                //console.log(data);
                $("#info").append(data);
            }
        });
    });

} );