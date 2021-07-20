<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="form-group row d-flex justify-content-center">
            <div class="col-sm-12">
                <?php
                @$m = str_replace(' ', '+', $_GET['m']);
                @$m = AccesoDatos::desencriptar($m);
                if (isset($m)) {
                    switch ($m) {
                        case '1':
                            $text = 'Estimado Sr (a). '.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['n'])).'%0A
                                ¡Te damos la bienvenida al Sistema CHROME!%0A
                                Ahora ya puedes comenzar a administrar tu cuenta e interactuar con la Plataforma.%0A
                                No olvides tus credenciales generadas para ingresar al sistema, son las siguientes:%0A
                                USUARIO:&nbsp;'.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['u'])).'%0A
                                CONTRASEÑA:&nbsp;'.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['p'])).'%0A
                                Una vez ingresando al sistema podrás cambiar tu contrase&ntilde;a si así lo deseas';

                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>La Institución a sido agregado exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    &nbsp;|&nbsp;<a href="https://api.whatsapp.com/send?phone='.$_GET['t'].'&text='.$text.'" target="_blank">Enviar datos de sesi&oacute;n por WhatSapp</a>
                                    </div>';
                            break;
                    }
                }
                if (isset($_POST["errno"])) {
                    foreach ($_POST["errno"] as $errno) :
                        switch ($errno) {
                            case 1:
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>¡AVISO!</strong>&nbsp;La Institución ya existe en los registros.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                break;
                            case 2:
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>¡AVISO!</strong>&nbsp;El Administrador ya existe en los registros.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                break;
                        }
                    endforeach;
                }
                ?>
            </div>
        </div>
        <form name="form" method="post" class="needs-validation" novalidate>
            <div class="shadow p-3 mb-5 bg-white rounded pt-4">
                <div class="alert alert-light" role="alert">
                    <div class="d-flex align-items-center">DATOS DE LA INSTITUCIÓN</div>
                    <hr>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Nombre de la Institución</label>
                        <input type="text" name="txtNombreInst" placeholder="Nombre" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtNombreInst"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el nombre de la Institución.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Abreviatura</label>
                        <input type="text" name="txtAbreviatura" placeholder="Abreviatura de la Institución" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtAbreviatura"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba la abreviatura de la Institución.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-lg-3">
                        <label>RFC</label>
                        <input type="text" name="txtRFC" placeholder="RFC" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtRFC"]; ?>" pattern="[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]" required>
                        <div class="invalid-feedback">
                            Por favor escriba el RFC.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-lg-4">
                        <label>Email</label>
                        <input type="email" name="txtEmail" placeholder="Email" value="<?php echo @$_POST["txtEmail"]; ?>" class="form-control">
                    </div>
                    <div class="form-group col-sm-12 col-lg-5">
                        <label>Número telefonico</label>
                        <input type="text" name="txtTelefono" maxlength="10" placeholder="Número telefonico: 5537126509" onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtTelefono"]; ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor escriba el # de telefóno.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Selección de pruebas a vender</label>
                        <select class="selectpicker form-control" name="cmbPrueba[]" multiple data-actions-box="true" data-selected-text-format="count > 6" required>
                            <?php foreach ($rowPruebas as $item) : ?>
                                <option value="<?php echo $item['id_prueba']; ?>" >
                                    <?php echo $item['prueba']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="alert alert-light" role="alert">
                    <div class="d-flex justify-content-end align-items-center ">
                        <input type="hidden" name="errno[]">
                        <input type="hidden" name="validUsuario" value="save">
                        <?php echo '<button type="submit" class="btn-link"><img src="assets/img/next.svg" width="35" height="35" class="d-inline-block align-top" title="Siguiente"></button>'; ?>
                        &nbsp;|&nbsp;SIGUIENTE
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <style>
        .btn-link {
            border: none;
            outline: none;
            background: none;
            cursor: pointer;
            color: #0000EE;
            padding: 0;
            text-decoration: underline;
            font-family: inherit;
            font-size: inherit;
        }
    </style>
</body>

</html>