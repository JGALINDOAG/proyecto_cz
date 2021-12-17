$(document).ready(function () {
    var isTableCreated = false;

    $(document).ajaxStart(function () {
        $('#costo_evaluado').html('---');
        $('#costo_total_evaluado').html('---');
        $('#total').html('---');
        if (isTableCreated == true) {
            $('#reporte').DataTable().clear();
            $('#reporte').DataTable().destroy();
            $("#reporte").append('<tr class="text-center"><td colspan="3"><b>¡Sin resultados! Por favor elija un folio</b></td></tr>')
            isTableCreated = false
        }
    });

    $('#pay').hide();
    $("#pagar").hide();
    $('#file').hide();
    $('#referencia').hide();
    $('#rastreo').hide();
    $('#cmbFormaPago').prop('disabled', true);
    $("#txtFechaFin").prop('disabled', true);
    $('#completed').hide();

    $("#cmbFolio_uno").change(function () {
        var cmbFolio = $(this).val()
        var data = JSON.parse(cmbFolio)
        var folio = data.id_folio
        $('#cmbFormaPago').prop('disabled', false);
        const total = data.total
        $('#costo').html('<b>$' + total + '</b>')
        $('#costo_evaluado').html('---')
        datatable_by_folio(folio)
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var folio = button.data('folio') // Extract info from data-* attributes
        var abono = button.data('abono') // Extract info from data-* attributes
        pagos(folio)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#folio_title').html('Folio: <b>' + folio + '</b>')
        modal.find('#abono_total').html('Abono: <b>' + abono + '</b>')
    })

    $("#cmbFormaPago").change(function () {
        var data = JSON.parse($(this).val());
        if (data.key == 1) {
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
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: $('#cantidad').val()
                            }
                        }]
                    });
                },

                // Finalize the transaction
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        if (details.status == "COMPLETED") {
                            // console.log(details)
                            $.get("?accion=pago&pag=paypal", { cmbFolio: $('#cmbFolio').val(), cmbFormaPago: $('#cmbFormaPago').val(), txtCantidad: $('#cantidad').val() })
                                .done(function (data) {
                                    location.href = "?accion=pago&pag=index&m=vLBLfhA6DNi1R2MFHO8IvFWr4Cn9665eHUF+L/sqAKNhbGdvcml0bW8xL0NydXplYWM=";
                                }
                                );
                        }
                    });
                }
            }).render('#paypal-button-container');

        } else if (data.key == 2) {
            $("#hidenCarga, #txtReferencia, #txtRastreo, #txtFolio, #txtLinea").prop('required', false);
            $('#pay').hide();
            $('#file').hide();
            $('#divReferencia').hide();
            $('#divRastreo').hide();
            $('#divFolio').hide();
            $('#divLinea').hide();
            $("#pagar").show();
        } else if (data.key == 3) {
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
    $(".custom-file-input").on("change", function () {
        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        // alert(fileSize)
        if (fileSize > 1000000) {
            alert('El archivo no debe superar el 1MB');
            this.value = '';
            this.files[0].name = '';
        } else {
            // alert('Archivo cargado');
            // recuperamos la extensión del archivo
            // var ext = fileName.split('.').pop();
            // Convertimos en minúscula porque la extensión del archivo puede estar en mayúscula
            // ext = ext.toLowerCase();
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        }
    });

    $("#cantidad").keydown(function (evento) {
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
        if (fechaInicio != '' && fechaFin != '') datatable(fechaInicio, fechaFin)
    });

});

function datatable(fechaInicio, fechaFin) {
    var result = $.ajax({
        method: "POST",
        url: "?accion=pago&pag=getReport",
        data: { fechaInicio: fechaInicio, fechaFin: fechaFin }
    })

    result.done(function (res) {
        var dataPagos = JSON.parse(res)
        // console.log(dataPagos)
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
                    "data": 'fecha_emision'
                },
                {
                    "data": 'institucion'
                },
                {
                    "data": 'nombre'
                },
                {
                    "data": 'costo', 'render': function (data, type, row) {
                        return '$' + row.costo;
                    }
                },
                {
                    "data": 'num_vendidas', 'render': function (data, type, row) {
                        return row.num_vendidas;
                    }
                },
                {
                    "data": 'pagoUser', 'render': function (data, type, row) {
                        var pagoUser
                        if (row.pagoUser != null) {
                            pagoUser = '$' + row.pagoUser
                        } else {
                            pagoUser = '$0'
                        }
                        return pagoUser;
                    }
                },
                {
                    "data": 'costo_total', 'render': function (data, type, row) {
                        return '$' + row.costo_total;
                    }
                },
                {
                    "data": 'pagos', 'render': function (data, type, row) {
                        var abono
                        if (row.pagos != null) {
                            var pagos = JSON.parse(row.pagos)
                            abono = '$' + pagos.abono
                        } else {
                            abono = '$0'
                        }
                        return abono;
                    }
                },
                {
                    "data": 'pagos', 'render': function (data, type, row) {
                        var adeudo
                        if (row.pagos != null) {
                            var pagos = JSON.parse(row.pagos)
                            adeudo = '$' + pagos.adeudo
                        } else {
                            adeudo = '$' + row.costo_total
                        }
                        return adeudo;
                    }
                },
                {
                    "data": 'id_folio', 'render': function (data, type, row) {
                        var abono
                        if (row.pagos != null) {
                            var pagos = JSON.parse(row.pagos)
                            abono = '$' + pagos.abono
                        } else {
                            abono = '$0'
                        }
                        var link = '<a type="button" data-toggle="modal" data-target="#exampleModal" data-folio="' + data + '" data-abono="' + abono + '" >' +
                            ' <img src="assets/img/result.svg" title="Ver más" width="35px" />' +
                            ' </a>';
                        return link;
                    }
                }
            ],
            columnDefs: [
                { orderable: false, targets: [5, 6, 7, 8, 9] },
                { className: 'text-center', targets: [2, 3, 4, 5, 6, 9] }
            ],
            order: []
        });

        var total = 0
        dataPagos.forEach(element => {
            var pagos = JSON.parse(element.pagos)
            if (pagos != null) total = parseInt(pagos.abono) + total
        });
        $('#total_uno').html('$' + total)
    });

    result.fail(function () {
        alert("error")
    })

}

function datatable_by_folio(folio) {
    var result = $.ajax({
        method: "POST",
        url: "?accion=pago&pag=getPagos",
        data: { folio: folio }
    })

    result.done(function (res) {
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
                { className: 'text-center', targets: [1, 2] }
            ],
            order: []
        });

        var pago = 0
        dataPagos.forEach(element => {
            var transaccion = JSON.parse(element.transaccion)
            pago = parseInt(transaccion.total) + pago
        });
        $('#total').html(pago)
        // if(opc === 2) {
        //     var folio = $('#cmbFolio_dos').val()
        // } else {
        var folio = $('#cmbFolio_uno').val()
        // }
        var data = JSON.parse(folio)
        if (pago == data.total) {
            $('#completed').show();
            $('#incompleted').hide();
        }
        else {
            var resta = data.total - pago
            $('#statusPago').html('El folio cuenta con adeudo de <b>$' + resta + '</b> pesos')
            $('#incompleted').show();
            $('#completed').hide();
        }
    });

    result.fail(function () {
        alert("error")
    })

}

function pagos(folio) {
    $.post("?accion=pago&pag=getPagos", { folio: folio })
        .done(function (data) {
            var pagos = JSON.parse(data)
            console.log(pagos.length)
            if(pagos.length > 0){
                var tbody = ''
                var i = 1
                console.log(pagos)
                pagos.forEach(element => {
                    var transaccion = JSON.parse(element.transaccion)
                    tbody += '<tr>' +
                    '   <th scope = "row" >'+ i +'</th>' +
                    '   <td>'+ element.fecha_registro +'</td>' +
                    '   <td>'+ element.tipo_pago +'</td>' +
                    '   <td>'+ transaccion.total +'</td>' +
                    '   <td>'+ transaccion.referencia +'</td>' +
                    '   <td>'+ transaccion.clv_rastreo +'</td>' +
                    '   <td class="text-center"><a href='+ transaccion.vaucher +' target="_blank"><img src="assets/img/result.svg" title="Ver vaucher" width="35px" /></a></td>' +
                    ' </tr > ';
                    i++
                });
            } else {
                tbody = '<tr><td colspan="7" class="text-center">No hay historial de pagos en la base.</td></tr>'
            }
            $('#tbody').html(tbody)
        });
}