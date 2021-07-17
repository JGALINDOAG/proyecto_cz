$(document).ready( function () {
    $('#pay').hide();
    $("#pagar").hide();
    $('#file').hide();
    $('#referencia').hide();
    $('#rastreo').hide();
    $('#cmbFormaPago').prop('disabled', true);
    // $('#cantidad').prop('readonly', true);
    $("#txtFechaFin").prop('disabled', true);
    $('#cmbFolio_dos').prop('disabled', true);
    
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
            $('#cmbFolio_dos').empty()
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
            $('#cmbFolio_dos').append(option);
            $('#cmbFolio_dos').prop('disabled', false);
        });

        cmbInstitucion.fail(function() {
            alert("error")
        })
    });

    $("#cmbFolio_uno").change(function () {
        var opc = 1
        var cmbFolio = $(this).val()
        var data = JSON.parse(cmbFolio)
        var folio = data.id_folio
        $('#cmbFormaPago').prop('disabled', false);
        const total = data.total
        $('#spanCantidad').html('<b>$'+ total +'</b>')
        datatable_by_folio(folio, opc)
    });
    
    $("#cmbFolio_dos").change(function () {
        var opc = 2
        var cmbFolio = $(this).val()
        var data = JSON.parse(cmbFolio)
        var folio = data.id_folio
        const total = data.total
        $('#costo').html('<b>$'+ total +'</b>')
        $('#costo_evaluado').html('---')

        $.post( "?accion=pago&pag=pagoByUser", { folio: folio })
            .done(function( data ) {
                var dataPagos = JSON.parse(data)
                var costoBruto = '<b>$' + dataPagos[0].pagoUser + '</b>'
                var total = '<b>$' + dataPagos[0].costo_individual + '</b>'
                if(dataPagos[0].pagoUser != null) {
                    $('#costo_evaluado').html(costoBruto); 
                    $('#costo_total_evaluado').html(total);
                }
            });

        datatable_by_folio(folio, opc)
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
        $('#reporte_uno').DataTable({
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
            ],
            columnDefs: [
                { className: 'text-center', targets: [2,3,4] }
            ]
        });

        var total = 0
        dataPagos.forEach(element => {
            var transaccion = JSON.parse(element.transaccion)
            total = parseInt(transaccion.total) + total
        });
        $('#total_uno').html(total)
    });

    result.fail(function() {
        alert("error")
    })
    
}

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
                    "data": 'tipo_pago'
                },
                {
                    "data": 'fecha_registro'
                },
                {
                    "data": 'transaccion', "render": function (data, type, row) {
                        var transaccion = JSON.parse(row.transaccion)
                        return transaccion.total
                    }
                }
            ],
            columnDefs: [
                { className: 'text-center', targets: [1,2] }
            ],
            order: []
        });

        var pago = 0
        dataPagos.forEach(element => {
            var transaccion = JSON.parse(element.transaccion)
            pago = parseInt(transaccion.total) + pago
        });
        $('#total').html(pago)
        if(opc === 2) {
            var folio = $('#cmbFolio_dos').val()
        } else {
            var folio = $('#cmbFolio_uno').val()
        }
        var data = JSON.parse(folio)
        if(pago == data.total) {
            $('#completed').show();
            $('#incompleted').hide();
        } 
        else {
            var resta = data.total - pago
            if(opc === 2) $('#statusPago').html('El folio cuenta con adeudo de $'+ resta + ' pesos')
            $('#incompleted').show();
            $('#completed').hide();
        } 
    });

    result.fail(function() {
        alert("error")
    })
    
}