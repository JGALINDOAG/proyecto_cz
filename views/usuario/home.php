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
                                    <strong>¡AVISO!</strong><hr>Las pruebas se activaron exitosamente
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
                    <div class="col-11">ACTIVACIÓN DE PRUEBAS</div>
                </div>
                <hr>
            </div>
            <form method="post">
                <table class="table table-hover" id="user" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activar</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Institución</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($rowDetallePersonasPruebas as $item): ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><input type="checkbox" name="<?php echo 'active'.$i; ?>" value='{"id":<?php echo $item[0]; ?>,"val": <?php echo 1; ?>}'></td>
                        <td><?php echo $item[1]; ?></td>
                        <td><?php echo $item[2]; ?></td>
                    </tr>
                    <?php $i++; endforeach;?>
                </tbody>
                <?php if(!empty($rowDetallePersonasPruebas)): ?>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <input type="hidden" name="validUsuario" value="save">
                                <input type="submit" value="Activar pruebas" class="btn btn-outline-green btn-lg btn-block">
                            </td>
                        </tr>
                    </tfoot>
                <?php endif;?>
                </table>
            </form>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryHomeUsuario.js"></script>
</body>
</html>