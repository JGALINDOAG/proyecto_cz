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
                @$m=AccesoDatos::desencriptar($_GET['m']);
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
        <!-- Reporte general -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">REPORTE GENERAL</div>
                </div>
                <hr>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label>Fecha inicio</label>
                    <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control">
                </div>
                <div class="form-group col-sm-6">
                    <label>Fecha fin</label>
                    <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="reporte_uno" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Folio</th>
                            <th scope="col">Institución</th>
                            <th scope="col">Vendedor</th>
                            <th scope="col">Tipo de Pago</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">No hay datos disponibles en la tabla.</td>
                        </tr>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th class="text-right" colspan="4">Total</th>
                            <th id="total_uno" class="text-center">---</th>
                        </tr>
                    </tfooter>
                </table>
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
                    <select id="cmbFolio_dos" name="cmbFolio" class="form-control">
                        <option value="" disabled selected>Selecciona el folio a pagar</option>
                    </select>
                </div>
            </div>

            <div class="card" style="width: 30rem;">
                <div class="card-header">
                    El vendedor a cargo es <span id="vendedor"></span>
                </div>
                <div class="card-header">
                    <span id="statusPago">Status de pago del Folio</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Costo total por folio <span id="costo">---</span></li>
                    <li class="list-group-item">
                        Precio fijo declarado por los evaluados <span id="costo_evaluado">---</span><br/>
                        Suma total, declarado por los evaluados <span id="costo_total_evaluado">---</span>
                    </li>
                </ul>
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
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryPago.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AcMUqZGxC9nXvrr994-RqCSDmpIXDC1njOYsj1R0K3lRy3TlUuzhgvkVkPQrAr03RccvK0pbzfHPSAW_&currency=MXN">
        // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
</body>

</html>