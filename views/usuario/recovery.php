<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?php
            @$m = AccesoDatos::desencriptar($_GET['m']);
            if (isset($m)) {
                switch ($m) {
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
                    case '3':
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>¡AVISO!</strong>&nbsp;Tu cuenta de acceso esta inactiva por favor comunicate con tu Administrador empresarial.
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
    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="row d-flex justify-content-center">
            <div class="shadow-lg p-3 bg-login-header rounded-login-header pt-4">
                <div class="logo">
                    <center>RECUPERAR DATOS DE ACCESO</center>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="showLogin">
                <div class="shadow-lg p-3 bg-login rounded-login">
                    <form name="form" action="" method="post">
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-sm-12">
                                <!-- <label>Usuario</label> -->
                                <input type="text" name="txtUsuario" id="txtUsuario" placeholder="Ingresa tu usuario" class="form-control form-control-lg" required="true" />
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-sm-12">
                                <!-- <label>E-mail con el que te registraste inicialmente</label> -->
                                <input type="email" name="txtEmail" id="txtEmail" placeholder="Ingresa tu e-mail" class="form-control form-control-lg" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true" />
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-sm-12">
                                <!-- <label>Confirmar e-mail:</label> -->
                                <input type="email" name="txtConfirmEmail" id="txtConfirmEmail" placeholder="Confirma nuevamente tu e-mail" class="form-control form-control-lg" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true" />
                            </div>
                        </div>
                        <!-- <div class="dropdown-divider pt-3"></div> -->
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-sm-12 text-center">
                                <input type="hidden" name="validUsuario" value="update" />
                                <input type="submit" name="recuperar" id="recuperar" class="btn btn-outline-green btn-lg btn-block" value="Recuperar contraseña">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="shadow-lg p-3 mb-5 bg-login-footer rounded-login-footer">
                <div class="logo">
                    <center><img src="<?php echo AccesoDatos::ruta(); ?>assets/img/logo.png" alt="Prepa en Línea SEP" width=200px"></center>
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
                $(".logo").show(1000);
                $(".logo").animate({
                    opacity: 0.25
                }, 1000);
                document.form.reset();
                document.form.txtUsuario.focus();
            });

            $("#recuperar").prop("disabled", true);
            $("#txtConfirmEmail").prop("disabled", true);
            $("#txtEmail").blur(function() {
                if ($(this).val().indexOf('@', 0) == -1 || $(this).val().indexOf('.', 0) == -1) {
                    $("#txtConfirmEmail").prop("disabled", true);
                    return false;
                } else {
                    $("#txtConfirmEmail").prop("disabled", false);
                }
            });
            $("#txtConfirmEmail").blur(function() {
                if ($("#txtEmail").val() == $(this).val()) {
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