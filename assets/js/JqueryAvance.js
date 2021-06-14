$(document).ready(function () {
    $("#cmbFolio").change(function () {
        $("#table").empty();
        $("#descript").empty();
        var folio = $(this).val()
        $.post("?accion=resultados&pag=getListPruebas", { folio: folio })
            .done(function (data) {
                var dataList = JSON.parse(data)
                console.log(dataList)

                var tableDescript = ''
                tableDescript += '<table class="table table-hover" style="width:100%"><tbody>';
                var band = 0
                var tra = '<tr>'
                var trc = '</tr>'

                var table = ''
                table += '<table class="table table-hover" id="listPersonas" style="width:100%"><thead><tr><th scope="col">Nombre</th>';

                dataList.forEach(element => {
                    if(band == 0) {
                        tableDescript += tra
                        tableDescript += '<th>'+ element.id_prueba +'</th>'+
                        '<td>'+ element.prueba +'</td>';
                        band += 1 
                        console.log(band)
                    } else if (band > 0 && band < 3){
                        tableDescript += '<th>'+ element.id_prueba +'</th>'+
                        '<td>'+ element.prueba +'</td>';
                        band += 1
                        console.log(band)
                    } else {
                        tableDescript += '<th>'+ element.id_prueba +'</th>'+
                        '<td>'+ element.prueba +'</td>';
                        tableDescript += trc
                        band = 0
                        console.log(band)
                    } 

                    table += '<th scope="col">'+ element.id_prueba +'</th>';

                });
                tableDescript +='</tbody></table>';
                table +='</tr></thead></table>';
                $("#table").append(table);
                $("#descript").append(tableDescript);
            });
            dataTable(folio)
    });
});
function dataTable(folio) {
    var cmbFolio = $.ajax({
        method: "POST",
        url: "?accion=resultados&pag=getAvanceList",
        data: { folio: folio }
    })

    cmbFolio.done(function (res) {
        var dataList = JSON.parse(res)
        // console.log(dataList)
        $('#listPersonas').DataTable({
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
                    "data": 'nombre'
                },
                {
                    "data": 'ter', 'render': function (data, type, row) {
                        if (row.ter == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'per1', 'render': function (data, type, row) {
                        if (row.per1 == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'per2', 'render': function (data, type, row) {
                        if (row.per2 == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'rav', 'render': function (data, type, row) {
                        if (row.rav == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'inte', 'render': function (data, type, row) {
                        if (row.inte == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'apt', 'render': function (data, type, row) {
                        if (row.apt == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'atr', 'render': function (data, type, row) {
                        if (row.atr == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'clo', 'render': function (data, type, row) {
                        if (row.clo == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'tco', 'render': function (data, type, row) {
                        if (row.tco == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'cpec', 'render': function (data, type, row) {
                        if (row.cpec == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'nde', 'render': function (data, type, row) {
                        if (row.nde == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'mmpi', 'render': function (data, type, row) {
                        if (row.mmpi == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'km', 'render': function (data, type, row) {
                        if (row.km == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                },
                {
                    "data": 'gdr', 'render': function (data, type, row) {
                        if (row.gdr == 1) {
                            var value = '<img src="assets/img/check.svg" title="Descargar" width="27px"></img>';
                        } else {
                            var value = '<img src="assets/img/process.svg" title="Descargar" width="30px"></img>';
                        }
                        return value;
                    }
                }
            ],
            columnDefs: [
                { "orderable": false, "targets": [1,2,3,4,5,6,7,8,9,10,11,12,13,14] },
                { className: 'text-center', targets: [1,2,3,4,5,6,7,8,9,10,11,12,13,14] },
            ]
        });
    });

    cmbFolio.fail(function () {
        alert("error")
    })
}
