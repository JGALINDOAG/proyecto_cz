<!DOCTYPE html>
<html lang="es">
<?php require_once 'views/layout/head.php'; ?>
<body>
<?php require_once 'views/layout/navtest.php'; ?>
    <section class="container pt-5">
        <div class="shadow p-3 mb-5 bg-white rounded">
        <!-- -->
            <?php
            switch ($progreso) {
                case 0:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="1">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                                <h4>SERIE I</h4>
                                <h4>INSTRUCCIONES:</h4>
                                <p>SELECCIONE LA RESPUESTA A LA PALABRA QUE COMPLETE CORRECTAMENTE LA ORACI&Oacute;N, TAL COMO MUESTRA EL EJEMPLO.</p>
                                <p>EL INICIADOR DE NUESTRA GUERRA DE INDEPENDENCIA FUE:</p>
                                <p><input type="radio" name="I" disabled>A) MORELOS</p>
                                <p><input type="radio" name="I" disabled>B) ZARAGOZA</p>
                                <p><input type="radio" name="I" disabled>C) ITURBIDE</p>
                                <p><input type="radio" name="I" disabled checked="checked">D) HIDALGO</p>
                                <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                                <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 1:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="2">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE II</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>LEA CADA CUESTI&Oacute;N Y SELECCIONE EN EL CUADRO LA RESPUESTA TAL COMO LO MUESTRA EL EJEMPLO. POR QU&Eacute; COMPRAMOS RELOJES? PORQUE:</p>
                            <p><input type="radio" name="II" disabled>A) NOS GUSTA O&Iacute;RLOS SONAR</p>
                            <p><input type="radio" name="II" disabled>B) TIENEN MANECILLAS</p>
                            <p><input type="radio" name="II" disabled checked="checked">C) NOS INDICAN LAS HORAS</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 2:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="3">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE III</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>CUANDO LAS DOS PALABRAS SIGNIFIQUEN LO MISMO (IGUAL) O LO OPUESTO SELECCIONE EN EL CUADRO QUE CORRESPONDA. COMO LO MARCA EL SIGUIENTE EJEMPLO:</p>
                            <p>TIRAR-ARROJAR</p>
                            <p><input type="radio" name="III" disabled checked="checked">IGUAL</p>
                            <p><input type="radio" name="III" disabled>OPUESTO</p>
                            <p>NORTE-SUR</p>
                            <p><input type="radio" name="3" disabled>IGUAL</p>
                            <p><input type="radio" name="3" disabled checked="checked">OPUESTO</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 3:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="4">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE IV</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>EN CADA PREGUNTA SELECCIONAR LAS DOS RESPUESTAS QUE CREA SEAN LAS CORRECTAS EN LOS CUADROS.</p>
                            <p>UN HOMBRE TIENE SIEMPRE</p>
                            <p><input type="checkbox" name="a" disabled checked="checked">A) CUERPO</p>
                            <p><input type="checkbox" name="b" disabled >B) GORRA</p>
                            <p><input type="checkbox" name="c" disabled >C) GUANTES</p>
                            <p><input type="checkbox" name="d" disabled checked="checked">D) BOCA</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 3 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 4:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="5">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE V</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>ENCUENTRE LA RESPUESTA LO M&Aacute;S PRONTO POSIBLE, SELECCIONE EL VALOR QUE CREA CONVENIENTE.</p>
                            <p>(PUEDES UTILIZAR UNA HOJA Y L&Aacute;PIZ PARA FACILITAR TUS OPERACIONES).</p>
                            <p>UNA VEZ LE&Iacute;DO, USTED TENDR&Aacute; 5 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 5:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="6">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE VI</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>DE LAS SIGUIENTES PREGUNTAS SELECCIONE SI O NO, SEG&Uacute;N LA RESPUESTA QUE CREA QUE ES LA CORRECTA. EJEMPLOS:</p>
                            <p>SE HACE EL CARB&Oacute;N DE LA MADERA?</p>
                            <p><input type="radio" name="6" disabled checked="checked">SI</p>
                            <p><input type="radio" name="6" disabled>NO</p>
                            <p>TIENEN TODOS LOS HOMBRES 1.70 METROS DE ALTURA?</p>
                            <p><input type="radio" name="VI" disabled>SI</p>
                            <p><input type="radio" name="VI" disabled checked="checked">NO</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 6:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="7">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE VII</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>DE LAS SIGUIENTES PREGUNTAS SELECCIONE EN EL CUADRO, SEG&Uacute;N LA RESPUESTA QUE CREA QUE ES LA CORRECTA.</p>
                            <p>EL O&Iacute;DO ES A O&Iacute;R COMO EL OJO ES A:</p>
                            <p><input type="radio" name="VII" disabled>A) MESA</p>
                            <p><input type="radio" name="VII" disabled checked="checked">B) VER</p>
                            <p><input type="radio" name="VII" disabled>C) MANO</p>
                            <p><input type="radio" name="VII" disabled>D) JUGAR</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 7:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="8">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE VIII</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>LAS PALABRAS DE CADA UNA DE LAS ORACIONES SIGUIENTES EST&Aacute;N MEZCLADAS, ORDENE CADA UNA DE LAS ORACIONES. SI EL SIGNIFICADO DE LA ORACI&Oacute;N ES VERDADERO, SELECCIONE EN LA LETRA &quot;V&quot;, SI EL SIGNIFICADO ES FALSO, SELECCIONE LA LETRA &quot;F&quot;. EJEMPLO:</p>
                            <p>O&Iacute;R SON LOS PARA O&Iacute;DOS</p>
                            <p><input type="radio" name="8" disabled checked="checked">VERDADERO</p>
                            <p><input type="radio" name="8" disabled>FALSO</p>
                            <p>COMER PARA P&Oacute;LVORA LA BUENA ES</p>
                            <p><input type="radio" name="VIII" disabled>VERDADERO</p>
                            <p><input type="radio" name="VIII" disabled checked="checked">FALSO</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 3 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 8:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="9">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE IX</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>SELECCIONE EN EL CUADRO A LA PALABRA QUE CREA NO CORRESPONDE CON LAS DEM&Aacute;S DEL RENGL&Oacute;N. EJEMPLO:</p>
                            <p><input type="radio" name="IX" disabled>A) BALA</p>
                            <p><input type="radio" name="IX" disabled>B) CA&Ntilde;&Oacute;N</p>
                            <p><input type="radio" name="IX" disabled>C) PISTOLA</p>
                            <p><input type="radio" name="IX" disabled>D) ESPADA</p>
                            <p><input type="radio" name="IX" disabled checked="checked">E) L&Aacute;PIZ</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 2 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 9:
                    ?>
                    <form action="<?php echo $envia; ?>" method="post">
                    <input type="hidden" name="serie" value="10">
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>SERIE X</h4>
                            <h4>INSTRUCCIONES:</h4>
                            <p>PROCURA ENCONTRAR C&Oacute;MO EST&Aacute;N HECHAS LAS SERIES; DESPU&Eacute;S SELECCIONA EL CUADRO A LA RESPUESTA DE LOS N&Uacute;MEROS QUE DEBAN SEGUIR EN CADA SERIE.</p>
                            <p>EJEMPLO: 5,10,15,20</p>
                            <p><input type="radio" name="X" disabled>A) 30 &ndash; 35</p>
                            <p><input type="radio" name="X" disabled checked="checked">B) 25 &ndash; 30</p>
                            <p><input type="radio" name="X" disabled>C) 10 &ndash; 15</p>
                            <p><input type="radio" name="X" disabled>C) 5 &ndash; 10</p>
                            <p>UNA VEZ LE&Iacute;DO EL EJEMPLO, USTED TENDR&Aacute; 4 MINUTOS PARA RESPONDER LOS SIGUIENTES REACTIVOS DESPU&Eacute;S DE PULSAR EL BOT&Oacute;N DE CONTINUAR.</p>
                            <center><input type="submit" class="btn btn-outline-green btn-lg btn-block" value="CONTINUAR"></center>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php
                    break;
                case 10:
                    $r1 = new Reporte();
                    $terman = $r1->res_total($idDetalle,1);
                    $datos1 = new Reporte();
                    $data1 = $datos1->perfil_terman($terman[0]['total']);
                    $perfil=$data1['perfil'];
                    $test='ci';
                    $addperfil = new Reporte();
                    $addperfil->perfil_test($test,$perfil,$idDetalle);

                    $getfinal = new Reporte();
                    $perfilfinal = $getfinal->perfil_final($idDetalle);
                    if($perfilfinal>0){
                        $addperfil = new Reporte();
                        $addperfil->perfil_test($test='final',$perfilfinal,$idDetalle);
                    }
                    ?>
                    <div class="form-group row d-flex text-center justify-content-center pt-3 pb-3">
                        <div class="media d-flex align-items-center">
                            <div class="media-body">
                            <h4>HA CONCLUIDO SATISFACTORIAMENTE LA PRUEBA DE TERMAN.</h4>
                            <h3>PULSE <a href="<?php echo 'index.php?accion=Tests'; ?>">AQUÍ</a> PARA REGRESAR AL MENÚ DE PRUEBAS.</h3>
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