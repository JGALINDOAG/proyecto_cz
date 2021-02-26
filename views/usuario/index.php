<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body onload="document.form.login.focus();">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <h5 class="mt-0">ACCESO EXCLUSIVO</h5>
                        <p>Para iniciar sesión es necesario que cuentes con un usuario y
                            contraseña.</p>
                        <p class="mb-0"><small class="text-muted">¡Te damos la bienvenida!</small></p>
                    </div>
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
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <?php
                    // echo AccesoDatos::encriptar("12345678");
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Los datos están vacíos
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '2':
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Los datos ingresados no existen en nuestros registros
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '3':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Usted ha cerrado su sesión exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '4':
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Cuenta Inactiva, se te recomienda acudir con tu administrador para tu reactivación
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
            <div class="dropdown-divider"></div>
            <div class="form-group row text-center d-flex justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <a type="button" class="btn btn-light btn-sm btn-block" href="<?php echo AccesoDatos::ruta(); ?>?accion=recovery">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
</body>

</html>