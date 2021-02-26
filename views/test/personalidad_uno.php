<?php require_once("views/test/header.php"); ?>
        <nav class="nav">
            <a href="<?php echo 'index.php?accion=Close'; ?>">Cerrar sesión</a>
            <a href="<?php echo 'index.php?accion=Tests'; ?>">Volver</a>
        </nav>
        <div class="wrap">
            <form action="" method="post">
                <input type="hidden" name="save" value="ok">
                <?php
                for ($i = 0; $i < sizeof($preguntas); $i++) {
                    ?>
                    <p><strong><?php echo $preguntas[$i]["pregunta"]; ?></strong></p>
                    <?php
                    $op = new Pruebas();
                    //Muestra las opciones que contiene una pregunta
                    $opcion = $op->opciones_pregunta($preguntas[$i]["id_pregunta"]);
                    for ($o = 0; $o < sizeof($opcion); $o++) {
                        ?>
                        <input type="radio" name="<?php echo $opcion[$o]["id_pregunta"]; ?>" value="<?php echo $opcion[$o]["id_opcion"]; ?>" required />
                        <label><?php echo $opcion[$o]['opcion']; ?></label><br>
                        <?php
                    }
                }
                ?>
                <br><br><center><input type="submit" class="boton" value="CONTINUAR"></center>
            </form>
        </div>
<?php require_once("views/test/footer.php"); ?>