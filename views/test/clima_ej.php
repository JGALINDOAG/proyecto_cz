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
                            <form action="<?php echo 'index.php?accion=Clima'; ?>" method="post">
                                <h4>CLIMA PARA EL CAMBIO</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Esta prueba tiene como finalidad obtener información con relación al clima laboral para el cambio que quizá se pueda requerir dentro de tu organización, y con ello,  mejorar los alcances u objetivos que tanto se requieren, optimizando tu potencial.</p>
                                <h5>Instrucciones:</h5>
                                <p>Esta prueba tiene como finalidad obtener información con relación al  clima laboral para el cambio; no hay respuestas correctas o incorrectas por lo que se solicita contestar con toda sinceridad. Para responder, utiliza solamente los espacios sombreados, utilizando la escala:
1  Muy en desacuerdo; 2  Desacuerdo; 3 Un poco desacuerdo; 4 Un poco de acuerdo; 5 De acuerdo</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA CLIMA PARA EL CAMBIO.</h3>
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