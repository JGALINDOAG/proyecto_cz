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
                            <form action="<?php echo 'index.php?accion=Analisis'; ?>" method="post">
                                <h4>ANÁLISIS TRANSACCIONAL</h4>
                                <h5>Descripcion Examen</h5>
                                <p>Esta prueba tiene como finalidad conocer las competencias basadas en el estilo de liderazgo ya sea en la Docencia o empresarial de acuerdo a un contexto determinado. No hay respuesta correcta o incorrecta, por lo que se solicita contestar con toda sinceridad. Contesta sólo en los espacios sombreados.</p>
                                <h5>Instrucciones:</h5>
                                <p>A continuación, se te presentarán una seríe de preguntas, en las cuales deberás  poner el número 1 en caso de que te identifiques, de lo contrario deja en blanco si NO te identificas.</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA ANÁLISIS TRANSACCIONAL.</h3>
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