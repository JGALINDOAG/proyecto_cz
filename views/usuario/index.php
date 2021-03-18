<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="form-group row d-flex justify-content-center pt-4">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <div class="card">
                        <div class="card-body text-center text-muted">
                        ACCESO EXCLUSIVO
                        </div>
                    </div>
                </div>
            </div>
            <div id="showLogin">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <?php
                        // echo AccesoDatos::encriptar("12345678");
                        @$m=str_replace(' ','+',$_GET['m']);
                        @$m=AccesoDatos::desencriptar($m);
                        if(isset($m)){
                            switch ($m){
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
                <form name="form" action="" method="post">
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-12 col-md-9 col-lg-6">
                            <input type="text" name="login" class="form-control" placeholder="Usuario">
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-12 col-md-9 col-lg-6">
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row text-justify d-flex justify-content-center">
                        <div class="col-sm-12 col-md-9 col-lg-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Recordar mi contraseña
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-sm-12 col-md-9 col-lg-6">
                            <input type="hidden" name="grabar" value="si">
                            <input type="button" value="Acceder" title="Acceder"
                                class="btn btn-outline-green btn-lg btn-block" onclick="document.form.submit();">
                        </div>
                    </div>
                </form>
                <div class="form-group row text-center d-flex justify-content-center">
                    <div class="col-sm-12 col-md-6">
                        <a type="button" class="btn btn-light btn-sm btn-block" href="<?php echo AccesoDatos::ruta(); ?>?accion=recovery">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
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
            document.form.login.focus();
        });
        $('.toast').toast('show')
    });
    </script>
    
</body>

</html>