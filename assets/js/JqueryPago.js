$(document).ready( function () {
    $('#pay').hide();
    $("#pagar").hide();
    $('#file').hide();
    $('#referencia').hide();
    $('#rastreo').hide();
    $('#cmbFormaPago').prop('disabled', true);
    $('#cantidad').prop('readonly', true);
    $("#txtFechaFin").prop('disabled', true);

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
        var data = JSON.parse($(this).val());
        // console.log(data)
        if(data.key == 1) {
            $("#hidenCarga").prop('required', false);
            $('#pay').show();
            $('#file').hide();
            $("#pagar").hide();
            $('#referencia').hide();
            $('#rastreo').hide();
            $('#folio').hide();
            $('#linea').hide();
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
                        if(details.status == "COMPLETED") {
                            // console.log(details)
                            $.get( "?accion=pago&pag=paypal", { cmbFolio: $('#cmbFolio').val(), cmbFormaPago: $('#cmbFormaPago').val(), txtCantidad: $('#cantidad').val()})
                                .done(function( data ) {
                                    location.href ="?accion=pago&pag=index&m=1";
                                }
                            );
                        }
                    });
                }
            }).render('#paypal-button-container');

        } else if(data.key == 2) {
            $("#hidenCarga, #txtReferencia, #txtRastreo, #txtFolio, #txtLinea").prop('required', false);
            $('#pay').hide();
            $('#file').hide();
            $('#divReferencia').hide();
            $('#divRastreo').hide();
            $('#divFolio').hide();
            $('#divLinea').hide();
            $("#pagar").show();
        } else if(data.key == 3) {
            $('#pay').hide();
            $('#file').show();
            $('#divReferencia').show();
            $('#divRastreo').show();
            $('#divFolio').hide();
            $('#divLinea').hide();
            $("#hidenCarga, #txtReferencia, #txtRastreo").prop('required', true);
            $("#pagar").show();
        } else {
            $('#pay').hide();
            $('#file').show();
            $('#divReferencia').hide();
            $('#divRastreo').hide();
            $('#divFolio').show();
            $('#divLinea').show();
            $("#hidenCarga, #txtFolio, #txtLinea").prop('required', true);
            $("#pagar").show();
        }
    });

    //Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        // alert(fileSize)
        if(fileSize > 1000000){
            alert('El archivo no debe superar el 1MB');
            this.value = '';
            this.files[0].name = '';
        }else{
            // alert('Archivo cargado');
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

    $("#txtFechaInicio").change(function () {
        $("#txtFechaFin").prop('disabled', false);
    });

    $("#txtFechaFin").change(function () {
        var fechaInicio = $('#txtFechaInicio').val()
        var fechaFin = $('#txtFechaFin').val()
        if(fechaInicio != '' && fechaFin != '') datatable(fechaInicio, fechaFin)
    });

} );

function datatable(fechaInicio, fechaFin) {
    var result = $.ajax({
        method: "POST",
        url: "?accion=pago&pag=getReport",
        data: { fechaInicio: fechaInicio, fechaFin: fechaFin }
    })

    result.done(function( res ) {
        var dataPagos = JSON.parse(res)
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
                    "data": 'id_folio'
                },
                {
                    "data": 'institucion'
                },
                {
                    "data": 'tipo_pago'
                },
                {
                    "data": 'fecha_registro'
                },
                {
                    "data": 'transaccion', 'render': function (data, type, row) {
                        var transaccion = JSON.parse(row.transaccion)
                        return transaccion.total
                    }
                }
            ]
        });

        var total = 0
        dataPagos.forEach(element => {
            var transaccion = JSON.parse(element.transaccion)
            total = parseInt(transaccion.total) + total
        });
        $('#total').html(total)
    });

    result.fail(function() {
        alert("error")
    })
    
}