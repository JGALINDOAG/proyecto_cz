$(document).ready(function() {
    var isTableCreated = false;

    $(document).ajaxStart(function() {
        if (isTableCreated == true) {
            $('#reporte').DataTable().clear();
            $('#reporte').DataTable().destroy();
            $("#reporte").append('<tr><td colspan="4" class="text-center">No hay datos disponibles en la tabla.</td></tr>');
            isTableCreated = false
        }
    });

    $(document).ajaxStop(function() {});

    $('#cmbFolio').prop('disabled', true);
    $('#cmbInstitucion').on('change', function() {
        var id = $(this).val()
        var cmbInstitucion = $.ajax({
            method: "POST",
            url: "?accion=institucionAdministrador&pag=getFolioByInst",
            data: { idInstitucion: id }
        })

        cmbInstitucion.done(function(res) {
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

        cmbInstitucion.fail(function() {
            alert("error")
        })
    });

    $("#cmbFolio").change(function() {
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

    result.done(function(res) {
        var dataPerfiles = JSON.parse(res)
        var shetName_excel = $('select[name="cmbFolio"] option:selected').text()
        let date = new Date()
            // console.log(dataPerfiles)

        function isKeyExists(obj, key) {
            return key in obj;
        }

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
            buttons: [{
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                extend: 'excelHtml5',
                title: shetName_excel + '_' + date.getDate() + '_' + (date.getMonth() + 1) + '_' + date.getFullYear(),
                sheetName: shetName_excel,
                autoFilter: true,
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    // Loop over the cells in column `E`
                    $('row c[r^="E"]', sheet).each(function() {
                        // Get the value
                        // if ($('is t', this).text() < 10) {
                        //     $(this).attr( 's', '10' );
                        // } else if ( $('is t', this).text() >= 54 && $('is t', this).text() <= 87 ) {
                        //     $(this).attr( 's', '20' );     
                        // } else if ( $('is t', this).text() >= 89 && $('is t', this).text() <= 110 ) {
                        //     $(this).attr( 's', '15' );     
                        // }
                        if ($(this).text() == 1) {
                            $(this).attr('s', '15');
                        } else if ($(this).text() == 2) {
                            $(this).attr('s', '20');
                        } else if ($(this).text() == 3) {
                            $(this).attr('s', '10');
                        }
                    });
                    // Loop over the cells in column `C`
                    $('row c[r^="Q"]', sheet).each(function() {
                        // Get the value
                        if ($(this).text() == 1) {
                            $(this).attr('s', '15');
                        } else if ($(this).text() == 2) {
                            $(this).attr('s', '20');
                        } else if ($(this).text() == 3) {
                            $(this).attr('s', '10');
                        }
                    });
                    // Loop over the cells in column `W`
                    $('row c[r^="W"]', sheet).each(function() {
                        // Get the value
                        if ($(this).text() == 1) {
                            $(this).attr('s', '15');
                        } else if ($(this).text() == 2) {
                            $(this).attr('s', '20');
                        } else if ($(this).text() == 3) {
                            $(this).attr('s', '10');
                        }
                    });
                    // Loop over the cells in column `Z`
                    $('row c[r^="Z"]', sheet).each(function() {
                        // Get the value
                        if ($(this).text() == 1) {
                            $(this).attr('s', '15');
                        } else if ($(this).text() == 2) {
                            $(this).attr('s', '20');
                        } else if ($(this).text() == 3) {
                            $(this).attr('s', '10');
                        }
                    });
                }
            }],
            "data": dataPerfiles,
            "columns": [{
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
                    "data": 'perfil',
                    "render": function(data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        if (isKeyExists(p1, "ci")) return p1.ci
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[0]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[1]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[2]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[3]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[4]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[5]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[6]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[7]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[8]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[9]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_1',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_1") && row.personalidad_1.length == 11) return row.personalidad_1[10]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'perfil',
                    "render": function(data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        if (isKeyExists(p1, "smpuno")) return p1.smpuno
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_2',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_2") && row.personalidad_2.length == 5) return row.personalidad_2[0]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_2',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_2") && row.personalidad_2.length == 5) return row.personalidad_2[1]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_2',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_2") && row.personalidad_2.length == 5) return row.personalidad_2[2]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_2',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_2") && row.personalidad_2.length == 5) return row.personalidad_2[3]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'personalidad_2',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "personalidad_2") && row.personalidad_2.length == 5) return row.personalidad_2[4]['resultado']
                        else return '--'
                    }
                },
                {
                    "data": 'perfil',
                    "render": function(data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        if (isKeyExists(p1, "smpdos")) return p1.smpdos
                        else return '--'
                    }
                },
                {
                    "data": 'ci_terman',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "ci_terman")) return row.ci_terman
                        else return '--'
                    }
                },
                {
                    "data": 'ci_raven',
                    "render": function(data, type, row) {
                        if (isKeyExists(row, "ci_raven")) return row.ci_raven
                        else return '--'
                    }
                },
                {
                    "data": 'perfil',
                    "render": function(data, type, row) {
                        var p1 = JSON.parse(row.perfil)
                        if (isKeyExists(p1, "final")) return p1.final
                        else return '--'
                    }
                }
            ],
            columnDefs: [
                { orderable: false, targets: [0, 1, 2, 3] },
                { className: 'text-center', targets: [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25] }
            ],
            order: []
        });
    });

    result.fail(function() {
        alert("error")
    })

}