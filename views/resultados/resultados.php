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
                        <p><?php echo $info[0]["nombre"] . ' ' . $info[0]["primer_apellido"] . ' ' . $info[0]["segundo_apellido"]; ?></p>
                    </div>
                </div>
            </div>
            <!-- -->
            <?php
            if ($activo[0]['activo'] == 1) {
                require_once("models/reporte.php");
                $estud = $info[0]['grado_estudios'];
                $f = new Reporte();
                $fnl = $f->p_final($idDetalle);
                //print_r($fnl);
                echo '<p><strong>Perfil final: ' . $fnl[0]['final'] . '</strong></p>';
                $av = new Pruebas();
                for ($l = 0; $l < sizeof($list); $l++) {
                    if ($list[$l]["id_prueba"] == 1) {
                        if ($estud == "bachillerato" || $estud == "licenciatura" || $estud == "posgrados") {
                            //TERMAN
                            echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                            // $av1 = new Pruebas();
                            $avance1 = $av->fin_prueba($idDetalle, 1);
                            if ($avance1[0]["Total"] == 10) {
                                $r1 = new Reporte();
                                $terman = $r1->res_total($idDetalle, $list[$l]["id_prueba"]);
                                $datos1 = new Reporte();
                                $data1 = $datos1->perfil_terman($terman[0]['total']); //$terman[0]['total']
                                echo '<p><strong>Resultados obtenidos:</strong></p>';
                                echo '<p>El evaluado obtuvo un coeficiente intelectual de <strong>' . $data1['ci'] . '</strong> equivalente a la categoría <strong>' . $data1['categoria'] . '</strong> de acuerdo con su grupo de edad en esta escala.</p>';
                                echo '<p><strong>Definición:</strong></p>';
                                echo $data1['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>';
                                echo '<p>' . $data1['tratamiento'] . '</p>';
                                echo '<p><strong>Perfil en la prueba: ' . $data1['perfil'] . '</strong></p>';
                                //echo '<p><strong>Perfil en la prueba: </strong>'.$fnl[0]['ci'].'</p>';
                            }
                        }
                    } elseif ($list[$l]["id_prueba"] == 2) {
                        //PERSONALIDAD 1
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av2 = new Pruebas();
                        $avance2 = $av->fin_prueba($idDetalle, 2);
                        if ($avance2[0]["Total"] == 11) {
                            $r2 = new Reporte();
                            $smp02 = $r2->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($smp02);
                            for ($i = 0; $i < sizeof($smp02); $i++) {
                                $int2 = new Reporte();
                                $int = $int2->perfil_smp02($smp02[$i]["id_indicador"], abs($smp02[$i]["resultado"]), $info[0]['sexo']);
                                //print_r($int);
                                echo '<p><strong>' . strtoupper($smp02[$i]["indicador"]) . '</strong>: ' . abs($smp02[$i]["resultado"]) . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>' . $int['tratamiento'];
                                echo '<p><strong>Perfil en indicador: ' . $int['perfil'] . '</strong></p>';
                            }
                            echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['smpuno'] . '</strong></p>';
                            //echo '<hr>';
                        }
                    } elseif ($list[$l]["id_prueba"] == 3) {
                        //PERSONALIDAD 2
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av3 = new Pruebas();
                        $avance3 = $av->fin_prueba($idDetalle, 3);
                        if ($avance3[0]["Total"] == 5) {
                            $r3 = new Reporte();
                            $smp03 = $r3->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($smp03);
                            for ($i = 0; $i < sizeof($smp03); $i++) {
                                $int2 = new Reporte();
                                $int = $int2->perfil_smp03($smp03[$i]["id_indicador"], abs($smp03[$i]["resultado"]));
                                //print_r($int);
                                echo '<p><strong>' . strtoupper($smp03[$i]["indicador"]) . '</strong>: ' . abs($smp03[$i]["resultado"]) . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>' . $int['tratamiento'];
                                echo '<p><strong>Perfil en indicador: ' . $int['perfil'] . '</strong></p>';
                            }
                            echo '<p><strong>Perfil en la prueba: ' . $fnl[0]['smpdos'] . '</strong></p>';
                            //echo '<hr>';
                        }
                    } elseif ($list[$l]["id_prueba"] == 4) {
                        if ($estud == "ninguno" || $estud == "preescolar" || $estud == "primaria" || $estud == "secundaria") {
                            //RAVEN
                            echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                            // $av4 = new Pruebas();
                            $avance4 = $av->fin_prueba($idDetalle, 4);
                            if ($avance4[0]["Total"] == 5) {
                                $r4 = new Reporte();
                                $raven = $r4->res_total($idDetalle, $list[$l]["id_prueba"]);
                                $datos4 = new Reporte();
                                $data4 = $datos4->perfil_raven($raven[0]['total']); //$raven[0]['total']
                                echo '<p><strong>Resultados obtenidos:</strong></p>';
                                echo '<p>El evaluado obtuvo un coeficiente intelectual de <strong>' . $data4['ci'] . '</strong> equivalente a la categoría <strong>' . $data4['categoria'] . '</strong> de acuerdo con su grupo de edad en esta escala.</p>';
                                echo '<p><strong>Definición:</strong></p>';
                                echo $data4['definicion'];
                                echo '<p><strong>Alternativas de Tratamiento:</strong></p>';
                                echo '<p>' . $data4['tratamiento'] . '</p>';
                                echo '<p><strong>Perfil en la prueba: ' . $data4['perfil'] . '</strong></p>';
                                //echo '<p><strong>Perfil en la prueba: </strong>'.$fnl[0]['ci'].'</p>';
                            }
                        }
                    } elseif ($list[$l]["id_prueba"] == 5 || $list[$l]["id_prueba"] == 6) {
                        //INTERESES APTITUDES
                        //echo "<hr><center><h5>...</h5></center>";
                        // $av5 = new Pruebas();
                        $avance5 = $av->fin_prueba($idDetalle, 5);
                        $av6 = new Pruebas();
                        $avance6 = $av6->fin_prueba($idDetalle, 6);
                        if ($avance5[0]["Total"] == 10 and $avance6[0]["Total"] == 10) {
                            $r5 = new Reporte();
                            $intereses = $r5->res_ind($idDetalle, 5);
                            //print_r($intereses);
                            $r6 = new Reporte();
                            $aptitudes = $r6->res_ind($idDetalle, 6);
                            //print_r($aptitudes);
                            require_once 'views/test/ov_result.php';
                        }
                    } elseif ($list[$l]["id_prueba"] == 7) {
                        //ANÁLISIS TRANSACCIONAL
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av7 = new Pruebas();
                        $avance7 = $av->fin_prueba($idDetalle, 7);
                        if ($avance7[0]["Total"] == 12) {
                            $r7 = new Reporte();
                            $analisis = $r7->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            for ($i = 0; $i < sizeof($analisis); $i++) {
                                $int7 = new Reporte();
                                $int = $int7->analisis($analisis[$i]["id_indicador"], $analisis[$i]["resultado"]);
                                //print_r($int);
                                echo '<p><strong>' . strtoupper($analisis[$i]["indicador"]) . '</strong>: ' . $analisis[$i]["resultado"] . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                //echo '<hr>';
                            }
                        }
                    } elseif ($list[$l]["id_prueba"] == 8) {
                        //COMPROMISO A LA ORGANIZACIÓN
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        $av8 = new Pruebas();
                        $avance8 = $av8->fin_prueba($idDetalle, 8);
                        //print_r($avance8);
                        if ($avance8[0]["Total"] == 1) {
                            $r8 = new Reporte();
                            $cultura = $r8->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($cultura);
                            $int8 = new Reporte();
                            $int = $int8->gral_test_definicion($cultura[0]["id_indicador"], $cultura[0]["resultado"]);
                            echo '<p><strong>' . strtoupper($cultura[0]["indicador"]) . '</strong>: ' . $cultura[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            //echo '<hr>';  
                        }
                    } elseif ($list[$l]["id_prueba"] == 9) {
                        //TIPO DE CULTURA ORGANIZACIONAL
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av9 = new Pruebas();
                        $avance9 = $av->fin_prueba($idDetalle, 9);
                        //print_r($avance10);
                        if ($avance9[0]["Total"] == 1) {
                            $r9 = new Reporte();
                            $cultura = $r9->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($cultura);
                            $int9 = new Reporte();
                            $int = $int9->gral_test_definicion($cultura[0]["id_indicador"], $cultura[0]["resultado"]);
                            echo '<p><strong>' . strtoupper($cultura[0]["indicador"]) . '</strong>: ' . $cultura[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            //echo '<hr>';  
                        }
                    } elseif ($list[$l]["id_prueba"] == 10) {
                        //CLIMA PARA EL CAMBIO
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av10 = new Pruebas();
                        $avance10 = $av->fin_prueba($idDetalle, 10);
                        //print_r($avance10);
                        if ($avance10[0]["Total"] == 1) {
                            $r10 = new Reporte();
                            $clima = $r10->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($clima);
                            $int10 = new Reporte();
                            $int = $int10->gral_test_definicion($clima[0]["id_indicador"], $clima[0]["resultado"]);
                            echo '<p><strong>' . strtoupper($clima[0]["indicador"]) . '</strong>: ' . $clima[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            //echo '<hr>';  
                        }
                    } elseif ($list[$l]["id_prueba"] == 11) {
                        //NIVEL DE ESCUCHA
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av11 = new Pruebas();
                        $avance11 = $av->fin_prueba($idDetalle, 11);
                        //print_r($avance11);
                        if ($avance11[0]["Total"] == 1) {
                            $r11 = new Reporte();
                            $escucha = $r11->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            //print_r($escucha);
                            $int11 = new Reporte();
                            $int = $int11->gral_test_definicion($escucha[0]["id_indicador"], $escucha[0]["resultado"]);
                            echo '<p><strong>' . strtoupper($escucha[0]["indicador"]) . '</strong>: ' . $escucha[0]["resultado"] . '</p>';
                            echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                            //echo '<hr>';  
                        }
                    } elseif ($list[$l]["id_prueba"] == 12) {
                        //MMPI
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av12 = new Pruebas();
                        $avance12 = $av->fin_prueba($idDetalle, 12);
                        if ($avance12[0]["Total"] == 13) {
                            require_once 'views/test/mmpi_result.php';
                        }
                    } elseif ($list[$l]["id_prueba"] == 13) {
                        //TEST PROYECTIVO KAREN MACHOVER
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av13 = new Pruebas();
                        $avance13 = $av->fin_prueba($idDetalle, 13);
                        if ($avance13[0]["Total"] == 16) {
                            $r13 = new Reporte();
                            $machover = $r13->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            for ($i = 0; $i < sizeof($machover); $i++) {
                                $int13 = new Reporte();
                                $int = $int13->machover($machover[$i]["id_indicador"], $machover[$i]["resultado"]);
                                //print_r($int);
                                echo '<p><strong>' . strtoupper($machover[$i]["indicador"]) . '</strong>: ' . $machover[$i]["resultado"] . '</p>';
                                echo '<p><strong>Definición:</strong></p>' . $int['definicion'];
                                //echo '<hr>';
                            }
                        }
                    } elseif ($list[$l]["id_prueba"] == 14) {
                        //GRADO DE RETROALIMENTACIÓN
                        echo "<hr><center><h5>" . $list[$l]["prueba"] . "</h5></center>";
                        // $av14 = new Pruebas();
                        $avance14 = $av->fin_prueba_op($idDetalle, 14);
                        if ($avance14[0]["Total"] == 2) {
                            $r14 = new Reporte();
                            $grado = $r14->res_ind($idDetalle, $list[$l]["id_prueba"]);
                            if ($grado[0]['resultado'] >= 6 and $grado[0]['resultado'] <= 8) {
                                echo '<p><strong>' . strtoupper($grado[0]["indicador"]) . '</strong>: ' . $grado[0]['resultado'] . '</p>';
                                echo '<p><strong>Definición:</strong></p><p>Hacen referencia a toda aquella información que devuelve el receptor al emisor sobre su propia comunicación. El sujeto posee las fortalezas necesarias para desarrollar el saber escuchar, procesar la información recibida y externar una respuesta a su entorno. Son de gran ayuda en la organización, por lo que al usar correctamente esta herramienta  se puede generar el cambio que se espera y además comprometer más explícitamente al alumno que lo recibe.</p>';
                                //echo '<hr>';
                            } else {
                                echo '<p><strong>' . strtoupper($grado[1]["indicador"]) . '</strong>: ' . $grado[1]['resultado'] . '</p>';
                                echo '<p><strong>Definición:</strong></p><p>Como receptor no tiene la capacidad para devolver información al emisor sobre su propia comunicación. El sujeto no posee las fortalezas necesarias para saber escuchar, procesar la información recibida y externar una respuesta a su entorno. Esto no es de gran ayuda en la organización, y al no usar correctamente esta herramienta  es dificil que pueda generar el cambio que se espera y además no compromete a el alumno que lo recibe.</p>';
                                //echo '<hr>';
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
                                <div class="align-self-end">
                                    Psic. Christian Zepeda Alcantara
                                </div>
                            </div>
                            <input type="hidden" name="validUsuario" value="saveObs">
                            <input type="submit" value="Enviar observaciones" class="btn btn-outline-green btn-lg btn-block">
                        </form>
                    </div>
                <?php 
                    elseif($_SESSION['idInstitucion'] != 1 && !empty($rowObservacion)): 
                ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="font-weight-bold">Observaciones</label>
                            <p><?php echo @$rowObservacion[0]['observacion']; ?></p>
                        </div>
                        <div class="form-group text-center font-weight-bold">
                            <div class="align-self-end">
                                Psic. Christian Zepeda Alcantara
                            </div>
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