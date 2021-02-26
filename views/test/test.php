<?php require_once("views/test/header.php"); ?>
        <nav class="nav">
            <a href="<?php echo 'index.php?accion=Close'; ?>">Cerrar sesión</a>
        </nav>
        <div class="wrap">
        <h3>De clic sobre la prueba que desea realizar</h3>
            <form action="" class="flexcontainerthree" method="post">
                <div align="center">
                    <input type="hidden" name="select_test" value="ok">
                    <?php 
                    for ($l = 0; $l<sizeof($list); $l++) { 
                        $cadena=str_replace(' ','',$list[$l]["prueba"]);
                        ?>
                        <input type="submit" class="boton" name="<?php echo $cadena; ?>" value="<?php echo $list[$l]["prueba"]; ?>">
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
<?php require_once("views/test/footer.php"); ?>