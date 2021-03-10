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
                    <div class="col-11">LISTADO DE PACIENTES</div>
                </div>
                <hr>
            </div>
        
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>

</body>
</html>