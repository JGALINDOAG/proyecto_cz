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
                            <form action="<?php echo 'index.php?accion=Escucha'; ?>" method="post">
                                <h4>NIVEL DE ESCUCHA</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Esta prueba tiene como finalidad conocer la capacidad y habilidad que el sujeto tiene para escuchar a las personas, claro está, dependiendo del contexto social en que se encuentre.</p>
                                <h5>Instrucciones:</h5>
                                <p>Esta prueba tiene como finalidad obtener información con respecto a tu nivel de escucha; no hay respuestas correctas o incorrectas por lo que se solicita contestar con toda sinceridad. Para responder, utiliza solamente los espacios sombreados, utilizando la escala del 1 al 5, en donde: De 4 a 5 es muy importante; De 2 a 3 es Algo importante; y 1 si lo consideras sin importancia.</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA DE NIVEL DE ESCUCHA.</h3>
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