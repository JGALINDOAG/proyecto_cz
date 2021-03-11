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
                    @$m=str_replace(' ','+',$_GET['m']);
                    @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>La Institución a sido agregada exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                        }
                    } 
                    if(isset($_POST["errno"])){
                        foreach ($_POST["errno"] as $errno):
                            switch ($errno){
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
                        <input type="text" name="txtNombreInst" placeholder="Nombre" class="form-control"
                            onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtNombreInst"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el nombre de la Institución.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Abreviatura</label>
                        <input type="text" name="txtAbreviatura" placeholder="Abreviatura de la Institución" class="form-control"
                            onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtAbreviatura"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba la abreviatura de la Institución.
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-lg-3">
                        <label>RFC</label>
                        <input type="text" name="txtRFC" placeholder="RFC" class="form-control"
                            onkeyup="conMayusculas(this);" value="<?php echo @$_POST["txtRFC"]; ?>" pattern="[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]" required>
                        <div class="invalid-feedback">
                            Por favor escriba el RFC.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-lg-4">
                        <label>Email</label>
                        <input type="email" name="txtEmail" placeholder="Email"
                            value="<?php echo @$_POST["txtEmail"]; ?>" class="form-control">
                    </div>
                    <div class="form-group col-sm-12 col-lg-1">
                        <label>Lada</label>
                        <input type="text" name="txtLada" maxlength="5" placeholder="55"
                            onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtLada"]; ?>"
                            class="form-control" required>
                    </div>
                    <div class="form-group col-sm-12 col-lg-4">
                        <label>Número telefonico</label>
                        <input type="text" name="txtTelefono" maxlength="8" placeholder="Número telefonico"
                            onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtTelefono"]; ?>"
                            class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor escriba el # de telefóno.
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="alert alert-light" role="alert">
                    <div class="d-flex align-items-center">DATOS DEL ADMINISTRADOR</div>
                    <hr>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="btn btn-outline-secondary">Nombre(s)</span>
                            </div>
                            <input type="text" name="txtNombre" placeholder="Nombre del Administrador" class="form-control"
                            onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" value="<?php echo @$_POST["txtNombre"]; ?>" required>
                            <div class="invalid-feedback">
                                Escriba el nombre del administrador.
                            </div>
                        </div>                                          
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="btn btn-outline-secondary">Apellidos</span>
                            </div>
                            <input type="text" name="txtApPaterno" onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" placeholder="Apellido Paterno" class="form-control" value="<?php echo @$_POST["txtApPaterno"]; ?>" required>
                            <input type="text" name="txtApMaterno" onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" placeholder="Apellido Materno" class="form-control" value="<?php echo @$_POST["txtApMaterno"]; ?>">
                            <div class="invalid-feedback">
                                Por favor escriba el apellido Paterno.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="alert alert-light" role="alert">
                    <div class="d-flex align-items-center">DETALLES DE LA VENTA</div>
                    <hr>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Selección de pruebas a vender</label>
                        <select class="selectpicker form-control" name="cmbPrueba[]" multiple data-actions-box="true" data-selected-text-format="count > 4" required>
                            <?php foreach ($rowPruebas as $item): ?>
                                <option value="<?php echo $item['id_prueba']; ?>"
                                    <?php if(isset($_POST["cmbPrueba"] )): foreach ($_POST["cmbPrueba"] as $item2): if($item2 == $item['id_prueba']) echo "selected"; endforeach; endif;?>>
                                    <?php echo $item['prueba']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Costo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="btn btn-outline-secondary">$</span>
                            </div>
                            <input type="text" name="txtCosto" value="<?php echo @$_POST["txtCosto"]; ?>" class="form-control" onkeypress="return soloNumeros(this);" required >
                            <div class="input-group-append">
                                <span class="btn btn-outline-secondary">.00</span>
                            </div>
                            <div class="invalid-feedback">
                                Escriba el costo del paquete.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Num. pruebas vendidas</label>
                        <input type="text" name="txtNoPVendidas" placeholder="0" class="form-control"
                            onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtNoPVendidas"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el num. de pruebas a vender.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Num. pruebas gratis</label>
                        <input type="text" name="txtNoPGratis" placeholder="0" class="form-control"
                            onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtNoPGratis"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el num. de pruebas gratis.
                        </div>
                    </div>
                </div>
                <input type="hidden" name="errno[]">
                <input type="hidden" name="validUsuario" value="save">
                <input type="submit" value="Agregar Institución" class="btn btn-green btn-lg btn-block">
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
</body>

</html>