<!DOCTYPE html>
<html lang="es">

<!-- Invoca al Head -->
<?php require_once 'views/layout/head.php'; ?>

<body>
    <!-- Invoca al Navbar -->
    <?php NavbarUsuarioController::navResultado(); ?>
    <div class="form-group row d-flex justify-content-center">
        <div class="col-sm-12">
            <?php
            @$m = AccesoDatos::desencriptar($_GET['m']);
            if (isset($m)) {
                switch ($m) {
                    case '1':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;La observación se agrego exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                        break;
                    case '2':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>¡AVISO!</strong>&nbsp;La observación se actualizo exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                        break;
                }
            }
            ?>
        </div>
    </div>
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
                    } elseif ($list[$l]["idprueba"] == 7) {
                        //ANÁLISIS TRANSACCIONAL
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance7 = $obj_pruebas->fin_prueba($idDetalle, 7); #
                        if ($avance7[0]["Total"] == 12) {
                            $analisis = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            for ($i = 0; $i < sizeof($analisis); $i++) {
                                $int = $obj_reporte->analisis($analisis[$i]["id_indicador"], $analisis[$i]["resultado"]); #
                                echo '<p><strong>' . ucfirst(strtolower($analisis[$i]["indicador"])) . '</strong>: ' . $analisis[$i]["resultado"] . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 8) {
                        //COMPROMISO A LA ORGANIZACIÓN
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance8 = $obj_pruebas->fin_prueba($idDetalle, 8); #
                        if ($avance8[0]["Total"] == 1) {
                            $cultura = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            $int = $obj_reporte->gral_test_definicion($cultura[0]["id_indicador"], $cultura[0]["resultado"]); #
                            echo '<p><strong>' . ucfirst(strtolower($cultura[0]["indicador"])) . '</strong>: ' . $cultura[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                        }
                    } elseif ($list[$l]["idprueba"] == 9) {
                        //TIPO DE CULTURA ORGANIZACIONAL
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance9 = $obj_pruebas->fin_prueba($idDetalle, 9); #
                        if ($avance9[0]["Total"] == 1) {
                            $cultura = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            $int = $obj_reporte->gral_test_definicion($cultura[0]["id_indicador"], $cultura[0]["resultado"]); #
                            echo '<p><strong>' . ucfirst(strtolower($cultura[0]["indicador"])) . '</strong>: ' . $cultura[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                        }
                    } elseif ($list[$l]["idprueba"] == 10) {
                        //CLIMA PARA EL CAMBIO
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance10 = $obj_pruebas->fin_prueba($idDetalle, 10); #
                        if ($avance10[0]["Total"] == 1) {
                            $clima = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            $int = $obj_reporte->gral_test_definicion($clima[0]["id_indicador"], $clima[0]["resultado"]); #
                            echo '<p><strong>' . ucfirst(strtolower($clima[0]["indicador"])) . '</strong>: ' . $clima[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                        }
                    } elseif ($list[$l]["idprueba"] == 11) {
                        //NIVEL DE ESCUCHA
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance11 = $obj_pruebas->fin_prueba($idDetalle, 11); #
                        if ($avance11[0]["Total"] == 1) {
                            $escucha = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            $int = $obj_reporte->gral_test_definicion($escucha[0]["id_indicador"], $escucha[0]["resultado"]); #
                            echo '<p><strong>' . ucfirst(strtolower($escucha[0]["indicador"])) . '</strong>: ' . $escucha[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                        }
                    } elseif ($list[$l]["idprueba"] == 12) {
                        //MMPI
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance12 = $obj_pruebas->fin_prueba($idDetalle, 12); #
                        if ($avance12[0]["Total"] == 13) {
                            require_once 'views/test/mmpi_result.php';
                        }
                    } elseif ($list[$l]["idprueba"] == 13) {
                        //TEST PROYECTIVO KAREN MACHOVER
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance13 = $obj_pruebas->fin_prueba($idDetalle, 13); #
                        if ($avance13[0]["Total"] == 16) {
                            $machover = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            for ($i = 0; $i < sizeof($machover); $i++) {
                                $int = $obj_reporte->machover($machover[$i]["id_indicador"], $machover[$i]["resultado"]);
                                //echo '<p><strong>' . ucfirst(strtolower($machover[$i]["indicador"])) . '</strong>: ' . $machover[$i]["resultado"] . '</p>';
                                echo '<p><strong>' . ucfirst(strtolower($machover[$i]["indicador"])) . '</strong></p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            }
                        }
                    } elseif ($list[$l]["idprueba"] == 14) {
                        //GRADO DE RETROALIMENTACIÓN
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $avance14 = $obj_pruebas->fin_prueba_op($idDetalle, 14); #
                        if ($avance14[0]["Total"] == 2) {
                            $grado = $obj_reporte->res_ind($idDetalle, $list[$l]["idprueba"]); #
                            if ($grado[0]['resultado'] >= 6 and $grado[0]['resultado'] <= 8) {
                                echo '<p><strong>' . ucfirst(strtolower($grado[0]["indicador"])) . '</strong>: ' . $grado[0]['resultado'] . '</p>';
                                echo '<p><strong>Definición:</strong></p><p>Hacen referencia a toda aquella información que devuelve el receptor al emisor sobre su propia comunicación. El sujeto posee las fortalezas necesarias para desarrollar el saber escuchar, procesar la información recibida y externar una respuesta a su entorno. Son de gran ayuda en la organización, por lo que al usar correctamente esta herramienta  se puede generar el cambio que se espera y además comprometer más explícitamente a la persona evaluada que lo recibe.</p>';
                            } else {
                                echo '<p><strong>' . ucfirst(strtolower($grado[1]["indicador"])) . '</strong>: ' . $grado[1]['resultado'] . '</p>';
                                echo '<p><strong>Definición:</strong></p><p>Como receptor no tiene la capacidad para devolver información al emisor sobre su propia comunicación. El sujeto no posee las fortalezas necesarias para saber escuchar, procesar la información recibida y externar una respuesta a su entorno. Esto no es de gran ayuda en la organización, y al no usar correctamente esta herramienta  es dificil que pueda generar el cambio que se espera y además no compromete a el alumno que lo recibe.</p>';
                            }
                        }
                    }
                }
            ?>
                <hr>
                <?php if ($_SESSION['idInstitucion'] == 1) : ?>
                    <input type="checkbox" name="observacion" id="observacion" value="true" <?php if (!empty($rowObservacion)) echo "checked"; ?>>&nbsp;<b>Permitir ingresar una observación</b>
                    <div id="showObservaciones" class="pt-4" <?php if (empty($rowObservacion)) echo "style='display:none'"; ?>>
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="font-weight-bold">Observaciones</label>
                                <textarea name="textObservacion" class="form-control" placeholder="Ingrese algúna observación si es necesario" rows="5" required><?php echo @$rowObservacion[0]['observacion']; ?></textarea>
                            </div>
                            <div class="form-group text-center font-weight-bold">
                                Psic. Christian Zepeda Alcantara
                            </div>
                            <div class="form-group text-center font-weight-bold">
                               <small>Cédula profesional: 3235520</small> 
                            </div>
                            <input type="hidden" name="validUsuario" value="saveObs">
                            <input type="submit" value="Enviar observaciones" class="btn btn-outline-green btn-lg btn-block">
                        </form>
                    </div>
                <?php
                elseif ($_SESSION['idInstitucion'] != 1 && !empty($rowObservacion)) :
                ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="font-weight-bold">Observaciones</label>
                            <p><?php echo @$rowObservacion[0]['observacion']; ?></p>
                        </div>
                        <div class="form-group text-center font-weight-bold">
                            Psic. Christian Zepeda Alcantara
                        </div>
                        <div class="form-group text-center font-weight-bold">
                            <small>Cédula profesional: 3235520</small>
                        </div>
                    </form>
                <?php endif; ?>
            <?php
            } elseif ($activo[0]['activo'] == 0) {
                echo '<p>Se requiere activación de las pruebas.</p>';
            }
            ?>
        </div>
    </section>
    <?php require_once 'views/layout/footer.php'; ?>
    <script>
        $(document).ready(function() {
            $("#observacion").change(function() {
                if ($('#observacion').prop('checked')) $('#showObservaciones').css('display', 'block')
                else $('#showObservaciones').css('display', 'none')
            });


        });
    </script>
</body>

</html>