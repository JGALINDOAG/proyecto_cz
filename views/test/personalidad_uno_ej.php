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
                    <form action="<?php echo 'index.php?accion=PersonalidadUno'; ?>" method="post">
                        <h4>PERSONALIDAD 1</h4>
                        <h4>INSTRUCCIONES:</h4>
                        <p>LEE CON CUIDADO CADA UNA DE LAS PREGUNTAS Y RESPONDE (SI &Oacute; NO)</p>
                        <p>EJEMPLO: &iquest;ME GUSTAN LOS DULCES?</p>
                        <p><input type="radio" name="I" disabled checked="checked">SI</p>
                        <p><input type="radio" name="I" disabled>NO</p>
                        <center><input type="submit" class="boton" value="CONTINUAR"></center>
                    </form>
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <h3>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA PERSONALIDAD 1.</h3>
                    <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
                    <?php
                    break;
            }
            ?>
        </div>
<?php require_once("views/test/footer.php"); ?>