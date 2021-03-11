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
                            <form action="<?php echo 'index.php?accion=mmpi'; ?>" method="post">
                                <h4>MMPI</h4>
                                <h4>INSTRUCCIONES:</h4>
                                <p>Esta prueba contiene una serie de frases en las que usted debe ser absolutamente honesto con sus respuestas, el test está capacitado para detectar falsedad o la manipulación del mismo , si es el caso, se invalidarán sus datos y tendrá que repetir la prueba.</p>
                                <p>Lea cuidadosamente cada una de las frases, debe responder marcando el circulo F en caso de ser Falso y V en caso de ser Verdadero como se muestra a continuación.</p>
                                <p>EJEMPLO: &iquest;Me gustan las revistas de mecánica?</p>
                                <p><input type="radio" name="I" disabled checked="checked"> Falso</p>
                                <p><input type="radio" name="I" disabled> Verdadero</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA MMPI.</h3>
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