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
                    // @$m=AccesoDatos::desencriptar($m);
                    if(isset($m)){
                        switch ($m){
                            case '1':
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong><hr>El pago se realizo exitosamente
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
                        <select class="form-control" id="cmbFolio" required>
                            <option value="" disabled selected>Selecciona el folio a pagar</option>
                            <?php foreach($rowInstitucion as $item): ?>
                            <option value=<?php echo $item['id_folio']; ?>><?php echo $item['id_folio']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Forma de pago</label>
                        <select class="form-control" id="cmbFormaPago" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="1">Pagar con PayPal</option>
                            <option value="2">Efectivo</option>
                            <option value="3">Transferencia</option>
                            <option value="4">Pago por banco</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Cantidad</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" id="cantidad" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div id="pay" class="form-group col-sm-6">
                        <!-- Set up a container element for the button -->
                        <div id="paypal-button-container"></div>
                    </div>
                    <div id="file" class="form-group col-sm-12">
                        <label>Carga de comprobante</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cargar</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="hidenCarga" accept="image/jpeg" name="documento">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Solo se permite imagenes jpg/jpge.</small>
                        <small id="emailHelp" class="form-text text-muted">El tamaño del archivo no mayor a 10MB.</small>
                    </div>
                </div>
                <input type="hidden" name="validUsuario" value="save">
                <input type="submit" value="Enviar comprobante" id="pagar" class="btn btn-outline-green btn-lg btn-block">
            </form>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryPago.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AcMUqZGxC9nXvrr994-RqCSDmpIXDC1njOYsj1R0K3lRy3TlUuzhgvkVkPQrAr03RccvK0pbzfHPSAW_&currency=MXN"> // Replace YOUR_CLIENT_ID with your sandbox client ID</script>
</body>
</html>