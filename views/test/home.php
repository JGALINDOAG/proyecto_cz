<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>

<body style="width: 100%;
    background: linear-gradient(to bottom, rgba(0, 0, 0, .9), transparent), url(assets/img/images/between_4.jpeg) bottom no-repeat;
    background-size: cover;
    display: flex;
    flex-direction: column;
    position: relative;">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <!-- -->
            <div class="container pt-4">
                <div class="card">
                    <h5 class="card-header text-center">REALIZA TU REGISTRO</h5>
                    <div class="card-body">
                        <p class="card-text">Como primer paso es necesario realizar el registro inicial, para ello registre cada uno de los datos solicitados y de clic en "Continuar".</p>
                        <p class="card-text">Una vez que finalice el registro, será necesario esperar a la activación las pruebas y actualizar la pagina, de lo contrarios podrá intentarlo mas tarde tan solo registrando el folio y la cuenta de correo electrónico.</p>
                    </div>
                </div>
            </div>
            <div class="container pt-4">
                <form name="form" action="" method="post">
                    <div class="form-group">
                        <label>Folio</label>
                        <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingrese el folio compartido por la institución" required>
                        <div id="info"></div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label>¿Se ha registrado anteriormente con el mismo folio?</label>
                        <select class="form-control" id="pregunta" name="pregunta" required>
                            <option value="">seleccione una opción</option>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label>Correo electrónico</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Ingrese su email" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="nom" name="nom" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group">
                        <label>Primer apellido</label>
                        <input class="form-control" type="text" id="ap1" name="ap1" placeholder="Ingrese su primer apellido">
                    </div>
                    <div class="form-group">
                        <label>Segundo apellido</label>
                        <input class="form-control" type="text" id="ap2" name="ap2" placeholder="Ingrese su segundo apellido">
                    </div>
                    <div class="form-group">
                        <label>Seleccione su sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="">seleccione una opción</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de nacimiento</label>
                        <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento">
                    </div>
                    <div class="form-group">
                        <label>Grados de estudios</label>
                        <select class="form-control" id="grado_estudios" name="grado_estudios">
                            <option value="">seleccione una opción</option>
                            <option value="ninguno">Ninguno</option>
                            <option value="preescolar">Preescolar</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="bachillerato">Bachillerato</option>
                            <option value="licenciatura">Licenciatura</option>
                            <option value="posgrados">Posgrados</option>
                        </select>
                    </div>
                    <!--
                    <div class="alert alert-secondary" role="alert">Si usted pertenece a la institución, favor de marcar la casilla y llenar la información solicitada.</div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Si, pertenezco a la institución.</label>
                    </div>
                    <br>
-->
                    <!--
                    <div class="form-group">
                    <label>Actividad que ejerce en la institución:</label>
                    <select class="form-control" id="grado_estudios" name="grado_estudios">
                        <option value="">seleccione una opción</option>
                        <option value="laboral">Laboral / Otros</option>
                        <option value="educacion">Educación</option>
                    </select>
                    </div>
-->
                    <div class="form-group">
                        <label>Área ó Grupo</label>
                        <input class="form-control" type="text" name="area" id="area" placeholder="Ingrese el área al cual pertenece">
                    </div>
                    <label>Turno</label>
                    <select class="form-control" name="turno" id="turno">
                        <option value="">seleccione una opción</option>
                        <option value="matutino">Matutino</option>
                        <option value="vespertino">Vespertino</option>
                        <option value="nocturno">Nocturno</option>
                    </select>
                    <br><br>
                    <input type="submit" class="btn btn-outline-green btn-lg btn-block" value="Continuar">
                </form>
            </div>
            <!-- -->
        </div>
    </section>
    <?php require_once 'views/layout/footer.php'; ?>
    <script>
        $(document).ready(function() {

            $("#folio").change(function() {
                var folio = $("#folio").val();
                $.ajax({
                    url: "index.php?accion=VerificaFolio",
                    type: "POST",
                    data: {
                        folio: folio
                    },
                    cache: false,
                    success: function(data) {
                        $('#info').empty();
                        //console.log(data);
                        $("#info").append(data);
                    }
                });
            });

            $("#pregunta").change(function() {
                var pregunta = $("#pregunta").val();
                //no
                if (pregunta == 0) {
                    $("#nom").attr({
                        required: "true"
                    });
                    $("#ap1").attr({
                        required: "true"
                    });
                    $("#sexo").attr({
                        required: "true"
                    });
                    $("#fecha_nacimiento").attr({
                        required: "true"
                    });
                    $("#grado_estudios").attr({
                        required: "true"
                    });
                    $("#nom").removeAttr("disabled");
                    $("#ap1").removeAttr("disabled");
                    $("#sexo").removeAttr("disabled");
                    $("#fecha_nacimiento").removeAttr("disabled");
                    $("#grado_estudios").removeAttr("disabled");
                    $("#ap2").removeAttr("disabled");
                    $("#area").removeAttr("disabled");
                    $("#turno").removeAttr("disabled");
                } else {
                    $("#nom").removeAttr("required");
                    $("#ap1").removeAttr("required");
                    $("#sexo").removeAttr("required");
                    $("#fecha_nacimiento").removeAttr("required");
                    $("#grado_estudios").removeAttr("required");
                    $("#nom").attr({
                        disabled: "true"
                    });
                    $("#ap1").attr({
                        disabled: "true"
                    });
                    $("#sexo").attr({
                        disabled: "true"
                    });
                    $("#fecha_nacimiento").attr({
                        disabled: "true"
                    });
                    $("#grado_estudios").attr({
                        disabled: "true"
                    });
                    $("#ap2").attr({
                        disabled: "true"
                    });
                    $("#area").attr({
                        disabled: "true"
                    });
                    $("#turno").attr({
                        disabled: "true"
                    });
                }
            });
            /*
                $("#exampleCheck1").click(function(){
                    if($('#exampleCheck1').is(':checked')){
                        $("#divsub").css("display", "block");
                        $("#area").attr("required", "true");
                        $("#turno").attr("required", "true");
                    }else{
                        $("#divsub").css("display", "none");
                        $("#area").removeAttr("required");
                        $("#area").val("");
                        $("#turno").removeAttr("required");
                        $("#turno").val("");
                    }
                });
                */
        });
    </script>
</body>

</html>