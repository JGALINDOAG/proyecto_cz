<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">

        <!-- wrap -->
        <div class="shadow p-3 mb-5 bg-white rounded pt-4">

            <div class="alert alert-light" role="alert">
                <div class="form-row">
                    <div class="col-11">ACTIVACIÓN DE PRUEBAS</div>
                </div>
                <hr>
            </div>

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
                <tr>
                    <?php $i = 1; foreach ($rowDetallePersonasPruebas as $item): ?>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><input type="checkbox" name="valid" id=""></td>
                    <td><?php echo $item[0]; ?></td>
                    <td><?php echo $item[1]; ?></td>
                    <?php endforeach; $i++;?>
                </tr>
            </tbody>
            </table>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
    <script src="<?php echo AccesoDatos::ruta(); ?>assets/js/JqueryHomeUsuario.js"></script>
</body>
</html>