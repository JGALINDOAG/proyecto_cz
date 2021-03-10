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
                            <form action="<?php echo 'index.php?accion=Intereses'; ?>" method="post">
                                <h4>INTERESES</h4>
                                <h5>Descripcion Examen</h5>
                                <p>El Test de Intereses Vocacionales, es una herramienta completa que ofrece información detallada sobre los intereses de una persona y las actividades profesiográficas o laborales que pueden encajar mejor con ella.</p>
                                <h5>Instrucciones:</h5>
                                <p>En la medida que vayas leyendo cada pregunta, piensa ¿qué tanto te gustaría hacer….? Posteriormente escribe con un número la que seleccionaste, según la escala que aparece a continuación: me desagrada mucho o totalmente; me desagrada algo o en parte; me es indiferente, pues ni me gusta, ni me disgusta;  me gusta algo o en parte; me gusta mucho.</p>
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
                            <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA DE INTERESES.</h3>
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