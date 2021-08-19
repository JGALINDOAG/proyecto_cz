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
                                    <strong>¡AVISO!</strong><hr>El (La) voucher/notificación se cargo exitosamente, en breve se notificará y se evaluará su pago .
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
        <!-- wrap -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">EVIDENCIA DE PAGO</div>
                </div>
                <hr>
            </div>

            <form name="" action="#" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label>Folio</label>
                        <select class="selectpicker form-control" data-live-search="true" id="cmbFolio_uno" name="cmbFolio" required>
                            <option value="" disabled selected>Selecciona el folio a pagar</option>
                            <?php foreach ($rowInstitucion as $item) : ?>
                                <option value='{"id_folio":"<?php echo $item["id_folio"]; ?>", "total": <?php echo $item["total"]; ?>}'><?php echo $item["id_folio"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!--  -->
                <div id='completed'>
                    <div class="form-group card">
                        <div class="card-body text-center text-muted">
                            El folio se pago correctamente.
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 28rem;">
                    <div class="card-header">
                        <span id="statusPago">Status de pago del Folio</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Costo total por folio <span id="costo">---</span></li>
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
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="2">Total</th>
                                <th id="total">---</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--  -->
                <div id='incompleted'>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Forma de pago</label>
                            <select class="form-control" id="cmbFormaPago" name="cmbFormaPago" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <!-- <option value='{"key":1, "item":"PayPal"}'>Pagar con PayPal</option> -->
                                <option value='{"key":2, "item":"Efectivo"}'>Efectivo</option>
                                <option value='{"key":3, "item":"Transferencia"}'>Transferencia</option>
                                <option value='{"key":4, "item":"Deposito"}'>Deposito</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Cantidad</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" class="form-control" id="cantidad" name="txtCantidad" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pay" class="form-row">
                        <div class="form-group col-sm-6">
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <div id="file" class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Voucher/Comprobante de pago</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cargar</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="hidenCarga" name="file" accept="application/pdf" name="documento">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Solo se permite pdf.</small>
                            <small class="form-text text-muted">El tamaño del archivo no mayor a 10MB.</small>
                        </div>
                        <div id="divReferencia" class="form-group col-sm-2">
                            <label>No. Referencia</label>
                            <input type="number" id="txtReferencia" name="txtReferencia" placeholder="Ejem: 0805210" class="form-control">
                        </div>
                        <div id="divRastreo" class="form-group col-sm-4">
                            <label>Clave de rastreo</label>
                            <input type="text" id="txtRastreo" name="txtRastreo" placeholder="Ejem: 50112251TRANSBPI96491762" class="form-control">
                        </div>
                        <div id="divFolio" class="form-group col-sm-2">
                            <label>Folio</label>
                            <input type="number" id="txtFolio" name="txtFolio" placeholder="Ejem: 707820" class="form-control">
                        </div>
                        <div id="divLinea" class="form-group col-sm-4">
                            <label>Linea de captura</label>
                            <input type="text" id="txtLinea" name="txtLinea" placeholder="Ejem: 212000000018673495748368078" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="validUsuario" value="save">
                    <input type="submit" value="Notificar" id="pagar" class="btn btn-outline-green btn-lg btn-block">
                </div>
            </form>
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