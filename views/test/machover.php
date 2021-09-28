<!DOCTYPE html>
<html lang="es">
<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::navResultado(); ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
            <?php
            switch ($progreso) {
                case 'Progreso':
                    ?>
                    <!-- -->
                    <form action="" method="post">
                        <input type="hidden" name="save" value="ok">
                        <table border="1" width="100%" class="table table-striped">
                        <tbody>
                        <thead class="table-dark">
                        <tr>
                            <th width="85%">PREGUNTAS</th>
                            <th colspan="2" width="15%">OPCIONES</th>
                        </tr>
                        </thead>
                        <?php 
                        //print_r($preguntas);
                        for ($i = 0; $i < sizeof($preguntas); $i++) { 
                            if($preguntas[$i]["id_pregunta"]==1203){
                                echo '<tr><td colspan="3" align="center">Indicador del rol sexual</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1204){
                                echo '<tr><td colspan="3" align="center">Indicador de conflicto sexual</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1209){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de rasgos asociados al abuso sexual.</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1211){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de impulsividad</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1215){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales suicidas</td></tr>';
                            }
                            
                            if($preguntas[$i]["id_pregunta"]==1219){
                                echo '<tr><td colspan="3" align="center">Indicadores rasgos narcisistas</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1221){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de inseguridad</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1229){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de ansiedad</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1235){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales para socializar (esquizoides)</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1239){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de dependencia</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1243){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de timidez</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1251){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de depresión</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1253){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de agresividad</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1261){
                                echo '<tr><td colspan="3" align="center">Indicadores emocionales de rasgos antisociales y delictivos</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1266){
                                echo '<tr><td colspan="3" align="center">Indicadores de deterioro o daño orgánico cerebral</td></tr>';
                            }
                            if($preguntas[$i]["id_pregunta"]==1271){
                                echo '<tr><td colspan="3" align="center">Indicadores textuales conflictivos</td></tr>';
                            }
                            ?>
                            <tr>
                                <td><strong><?php echo $preguntas[$i]["pregunta"]; ?></strong></td>
                                <?php
                                $op = new Pruebas();
                                //Muestra las opciones que contiene una pregunta
                                $opcion = $op->opciones_pregunta($preguntas[$i]["id_pregunta"]);
                                for ($o = 0; $o < sizeof($opcion); $o++) {
                                ?>
                                <td><input type="radio" name="<?php echo $opcion[$o]["id_pregunta"]; ?>" value="<?php echo $opcion[$o]["id_opcion"]; ?>" required />&nbsp;<label><?php echo $opcion[$o]['opcion']; ?></label></td>
                                <?php
                            }
                            ?>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        </table>
                        <br><br><center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                    </form>
                    <!-- -->
                    <?php
                    break;
                case 'Finalizo':
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h3>SE HA REGISTRADO SATISFACTORIAMENTE LAS RESPUESTAS.</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>
        <!-- -->
        </div>
    </section>
<?php require_once 'views/layout/footer.php'; ?>
</body>
</html>