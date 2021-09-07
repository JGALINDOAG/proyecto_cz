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
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;La actualización de la Institución se realizo exitosamente
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
        <!-- Reporte por folio -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">ACTUALIZAR INSTITUCIÓN</div>
                </div>
                <hr>
            </div>
            <form name="form" method="post" class="needs-validation" novalidate class="disabled">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <select name="cmbInstitucion" id="cmbInstitucion" class="selectpicker form-control" data-live-search="true" required>
                            <option value="" selected>Selecciona una Institucion</option>
                            <?php foreach ($rowInstitucion as $item) : ?>
                                <option value="<?php echo $item['id_institucion']; ?>" <?php if (isset($_POST["cmbInstitucion"]) == $item['id_institucion']) echo "selected"; ?>><?php echo $item['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Nombre de la Institución</label>
                        <input type="text" name="txtNombreInst" id="txtNombreInst" placeholder="Nombre" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtNombreInst"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el nombre de la Institución.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Abreviatura</label>
                        <input type="text" name="txtAbreviatura" id="txtAbreviatura" placeholder="Abreviatura de la Institución" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtAbreviatura"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba la abreviatura de la Institución.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-lg-3">
                        <label>RFC</label>
                        <input type="text" name="txtRFC" id="txtRFC" placeholder="RFC" class="form-control" onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtRFC"]; ?>" pattern="[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]" required>
                        <div class="invalid-feedback">
                            Por favor escriba el RFC.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-lg-4">
                        <label>Email</label>
                        <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="<?php echo @$_POST["txtEmail"]; ?>" class="form-control">
                    </div>
                    <div class="form-group col-sm-12 col-lg-5">
                        <label>Número telefonico</label>
                        <input type="text" name="txtTelefono" id="txtTelefono" maxlength="10" placeholder="Número telefonico: 5537126509" onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtTelefono"]; ?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor escriba el # de telefóno.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Selección de pruebas a vender</label>
                        <select class="form-control" name="cmbPrueba[]" id="cmbPrueba" multiple style="height: 283px" required>
                            <?php foreach ($rowPruebas as $item) : ?>
                                <?php foreach (@$_POST["cmbPrueba"] as $item2) : ?>
                                    <?php if ($item['id_prueba'] == $item2) : ?>
                                        <option value="<?php echo $item['id_prueba']; ?>" <?php if (isset($item2) == $item['id_prueba']) echo "selected"; ?>>
                                            <?php echo $item['prueba']; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">Para agregar o quitar pruebas manten presionado la tecla <b>control</b> y dar <b>clic</b> en la prueba a seleccionar</small>
                    </div>
                </div>
                <input type="hidden" name="validUsuario" value="updateIntitucion">
                <input type="submit" value="Actualizar" class="btn btn-outline-green btn-lg btn-block">
            </form>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/jqueryUpdateInstitucion.js"></script>
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