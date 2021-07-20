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
                // @$m=AccesoDatos::desencriptar($m);
                if (isset($m)) {
                    switch ($m) {
                        case '1':
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>El pago se realizo exitosamente, en breve se notificará y se evaluará su pago para la activación del folio.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                            break;
                        case '2':
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>El voucher se cargo exitosamente, en breve se notificará y se evaluará su pago para la activación del folio.
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
        <!-- Reporte por folio -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">REPORTE POR FOLIO</div>
                </div>
                <hr>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
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
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Folio</label>
                    <select id="cmbFolio" name="cmbFolio" class="form-control">
                        <option value="" disabled selected>Selecciona el folio a pagar</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive pt-5">
                <table class="table table-hover" id="reporte" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Tipo de pago</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center">No hay datos disponibles en la tabla.</td>
                        </tr>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th class="text-right" colspan="2">Total</th>
                            <th id="total" class="text-center">---</th>
                        </tr>
                    </tfooter>
                </table>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryReportPerfiles.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AcMUqZGxC9nXvrr994-RqCSDmpIXDC1njOYsj1R0K3lRy3TlUuzhgvkVkPQrAr03RccvK0pbzfHPSAW_&currency=MXN">
        // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
</body>

</html>