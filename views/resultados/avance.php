<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>
    <div class="form-group row d-flex justify-content-center">
        <div class="col-sm-12">
            <?php
            @$m = AccesoDatos::desencriptar($_GET['m']);
            if (isset($m)) {
                switch ($m) {
                    case '1':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;Los folio(s) se activarón exitosamente
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
        <!-- wrap -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">
            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">AVANCES EN TIEMPO REAL</div>
                </div>
                <hr>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Folio</label>
                    <select id="cmbFolio" name="cmbFolio" class="selectpicker form-control" data-live-search="true">
                        <option value="" disabled selected>Selecciona el folio a pagar</option>
                        <?php foreach ($rowFolios as $item) : ?>
                            <option value=<?php echo $item['id_folio']; ?>><?php echo $item['id_folio']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="descript"></div>
            <div id="table" class="table-responsive">
                <table class="table table-hover" id="listPersonas" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryAvance.js"></script>
</body>

</html>