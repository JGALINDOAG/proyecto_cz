<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
            <?php
            switch ($progreso) {
                case 'Progreso':
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <form action="<?php echo 'index.php?accion=Retroalimentacion'; ?>" method="post">
                                <h4>GRADO DE RETROALIMENTACIÓN</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Esta prueba tiene como finalidad conocer la capacidad y habilidad que el sujeto tiene para retroalimentar a las personas que así lo requieran, claro está, dependiendo del contexto social en que se encuentre.</p>
                                <h5>Instrucciones:</h5>
                                <p>Abajo hay 8 pares de respuestas, acorde con tu preferencia, califica asignando el número 1 a la respuesta que mejor te identifique cuando proporcionas retroalimentación a alguien.</p>
                                <p> Nota: no se permiten dos respuestas en cada par, solo una respuesta debe de haber.</p>
                                <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA GRADO DE RETROALIMENTACIÓN.</h3>
                            <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>