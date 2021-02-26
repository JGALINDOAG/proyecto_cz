<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body onload="document.form.reset();document.form.txtEmail.focus();">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <form name="form" action="" method="post">
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-10 text-center">
                        <div class="alert alert-light" role="alert">
                            RECUPERAR DATOS DE ACCESO
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center pt-3">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <label>E-mail con el que te registraste inicialmente</label>
                        <input type="text" name="txtEmail" id="txtEmail" placeholder="Ingresa tu e-mail"
                            class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true"
                            onblur="validarEmail(this.form.txtEmail.value, this.form.txtConfirmEmail.value);" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6">
                        <label>Confirmar e-mail:</label>
                        <input type="text" name="txtConfirmEmail" id="txtConfirmEmail"
                            placeholder="Confirma nuevamente tu e-mail" class="form-control"
                            onkeyup="validarEmail(this.form.txtEmail.value, this.form.txtConfirmEmail.value);"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-6 text-center">
                        <input type="hidden" name="validUsuario" value="update" />
                        <input type="submit" name="recuperar" id="recuperar"
                            class="btn btn-outline-paleVioletRed btn-lg btn-block" value="Recuperar contraseña"
                            disabled>
                    </div>
                </div>
            </form>
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <div id="result"></div>
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12 col-md-9 col-lg-6">
                    <?php
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>La cuenta de correo no existe en nuestra base de datos o no cuenta con los privilegios de administrador.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '2':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Se envio un mensaje a tu cuenta de correos con tus datos de acceso.
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
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
</body>

</html>