$(document).ready(function () {
    var isTableCreated = false;

    $(document).ajaxStart(function () {
        if (isTableCreated == true) {
            $('#reporte').DataTable().clear();
            $('#reporte').DataTable().destroy();
            $("#reporte").append('<tr><td colspan="4" class="text-center">No hay datos disponibles en la tabla.</td></tr>');
            isTableCreated = false
        }
    });

    $(document).ajaxStop(function () { });

    $('#cmbFolio').prop('disabled', true);
    $('#cmbInstitucion').on('change', function () {
        var id = $(this).val()
        var cmbInstitucion = $.ajax({
            method: "POST",
            url: "?accion=institucionAdministrador&pag=getFolioByInst",
            data: { idInstitucion: id }
        })

        cmbInstitucion.done(function (res) {
            var option = ''
            $('#cmbFolio').empty()
            var data = JSON.parse(res);
            option += '<option value="" selected>Selecciona un folio</option>';
            data.forEach(element => {
                var opc = new Object();
                opc.id_folio = element.id_folio;
                var myString = JSON.stringify(opc);
                option += '<option value=' + myString + '>' + element.id_folio + '</option>';
            });
            $('#cmbFolio').append(option);
            $('#cmbFolio').prop('disabled', false);
        });

        cmbInstitucion.fail(function () {
            alert("error")
        })
    });

    $("#cmbFolio").change(function () {
        var cmbFolio = $(this).val()
        var data = JSON.parse(cmbFolio)
        var folio = data.id_folio
        datatable_by_folio(folio)
        isTableCreated = true
    });
});

function datatable_by_folio(folio) {
    var result = $.ajax({
        method: "POST",
        url: "?accion=resultados&pag=getPerfiles",
        data: { folio: folio }
    })

    result.done(function (res) {
        var dataPerfiles = JSON.parse(res)
        console.log(dataPerfiles)
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
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                'csv', 'pdf', 'print'
            ],
            "data": dataPerfiles,
            "columns": [
                {
                    "data": 'nombre'
                },
                {
                    "data": 'grado_estudios'
                },
                {
                    "data": 'area'
                },
                {
                    "data": 'turno'
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[0]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[1]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[2]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[3]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[4]['resultado'] 
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[5]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[6]['resultado']    
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[7]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[8]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[9]['resultado']
                    }
                },
                {
                    "data": 'personalidad_1', "render": function (data, type, row) {
                        return row.personalidad_1[10]['resultado']
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        return p1.smpuno
                    }
                },
                {
                    "data": 'personalidad_2', "render": function (data, type, row) {
                        return row.personalidad_2[0]['resultado']
                    }
                },
                {
                    "data": 'personalidad_2', "render": function (data, type, row) {
                        return row.personalidad_2[1]['resultado']
                    }
                },
                {
                    "data": 'personalidad_2', "render": function (data, type, row) {
                        return row.personalidad_2[2]['resultado']
                    }
                },
                {
                    "data": 'personalidad_2', "render": function (data, type, row) {
                        return row.personalidad_2[3]['resultado']
                    }
                },
                {
                    "data": 'personalidad_2', "render": function (data, type, row) {
                        return row.personalidad_2[4]['resultado']
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        return p1.smpdos
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        return row.ci_terman
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        return row.ci_raven
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        return p1.ci
                    }
                },
                {
                    "data": 'perfil', "render": function (data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        return p1.final
                    }
                }
            ],
            columnDefs: [
                { className: 'text-center', targets: [4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25] }
            ],
            order: []
        });
    });

    result.fail(function () {
        alert("error")
    })

}