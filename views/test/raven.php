<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
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
                <br><br><center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
            </form>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>