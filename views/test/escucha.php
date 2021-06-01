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
                <table border="0" width="100%" class="table table-striped">
                <tbody>
                <thead class="table-dark">
                <tr>
                    <th width="80%">PREGUNTAS</th>
                    <th width="20%">OPCIONES</th>
                </tr>
                </thead>
                <?php 
                for ($i = 0; $i < sizeof($preguntas); $i++) { 
                    ?>
                    <tr>
                        <td><strong><?php echo $preguntas[$i]["pregunta"]; ?></strong></td>
                        <td>
                        <select name="<?php echo $preguntas[$i]["id_pregunta"]; ?>" required>
                        <option value="">Seleccione una opción</option>
                        <?php 
                        $op = new Pruebas();
                        $opcion = $op->opciones_pregunta($preguntas[$i]["id_pregunta"]);
                        for ($o = 0; $o < sizeof($opcion); $o++) { 
                            ?><option value="<?php echo $opcion[$o]["id_opcion"]; ?>"><?php echo $opcion[$o]['valor']; ?> - <?php echo $opcion[$o]['opcion']; ?></option>
                            <?php } ?>
                        </select>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                </table>
                <br><br><center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
            </form>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>