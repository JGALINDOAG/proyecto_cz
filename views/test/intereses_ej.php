<?php require_once("views/test/header.php"); ?>
        <nav class="nav">
            <a href="<?php echo 'index.php?accion=Close'; ?>">Cerrar sesión</a>
            <a href="<?php echo 'index.php?accion=Tests'; ?>">Volver</a>
        </nav>
        <div class="wrap">
            <?php
            switch ($progreso) {
                case 'Progreso':
                    ?>
                    <form action="<?php echo 'index.php?accion=Intereses'; ?>" method="post">
                        <h4>INTERESES</h4>
                        <h5>Descripcion Examen</h5>
                        <p>El Test de Intereses Vocacionales, es una herramienta completa que ofrece información detallada sobre los intereses de una persona y las actividades profesiográficas o laborales que pueden encajar mejor con ella.</p>
                        <h5>Instrucciones:</h5>
                        <p>En la medida que vayas leyendo cada pregunta, piensa ¿qué tanto te gustaría hacer….? Posteriormente escribe con un número la que seleccionaste, según la escala que aparece a continuación: me desagrada mucho o totalmente; me desagrada algo o en parte; me es indiferente, pues ni me gusta, ni me disgusta;  me gusta algo o en parte; me gusta mucho.</p>
                        <center><input type="submit" class="boton" value="CONTINUAR"></center>
                    </form>
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA DE INTERESES.</h3>
                    <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
                    <?php
                    break;
            }
            ?>
        </div>
<?php require_once("views/test/footer.php"); ?>