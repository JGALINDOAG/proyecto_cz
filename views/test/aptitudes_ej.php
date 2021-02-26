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
                    <form action="<?php echo 'index.php?accion=Aptitudes'; ?>" method="post">
                        <h4>APTITUDES</h4>
                        <h5>Descripcion Examen</h5>
                        <p>EEste test tiene como finalidad medir la importancia de la aptitud, utilizando para medir las competencias, habilidades, capacidades y el conocimiento de alguien. Los empleadores se benefician de ellas para determinar si un candidato es apto para el trabajo para el que se considera.</p>
                        <h5>Instrucciones:</h5>
                        <p>A continuación te presentamos una lista de actividades comunes, de las cuales puedes contar con alguna experiencia personal. Este ejercicio fue diseñado para que descubras tus aptitudes. Lee cada pregunta y anota el valor correspondiente conforme a la siguiente respuestas:</p>
                        <p>0: considero ser incompetente; 1: considero ser muy poco competente: 2: considero ser medianamente competente; 3: considero ser competente; 4: considero ser muy competente.</p>
                        <center><input type="submit" class="boton" value="CONTINUAR"></center>
                    </form>
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA DE APTITUDES.</h3>
                    <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
                    <?php
                    break;
            }
            ?>
        </div>
<?php require_once("views/test/footer.php"); ?>