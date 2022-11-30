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
                        $folio = AccesoDatos::desencriptar($_GET['f']);
                        $nombre = AccesoDatos::desencriptar($_GET['n']);
                        $telefono = AccesoDatos::desencriptar($_GET['t']);
                        $costo = AccesoDatos::desencriptar($_GET['c']);
                        $noPruebas = AccesoDatos::desencriptar($_GET['v']);
                        $noPGratis = AccesoDatos::desencriptar($_GET['g']);
                        $text = '';
                        $text .= 'Estimado Sr (a). ' . $nombre . '%0A
                                El equipo que trabaja en CHROME le envia  un cordial saludo y le agradecemos su preferencia.%0A
                                A continuaci&oacute;n le proporcionamos los datos de la venta:%0A
                                El costo por la pruebas es de $'.$costo.'.00 %0A
                                N&uacute;mero de pruebas vendidas '.$noPruebas.'%0A';
                                if($noPGratis != 0):
                                    $text .= 'N&uacute;mero de pruebas gratis '.$noPGratis.'%0A';  
                                endif;
                                $text .= 'El folio generado para esta venta es '.$folio.'%0A
                                Favor de enlazar a la siguiente direcci&oacute;n electr&oacute;nica para realizar la prueba: 
                                https://www.chromeconsultores.com/?accion=Home';

                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>¡AVISO!</strong>&nbsp;Se realizó la venta a la Institución exitosamente&nbsp;|&nbsp;El folio generado para esta venta es <b>'.$folio.'</b>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                &nbsp;|&nbsp;<a href="https://api.whatsapp.com/send?phone=' . $telefono . '&text=' . $text . '" target="_blank">Enviar datos de la venta por WhatSapp</a>
                                </div>';
                        break;
                }
            }
            ?>
        </div>
    </div>
    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <form name="form" method="post" class="needs-validation" novalidate>
            <div class="shadow p-3 mb-5 bg-white rounded">
                <div class="alert alert-light" role="alert">
                    <div class="d-flex align-items-center">VENTA DE PRUEBAS</div>
                    <hr>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Nombre de la Institución</label>
                        <select name="cmbInstitucion" id="cmbInstitucion" class="selectpicker form-control" data-live-search="true" required>
                            <option value="" selected>Selecciona una Institucion</option>
                            <?php foreach ($rowInstitucion as $item) : ?>
                                <option value="<?php echo $item['id_institucion']; ?>" <?php if (isset($_POST["cmbInstitucion"]) == $item['id_institucion']) echo "selected"; ?>>
                                    <?php echo $item['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Vendedor de la Institución</label>
                        <select name="cmbAdmin" id="cmbAdmin" class="form-control" required>
                            <option value="" selected>Selecciona un vendedor</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <label>Costo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="btn btn-outline-secondary">$</span>
                            </div>
                            <input type="text" name="txtCosto" value="<?php echo @$_POST["txtCosto"]; ?>" class="form-control" onkeypress="return soloNumeros(this);" required>
                            <div class="input-group-append">
                                <span class="btn btn-outline-secondary">.00</span>
                            </div>
                            <div class="invalid-feedback">
                                Escriba el costo del paquete.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label>Num. pruebas vendidas</label>
                        <input type="text" name="txtNoPVendidas" placeholder="0" class="form-control" onkeypress="return soloNumeros(this);" value="<?php echo @$_POST["txtNoPVendidas"]; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el num. de pruebas a vender.
                        </div>
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <label>Num. pruebas gratis</label>
                        <input type="text" name="txtNoPGratis" placeholder="0" class="form-control" onkeypress="return soloNumeros(this);" value="<?php if (isset($_POST["txtNoPGratis"])) echo @$_POST["txtNoPGratis"];
                                                                                                                                                    else echo 0; ?>" required>
                        <div class="invalid-feedback">
                            Escriba el num. de pruebas gratis.
                        </div>
                    </div>
                </div>
                <input type="hidden" name="errno[]">
                <input type="hidden" name="validUsuario" value="addVenta">
                <input type="submit" value="Vender" class="btn btn-outline-green btn-lg btn-block">
            </div>
        </form>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/jqueryInstitucion.js"></script>
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