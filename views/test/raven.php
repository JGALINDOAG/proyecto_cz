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
                    <div class="group-item"><?php echo $preguntas[$i]["pregunta"]; ?></div>
                    <?php
                    $op = new Pruebas();
                    //Muestra las opciones que contiene una pregunta
                    $opcion = $op->opciones_pregunta($preguntas[$i]["id_pregunta"]);
                    ?>
                    <center>
                    <br>
                    <select name="<?php echo $preguntas[$i]["id_pregunta"]; ?>" required>
                    <option value="">Seleccione una opción</option>
                    <?php
                    for ($o = 0; $o < sizeof($opcion); $o++) {
                        ?>
                        <option value="<?php echo $opcion[$o]["id_opcion"]; ?>"><?php echo $opcion[$o]['opcion']; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    </center>
                    <?php
                }
                ?>
                <br><br><center><input type="submit" class="boton" value="CONTINUAR"></center>
            </form>
        </div>
<?php require_once("views/test/footer.php"); ?>