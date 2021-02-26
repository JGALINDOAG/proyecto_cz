<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body onload="document.form1.reset();document.form1.txtLada.focus();">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <fieldset disabled>
                <div class="alert alert-light" role="alert">
                    DATOS PERSONALES
                    <hr>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label class="col-form-label">Nombre</label>
                        <input type="text" name="txtNombre" placeholder="Ingresa un nombre" class="form-control"
                            onchange="conMayusculas(this);" onkeypress="return soloLetras(event);"
                            value="<?php echo $rowPersonaSession[0]["nombre"]; ?>" required="" />
                    </div>
                    <div class="col-12 ">
                        <label class="col-form-label">Apellido Paterno</label>
                        <input type="text" name="txtPaterno" placeholder="Apellido paterno" class="form-control"
                            onChange="conMayusculas(this)" onkeypress="return soloLetras(event);"
                            value="<?php echo $rowPersonaSession[0]["ap_paterno"]; ?>" required="" />
                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label">Apellido Materno</label>
                        <input type="text" name="txtMaterno" placeholder="Apellido materno" class="form-control"
                            onChange="conMayusculas(this)" onkeypress="return soloLetras(event);"
                            value="<?php echo $rowPersonaSession[0]["ap_materno"]; ?>" />
                    </div>
                </div>
            </fieldset>
            <form name="form1" action="" method="post">
                <div class="form-group row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-2">
                        <label>Lada</label>
                        <input type="text" name="txtLada" maxlength="5" placeholder="Lada"
                            onkeypress="return soloNumeros(this);" value="<?php echo $lada; ?>"
                            class="form-control">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-3">
                        <label>Número telefonico</label>
                        <input type="text" name="txtTelefono" maxlength="8" placeholder="Número telefonico"
                            onkeypress="return soloNumeros(this);" value="<?php echo $telefono; ?>"
                            class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-7">
                        <label>E-mail</label>
                        <input type="email" name="txtEmail" placeholder="e-mail" class="form-control"
                            value="<?php echo $rowPersonaSession[0]["email"]; ?>" />
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <input type="hidden" name="validUsuario" value="update" />
                        <input type="submit" value="Actualizar datos"
                            class="btn btn-outline-paleVioletRed btn-lg btn-block">
                    </div>
                </div>
            </form>
            <div class="form-group row d-flex justify-content-center">
                <div class="col-sm-12">
                    <?php
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>Los datos personales han sido actualizados exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                            case '2':
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>El email ya esta siendo usado por otro usuario, por favor elija otro
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