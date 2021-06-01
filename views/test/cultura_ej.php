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
                            <form action="<?php echo 'index.php?accion=Cultura'; ?>" method="post">
                                <h4>TIPO DE CULTURA ORGANIZACIONAL</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Este cuestionario tiene como finalidad autodeterminar el tipo de cultura organizacional que mejor te adecua o te agrada.</p>
                                <h5>Instrucciones:</h5>
                                <p>Esta prueba tiene como finalidad obtener información con relación al tipo de cultura organizacional que mejor te adapta; no hay respuestas correctas o incorrectas por lo que se solicita contestar con toda sinceridad. Para responder, utiliza solamente los espacios sombreados, utilizando la escala:
1  Muy en desacuerdo; 2  Desacuerdo; 3  No sé; 4  De acuerdo; 5 Muy de acuerdo</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA TIPO DE CULTURA ORGANIZACIONAL.</h3>
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