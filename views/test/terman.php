<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cruzeac</title>
        <link rel="shortcut icon" href="#">
        <link rel="stylesheet" href="./assets/style.css">
        <script src="./assets/funciones.js"></script>
    </head>
    <body class="Body" onLoad="<?php echo $time; ?>">
        <header>
            <img class="mastLogo_sep" src="./assets/logo.png">
            <h3>Cruzeac, Inteligencia y Excelencia | Cruzeac Consultores S. A. de C. V.</h3>
            <img class="mastLogo_pls" src="">
        </header>
        <nav class="nav">
            <a href="<?php echo 'index.php?accion=Close'; ?>">Cerrar sesión</a>
            <a href="<?php echo 'index.php?accion=Tests'; ?>">Volver</a>
        </nav>
        <div class="wrap">
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
                <center><input type="submit" class="boton" value="CONTINUAR"></center>
            </form>
        </div>
<?php require_once("views/test/footer.php"); ?>