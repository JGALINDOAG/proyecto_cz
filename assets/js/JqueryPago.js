$(document).ready( function () {
    $("#hidenCarga").prop( "disabled", true );
    $("#cmbFormaPago").change(function () {
        if($(this).val() > 1) {
            $("#hidenCarga").prop("disabled", false);
            $("#hidenCarga").prop('required', true);
        }
        else {
            $("#hidenCarga").prop("disabled", true);
            $("#hidenCarga").prop('required', false);
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