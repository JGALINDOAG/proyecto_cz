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
                                    <strong>¡AVISO!</strong><hr>Los folio(s) se activarón exitosamente
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
                    <div class="col-11">VISUALIZAR RESULTADOS</div>
                </div>
                <hr>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label>Folio</label>
                    <select id="cmbFolio" name="cmbFolio" class="selectpicker form-control" data-live-search="true">
                        <option value="" disabled selected>Selecciona el folio a pagar</option>
                        <?php foreach($rowFolios as $item): ?>
                            <option value=<?php echo $item['id_folio']; ?>><?php echo $item['id_folio']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="listPersonas" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Fecha registro</th>
                            <th scope="col">Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">No hay datos disponibles en la tabla.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="rol" style="display:none"><?php echo $_SESSION["idRol"]; ?></div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryResultados.js"></script>
</body>
</html>