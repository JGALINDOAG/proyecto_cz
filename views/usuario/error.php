</html>
<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body onload="document.form.login.focus();">
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::index(); ?>

    <!-- Cuerpo de la pagina -->
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <img src="script/ima/login.svg" class="align-self-center mr-3 img" alt="...">
                    <div class="media-body">
                        <h5 class="mt-0">ACCESO EXCLUSIVO</h5>
                        <p>"¡Ups! Parece que hemos tenido un inconveniente. La página no existe"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Invoca al Footer -->
    <?php require_once 'views/layout/footer.php'; ?>
</body>

</html>