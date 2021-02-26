<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body onload="document.form1.reset();document.form1.txtContrasena.focus();">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <form name="form1" action="" method="post">
                <div class="alert alert-light" role="alert">
                    ACTUALIZAR DATOS DE ACCESO
                    <hr>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12">
                        <label>Carné de identidad:</label>
                        <label><?php echo $rowUsuario[0]["nombre"]; ?></label>
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12">
                        <label>Usuario</label>
                        <input type="text" name="txtUsuario" class="form-control"
                            value="<?php echo $rowUsuario[0]["usuario"]; ?>" readonly />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12">
                        <label>Contraseña:</label>
                        <input type="password" name="txtContrasena" minlength="4" maxlength="16"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 caracteres o más"
                            placeholder="Ingresa tu nueva contraseña" class="form-control"
                            onblur="validarPassword(this.form.txtContrasena.value, this.form.txtConfirmEmail.value);"
                            autocomplete="off"
                            required />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12">
                        <label>Confirmar contraseña:</label>
                        <input type="password" name="txtConfirmEmail" minlength="4" maxlength="16"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 caracteres o más"
                            placeholder="Confirma tu nueva contraseña" class="form-control"
                            onkeyup="validarPassword(this.form.txtContrasena.value, this.form.txtConfirmEmail.value);"
                            autocomplete="off"
                            required />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <input type="hidden" name="validUsuario" value="updateUsuario" />
                        <input type="submit" name="Guardar" id="actualizar" class="btn btn-outline-paleVioletRed btn-lg btn-block"
                            value="Actualizar contraseña" disabled />
                    </div>
                </div>
            </form>
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12">
                    <div id="result"></div>
                </div>
            </div>
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12">
                    <?php
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>La contraseña ha sido actualizada exitosamente.
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