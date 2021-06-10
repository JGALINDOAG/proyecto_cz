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
                    <div class="col-11">ACTIVACIÓN DE FOLIOS</div>
                </div>
                <hr>
            </div>
            <form method="post">
                <div class="table-responsive">
                    <table class="table table-hover" id="user" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="100px"><input type="checkbox" id="MarcarTodos" /><span id="active">&nbsp;Activar</span></th>
                            <th scope="col">Folio</th>
                            <th scope="col">Nombre del vendedor</th>
                            <th scope="col">Institución</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($rowInstitucionAdministrador as $item): ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td class="text-right"><input type="checkbox" name="<?php echo 'active'.$i; ?>" value='{"id":"<?php echo $item[4]; ?>","val": <?php echo 1; ?>}'></td>
                            <td><?php echo $item[4]; ?></td>
                            <td><?php echo $item[3]; ?></td>
                            <td><?php echo $item[1]; ?></td>
                        </tr>
                        <?php $i++; endforeach;?>
                    </tbody>
                    <?php if(!empty($rowInstitucionAdministrador)): ?>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <input type="hidden" name="validUsuario" value="save">
                                    <input type="submit" value="Activar folios" class="btn btn-outline-green btn-lg btn-block">
                                </td>
                            </tr>
                        </tfoot>
                    <?php endif;?>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryInstitucionAdministrador.js"></script>
</body>
</html>