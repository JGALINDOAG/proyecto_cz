<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="form-group row d-flex justify-content-center pt-4">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center text-muted">
                        RECUPERAR DATOS DE ACCESO
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <div id="result"></div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <?php
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;La cuenta de correo o el usuario no existe en nuestros registros.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '2':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;Se envio un mensaje a tu cuenta de correos con tus datos de acceso.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                        }
                    } 
                    ?>
                </div>
            </div>
            <div id="showLogin">
                <form name="form" action="" method="post">
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <label>Usuario</label>
                        <input type="text" name="txtUsuario" id="txtUsuario" placeholder="Ingresa tu usuario"
                            class="form-control" required="true" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <label>E-mail con el que te registraste inicialmente</label>
                        <input type="email" name="txtEmail" id="txtEmail" placeholder="Ingresa tu e-mail"
                            class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <label>Confirmar e-mail:</label>
                        <input type="email" name="txtConfirmEmail" id="txtConfirmEmail"
                            placeholder="Confirma nuevamente tu e-mail" class="form-control"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6 text-center">
                        <input type="hidden" name="validUsuario" value="update" />
                        <input type="submit" name="recuperar" id="recuperar"
                            class="btn btn-outline-green btn-lg btn-block" value="Recuperar contraseña">
                    </div>
                </div>
                </form>
            </div>
            <div class="dropdown-divider"></div>
            <div class="form-group row d-flex text-center justify-content-center">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <div id="logo"><img src="<?php echo AccesoDatos::ruta(); ?>assets/img/logo.png" width="250px"></div>
                        <div class="dropdown-divider"></div>
                         <p class="mb-0"><small class="text-muted">Cruzeac, Inteligencia y Excelencia | Cruzeac Consultores S. A. de C. V.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script>
    $(document).ready(function() {
        $("#showLogin").hide();
        $("#showLogin").animate({
            height: "toggle"
        }, 1000, function() {
            // Animation complete.
            $("#logo").show(1000);
            $("#logo").animate({ opacity: 0.25 }, 1000);
            document.form.reset();
            document.form.txtUsuario.focus();
        });

        $("#recuperar").prop("disabled", true);
        $("#txtConfirmEmail").prop( "disabled", true);
        $("#txtEmail").blur(function() {
            if($(this).val().indexOf('@', 0) == -1 || $(this).val().indexOf('.', 0) == -1) {
                $("#txtConfirmEmail").prop( "disabled", true);
                return false;
            } else {
                $("#txtConfirmEmail").prop( "disabled", false);
            }
        });
        $("#txtConfirmEmail").blur(function() {
            if($("#txtEmail").val() == $(this).val()) {
                $("#result").html('');
                $("#recuperar").prop("disabled", false);
            } else {
                $("#result").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>¡AVISO!</strong>&nbsp;Los correos no son identicos <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            }
        });
    });
    </script>
</body>

</html>