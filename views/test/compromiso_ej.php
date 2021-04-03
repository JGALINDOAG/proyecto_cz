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
                            <form action="<?php echo 'index.php?accion=Compromiso'; ?>" method="post">
                                <h4>COMPROMISO A LA ORGANIZACIÓN</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Esta prueba tiene como finalidad obtener información con relación a tu grado de compromiso organizacional.</p>
                                <h5>Instrucciones:</h5>
                                <p>Esta prueba tiene como finalidad obtener información con relación a tu grado de compromiso organizacional; no hay respuestas correctas o incorrectas por lo que se solicita contestar con toda sinceridad. Para responder, utiliza solamente los espacios sombreados, utilizando la escala:
1: Estoy muy en desacuerdo;   2: En desacuerdo;  3: Un poco en desacuerdo; 4: Mas o menos o no sé;  5: Un poco de acuerdo;   6: De acuerdo;   7: Bastante de acuerdo.</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA COMPROMISO A LA ORGANIZACIÓN.</h3>
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