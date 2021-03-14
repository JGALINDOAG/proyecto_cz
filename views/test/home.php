<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
            <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <h5 class="mt-0">TITULO</h5>
                        <p>Instrucción.</p>
                    </div>
                </div>
            </div>

            <form name="form" action="" method="post">
                <input type="hidden" name="personal" value="ok">
                <div class="form-group">
                    <label>Folio</label>
                    <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingrese el folio compartido por la institución" required>
                    <div id="info"></div>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" name="nom" placeholder="Ingrese su nombre" required>
                </div>
                <div class="form-group">
                    <label>Primer apellido</label>
                    <input class="form-control" type="text" name="ap1" placeholder="Ingrese su primer apellido" required>
                </div>
                <div class="form-group">
                    <label>Segundo apellido</label>
                    <input class="form-control" type="text" name="ap2" placeholder="Ingrese su segundo apellido">
                </div>
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input class="form-control" type="email" name="email" placeholder="Ingrese su email" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="H" required>
                    <label class="form-check-label">Hombre</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" value="M" required>
                    <label class="form-check-label">Mujer</label>
                </div>
                <br>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input class="form-control" type="date" name="fecha_nacimiento" required>
                </div>                
                <div class="form-group">
                <label>Grados de estudios</label>
                <select class="form-control" name="grado_estudios" required>
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
                <div class="alert alert-secondary" role="alert">Si usted pertenece a la institución, favor de marcar la casilla y llenar la información solicitada.</div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Si, pertenezco a la institución.</label>
                </div>

                <br>
                <div id="divsub" style="display:none;">
                    <div class="form-group">
                        <label>Área</label>
                        <input class="form-control" type="text" name="area" id="area" placeholder="Ingrese el área al cual pertenece">
                    </div>
                    <label>Turno</label>
                    <select class="form-control" name="turno" id="turno">
                    <option value="">seleccione una opción</option>
                        <option value="matutino">Matutino</option>
                        <option value="vespertino">Vespertino</option>
                        <option value="nocturno">Nocturno</option>
                    </select>
                </div>
                <br>
                <br>

                <input type="submit" class="btn btn-outline-green btn-lg btn-block" value="Continuar">
            </form>
        <!-- -->
        </div>
    </section>
    <?php require_once 'views/layout/footer.php'; ?>
    <script>
    $(document).ready(function(){
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
    });
    </script>
</body>
</html>