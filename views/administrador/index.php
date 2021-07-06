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
                                $text = 'Estimado Sr (a). '.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['n'])).'%0A
                                ¡Te damos la bienvenida al Sistema CHROME!%0A
                                Ahora ya puedes comenzar a administrar tu cuenta e interactuar con la Plataforma.%0A
                                No olvides tus credenciales generadas para ingresar al sistema, son las siguientes:%0A
                                USUARIO:&nbsp;'.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['u'])).'%0A
                                CONTRASEÑA:&nbsp;'.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['p'])).'%0A
                                Una vez ingresando al sistema podrás cambiar tu contrase&ntilde;a si así lo deseas';

                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>El personal a sido agregado exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    &nbsp;|&nbsp;<a href="https://api.whatsapp.com/send?phone='.AccesoDatos::desencriptar(str_replace(' ','+',$_GET['t'])).'&text='.$text.'" target="_blank">Enviar datos de sesi&oacute;n por WhatSapp</a>
                                    </div>';
                            break;
                        }
                    } 
                    if(isset($_POST["errno"])){
                        foreach ($_POST["errno"] as $errno):
                            switch ($errno){
                                case 1:
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>¡AVISO!</strong>&nbsp;La persona ya existe en los registros.
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
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="alert alert-light" role="alert">
                    <div class="d-flex align-items-center">DATOS DEL PERSONAL</div>
                    <hr>
                </div>
                <?php if($_SESSION['idInstitucion'] == 1): ?>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="btn btn-outline-secondary">Institución</label>
                            </div>
                            <select name="cmbInstitucion" id="cmbInstitucion" class="selectpicker form-control" data-live-search="true" required>
                                <option value="" selected>Selecciona una Institucion</option>
                                <?php foreach ($rowInstitucion as $item): ?>
                                    <option value="<?php echo $item['id_institucion']; ?>"
                                        <?php if($item['id_institucion'] == @$institution) echo "selected";?>>
                                        <?php echo $item['nombre']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione el cargo.
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="btn btn-outline-secondary">Nombre(s)</span>
                            </div>
                            <input type="text" name="txtNombre" placeholder="Nombre(s)" class="form-control"
                            onkeyup="conMayusculas(this);" onkeypress="return soloLetras(event);" value="<?php echo @$_POST["txtNombre"]; ?>" required>
                            <div class="invalid-feedback">
                                Escriba el nombre de la persona.
                            </div>
                        </div>                                          
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group mb-3">
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
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="btn btn-outline-secondary">Cargo</label>
                            </div>
                            <select name="cmbCargo" class="custom-select" required>
                                <option value="" selected>Selecciona un cargo</option>
                                <?php foreach ($rowRol as $value) { ?>
                                    <option value="<?php echo $value['id_rol']; ?>" <?php if($value['id_rol'] == @$_POST["cmbCargo"]) echo "selected" ?>><?php echo $value['nombre']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione el cargo.
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="errno[]">
                <input type="hidden" name="validUsuario" value="save">
                <input type="submit" value="Agregar Personal" class="btn btn-outline-green btn-lg btn-block">
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