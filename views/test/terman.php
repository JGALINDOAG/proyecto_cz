<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<script type="text/javascript" language="javascript" src="<?php echo AccesoDatos::ruta(); ?>assets/js/funciones.js"></script>
<body onLoad="<?php echo $time; ?>">
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
        <form action="" id="form1" method="post">
                <input type="hidden" name="save" value="<?php echo $serie; ?>">
                <?php
                for ($i = 0; $i < sizeof($preguntas); $i++) {
                    $ind = $preguntas[$i]["id_indicador"];
                    ?>
                    <h4><?php echo $preguntas[$i]["pregunta"]; ?></h4>
                    <?php
                    $op = new Pruebas();
                    //Muestra las opciones que contiene una pregunta
                    $opcion = $op->opciones_pregunta($preguntas[$i]["id_pregunta"]);
                    for ($o = 0; $o < sizeof($opcion); $o++) {
                        if ($ind != 4) {
                            ?>
                            <input type="radio" name="<?php echo $opcion[$o]["id_pregunta"]; ?>" value="<?php echo $opcion[$o]["id_opcion"]; ?>" />
                            <label><?php echo $opcion[$o]['opcion']; ?></label><br>
                            <?php
                        } elseif ($ind = 4) {
                            ?>
                            <input type="checkbox" name="<?php echo $opcion[$o]["id_opcion"]; ?>" value="<?php echo $opcion[$o]["id_opcion"]; ?>" />
                            <label><?php echo $opcion[$o]['opcion']; ?></label><br>
                            <?php
                        }
                    }
                }
                ?>
                <br><br>
                <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
        </form>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>