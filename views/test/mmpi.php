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
                <br><br><center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
            </form>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>