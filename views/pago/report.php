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
                                    <strong>¡AVISO!</strong>&nbsp;El pago se realizo exitosamente, en breve se notificará y se evaluará su pago para la activación del folio.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                        break;
                    case '2':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;El voucher se cargo exitosamente, en breve se notificará y se evaluará su pago para la activación del folio.
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
                            <th scope="col">Fecha emisión</th>
                            <th scope="col">Institución</th>
                            <th scope="col">Vendedor</th>
                            <th scope="col">Costo prueba</th>
                            <th scope="col">Núm de pruebas</th>
                            <th scope="col">Costo cobrado (evaluado)</th>
                            <th scope="col">Costo total</th>
                            <th scope="col">Abono</th>
                            <th scope="col">Adeudo</th>
                            <th scope="col">Opción</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9" class="text-center">No hay datos disponibles en la tabla.</td>
                        </tr>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th class="text-right" colspan="9">Total</th>
                            <th id="total_uno" class="text-rigth" colspan="2">---</th>
                        </tr>
                    </tfooter>
                </table>
            </div>
        </div>
        <!-- MODAL -->
        <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalle de pagos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="h5" id="folio_title">Folio:</label>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="h5" id="abono_total">Abono:</label>
                            </div>
                            <div class="form-group">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Fecha de pago</th>
                                            <th scope="col">Tipo de pago</th>
                                            <th scope="col">Pago</th>
                                            <th scope="col">Referencia</th>
                                            <th scope="col">Clave de rastreo</th>
                                            <th scope="col">Vaucher</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody"></tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
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