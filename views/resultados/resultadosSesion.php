<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <!-- -->
            <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                <div class="media d-flex align-items-center">
                    <div class="media-body">
                        <h5 class="mt-0">Resultados</h5>
                        <p>Nombre: <?php echo $info[0]["nombre"] . ' ' . $info[0]["primer_apellido"] . ' ' . $info[0]["segundo_apellido"]; ?></p>
                        <p>Fecha nacimiento: <?php echo $info[0]["fecha_nacimiento"]; ?></p>
                        <p>Perfil final: <?php $fnl = $obj_reporte->p_final($idDetalle);
                                            echo $fnl[0]['final']; ?></p>
                    </div>
                </div>
            </div>
            <!-- -->
            <?php
            if ($activo[0]['activo'] == 1) {
                $estud = $info[0]['grado_estudios'];
                for ($l = 0; $l < sizeof($list); $l++) {
                    if ($list[$l]["idprueba"] == 1) {
                        if ($estud == "bachillerato" || $estud == "licenciatura" || $estud == "posgrados") {
                            //TERMAN
                            echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                            echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['ci'] . '</strong></p>';
                            $avance1 = $obj_pruebas->fin_prueba($idDetalle, 1); #
                            if ($avance1[0]["Total"] == 10) {
                                $terman = $obj_reporte->res_total($idDetalle, $list[$l]["idprueba"]); #
                                $data1 = $obj_reporte->perfil_terman($terman[0]['total']); #
                                echo '<p><strong>Resultados obtenidos:</strong></p>';
                                echo '<p>El evaluado obtuvo un coeficiente intelectual de <strong>' . $data1['ci'] . '</strong> equivalente a la categoría <strong>' . $data1['categoria'] . '</strong> de acuerdo con su grupo de edad en esta escala.</p>';
                                echo '<p><strong>Definición:</strong></p>';
                                echo $data1['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>';
                                echo '<p>' . $data1['tratamiento'] . '</p>';
                                //echo '<p><strong>Perfil en la prueba: ' . $data1['perfil'] . '</strong></p>';
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 2) {
                        //RASGOS DE PERSONALIDAD
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['smpuno'] . '</strong></p>';
                        $avance2 = $obj_pruebas->fin_prueba($idDetalle, 2); #
                        if ($avance2[0]["Total"] == 11) {
                            $smp02 = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            for ($i = 0; $i < sizeof($smp02); $i++) {
                                $int = $obj_reporte->perfil_smp02($smp02[$i]["id_indicador"], abs($smp02[$i]["resultado"]), $info[0]['sexo']); #
                                echo '<p><strong>' . ucfirst(strtolower($smp02[$i]["indicador"])) . '</strong>: ' . abs($smp02[$i]["resultado"]) . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>' . $int['tratamiento'];
                                echo '<p><strong>Perfil en indicador: ' . $int['perfil'] . '</strong></p>';
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 3) {
                        //CAPACIDAD PARA ADAPTARSE
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['smpdos'] . '</strong></p>';
                        $avance3 = $obj_pruebas->fin_prueba($idDetalle, 3); #
                        if ($avance3[0]["Total"] == 5) {
                            $smp03 = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            for ($i = 0; $i < sizeof($smp03); $i++) {
                                $int = $obj_reporte->perfil_smp03($smp03[$i]["id_indicador"], abs($smp03[$i]["resultado"])); #
                                echo '<p><strong>' . ucfirst(strtolower($smp03[$i]["indicador"])) . '</strong>: ' . abs($smp03[$i]["resultado"]) . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>' . $int['tratamiento'];
                                echo '<p><strong>Perfil en indicador: ' . $int['perfil'] . '</strong></p>';
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 4) {
                        if ($estud == "ninguno" || $estud == "preescolar" || $estud == "primaria" || $estud == "secundaria") {
                            //RAVEN
                            echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                            echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['ci'] . '</strong></p>';
                            $avance4 = $obj_pruebas->fin_prueba($idDetalle, 4); #
                            if ($avance4[0]["Total"] == 5) {
                                $raven = $obj_reporte->res_total($idDetalle, $list[$l]["idprueba"]); #
                                $data4 = $obj_reporte->perfil_raven($raven[0]['total']); #
                                echo '<p><strong>Resultados obtenidos:</strong></p>';
                                echo '<p>El evaluado obtuvo un coeficiente intelectual de <strong>' . $data4['ci'] . '</strong> equivalente a la categoría <strong>' . $data4['categoria'] . '</strong> de acuerdo con su grupo de edad en esta escala.</p>';
                                echo '<p><strong>Definición:</strong></p>';
                                echo $data4['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>';
                                echo '<p>' . $data4['tratamiento'] . '</p>';
                                //echo '<p><strong>Perfil en la prueba: ' . $data4['perfil'] . '</strong></p>';
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 5 || $list[$l]["idprueba"] == 6) {
                        //INTERESES APTITUDES
                        $avance5 = $obj_pruebas->fin_prueba($idDetalle, 5); #
                        $avance6 = $obj_pruebas->fin_prueba($idDetalle, 6); #
                        if ($avance5[0]["Total"] == 10 and $avance6[0]["Total"] == 10) {
                            $intereses = $obj_reporte->res_ind($idDetalle, 5); #
                            $aptitudes = $obj_reporte->res_ind($idDetalle, 6); #
                            require_once 'views/test/ov_result.php';
                        }
                    }
                }
            ?>
            <?php
            } elseif ($activo[0]['activo'] == 0) {
                echo '<p>Se requiere activación de las pruebas.</p>';
            }
            ?>
        </div>
    </section>
    <?php require_once 'views/layout/footer.php'; ?>
</body>

</html>