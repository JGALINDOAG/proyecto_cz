<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body style="width: 100%;
    height: 100vh;
    background: linear-gradient(to bottom, rgba(0, 0, 0, .9), transparent), url(assets/img/images/hero2.jpeg) bottom no-repeat;
    background-size: cover;
    display: flex;
    flex-direction: column;
    position: relative;">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>
    <div class="row">
        <div class="col-sm-12">
            <?php
            // echo AccesoDatos::encriptar("12345678");
            @$m = AccesoDatos::desencriptar($_GET['m']);
            if (isset($m)) {
                switch ($m) {
                    case '1':
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡AVISO!</strong>&nbsp;Los datos están vacíos
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                        break;
                    case '2':
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>¡AVISO!</strong>&nbsp;Los datos ingresados son incorrectos
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                        break;
                    case '3':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>¡AVISO!</strong>&nbsp;Usted ha cerrado su sesión exitosamente
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>';
                        break;
                    case '4':
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>¡AVISO!</strong>&nbsp;Cuenta Inactiva, se te recomienda acudir con tu administrador para tu reactivación
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
                    <center>ACCESO EXCLUSIVO</center>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="showLogin">
                <div class="shadow-lg p-3 bg-login rounded-login">
                    <form name="form" action="" method="post" class="pt-3">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <!-- <label>Usuario</label> -->
                                <input type="text" name="login" class="form-control form-control-lg" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <!-- <label>Contraseña</label> -->
                                <input type="password" name="pass" class="form-control form-control-lg" placeholder="Contraseña" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="hidden" name="grabar" value="si">
                                <input type="button" value="Acceder" title="Acceder" class="btn btn-outline-green btn-lg btn-block" onclick="document.form.submit();">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <!-- <div class="form-group row text-center"> -->
                    <div class="text-center">
                        <a href="<?php echo AccesoDatos::ruta(); ?>?accion=recovery"><small class="font-weight-bold text-green">¿Olvidaste tu contraseña?</small></a>
                    </div>
                    <!-- </div> -->
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
                document.form.login.focus();
            });
            $('.toast').toast('show')
        });
    </script>

</body>

</html>