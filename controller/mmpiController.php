<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$id_prueba=12;
$limit=30;
//$sum="-10";
$t = new Pruebas();
//Lista de las preguntas que aún no ha respondido la persona para la prueba en el día actual
$preguntas = $t->ultima_prg($idDetalle,$id_prueba,$limit);

//Si el usuario envió respuestas se guardan y se hace una redirección a la prueba para continuar
if (isset($_POST["save"])) {
    foreach($_POST as $key => $item) {
        if ($key != 'save') {
            $no = new Pruebas();
            $total=$no->valida_duplicado_respuesta($idDetalle,$key);
            if($total[0]['COUNT(*)']==0){
                //Registra las respuestas del usuario
                $t->add_respuesta($idDetalle,$key, $item);
            }
        }
    }
    header("Location: index.php?accion=mmpi");
}


//Si el usuario ha respondido todas las peguntas se procesa su resultado
if (empty($preguntas)) {
    # # # # # L # # # # #
    $id_indicador=69;
    //RESULT
    $L = new Pruebas();
    $resL = $L->mmpi_ind($idDetalle,$valorOp=0,$id_indicador,$valorInd=0);
    $L_total=$resL[0]['total'];#
    //ESCALA
    $L_ESC = new Pruebas();
    $res_L_ESC=$L_ESC->mmpi_ind_esc($idDetalle,$indicador='L',$L_total);
    $L_escala=$res_L_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $L_total, $id_prueba, $L_escala);
        }
    # # # # # F # # # # #
    $id_indicador=70;
    //RESULT
    $F = new Pruebas();
    $resF = $F->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $F_total=$resF[0]['total'];#
    //ESCALA
    if($F_total >= 16)
    {
        $F_escala=90;#
    }else{
        $F_ESC = new Pruebas();
        $res_F_ESC=$F_ESC->mmpi_ind_esc($idDetalle,$indicador='F',$F_total);
        $F_escala=$res_F_ESC[0]['escala'];#
    }
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $F_total, $id_prueba, $F_escala);
        }
    # # # # # K # # # # #
    $id_indicador=71;
    //RESULT
    $K = new Pruebas();
    $resK = $K->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $K_total=$resK[0]['total'];#
    //ESCALA
    $K_ESC = new Pruebas();
        $res_K_ESC=$K_ESC->mmpi_ind_esc($idDetalle,$indicador='K',$K_total);
        $K_escala=$res_K_ESC[0]['escala'];#
    
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $K_total, $id_prueba, $K_escala);
        }
    # # # # # HS # # # # #
    $id_indicador=72;
    //RESULT
    $HS = new Pruebas();
    $resHS = $HS->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    //FRAC_K
    $f='f5';
    $FK = new Pruebas();
    $resFK = $FK->frac_k($f,$K_total);
    $HS_total=$resHS[0]['total']+$resFK[0][$f]; #
    //ESCALA
    $HS_ESC = new Pruebas();
        $res_HS_ESC=$HS_ESC->mmpi_ind_esc($idDetalle,$indicador='HS',$HS_total);
        $HS_escala=$res_HS_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $HS_total, $id_prueba, $HS_escala);
        }
    
    # # # # # 2-D # # # # #
    $id_indicador=73;
    //RESULT
    $dosD = new Pruebas();
    $resdosD = $dosD->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $dosD_total=$resdosD[0]['total']; #
    //ESCALA
    $dosD_ESC = new Pruebas();
        $res_dosD_ESC=$dosD_ESC->mmpi_ind_esc($idDetalle,$indicador='2-D',$dosD_total);
        $dosD_escala=$res_dosD_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $dosD_total, $id_prueba, $dosD_escala);
        }

    # # # # # 3-HI # # # # #
    $id_indicador=74;
    //RESULT
    $tresHI = new Pruebas();
    $restresHI = $tresHI->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $tresHI_total=$restresHI[0]['total']; #
    //ESCALA
    $tresHI_ESC = new Pruebas();
        $res_tresHI_ESC=$tresHI_ESC->mmpi_ind_esc($idDetalle,$indicador='3-HI',$tresHI_total);
        $tresHI_escala=$res_tresHI_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $tresHI_total, $id_prueba, $tresHI_escala);
        }

    # # # # # '4-DP' # # # # #
    $id_indicador=75;
    //RESULT
    $cuatroDP = new Pruebas();
    $rescuatroDP = $cuatroDP->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    //FRAC_K
    $f='f4';
    $FK = new Pruebas();
    $resFK = $FK->frac_k($f,$K_total);
    $cuatroDP_total=$rescuatroDP[0]['total']+$resFK[0][$f]; #
    //ESCALA
    $cuatroDP_ESC = new Pruebas();
        $res_cuatroDP_ESC=$cuatroDP_ESC->mmpi_ind_esc($idDetalle,$indicador='4-DP',$cuatroDP_total);
        $cuatroDP_escala=$res_cuatroDP_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $cuatroDP_total, $id_prueba, $cuatroDP_escala);
        }

    # # # # # '5-MF' # # # # #
    $sex = new Pruebas();
    $sexo = $sex->info_persona($idDetalle);
    if($sexo[0]['sexo']=='H'){
        $id_indicador=76;
    }elseif($sexo[0]['sexo']=='M'){
        $id_indicador=77;
    }
    //RESULT
    $MF = new Pruebas();
    $resMF = $MF->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $MF_total=$resMF[0]['total']; #
    //ESCALA
    $MF_ESC = new Pruebas();
        $res_MF_ESC=$MF_ESC->mmpi_ind_esc($idDetalle,$indicador='5-MF',$MF_total);
        $MF_escala=$res_MF_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $MF_total, $id_prueba, $MF_escala);
        }

    # # # # # '6-PA' # # # # #
    $id_indicador=78;
    //RESULT
    $seisPA = new Pruebas();
    $resseisPA = $seisPA->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $seisPA_total=$resseisPA[0]['total']; #
    //ESCALA
    $seisPA_ESC = new Pruebas();
        $res_seisPA_ESC=$seisPA_ESC->mmpi_ind_esc($idDetalle,$indicador='6-PA',$seisPA_total);
        $seisPA_escala=$res_seisPA_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $seisPA_total, $id_prueba, $seisPA_escala);
        }

    # # # # # '7-PT' # # # # #
    $id_indicador=79;
    //RESULT
    $sietePT = new Pruebas();
    $ressietePT = $sietePT->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $sietePT_total=$ressietePT[0]['total']+$K_total; #
    //ESCALA
    $sietePT_ESC = new Pruebas();
        $res_sietePT_ESC=$sietePT_ESC->mmpi_ind_esc($idDetalle,$indicador='7-PT',$sietePT_total);
        $sietePT_escala=$res_sietePT_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $sietePT_total, $id_prueba, $sietePT_escala);
        }

    # # # # # '8-ES' # # # # #
    $id_indicador=80;
    //RESULT
    $ochoES = new Pruebas();
    $resochoES = $ochoES->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $ochoES_total=$resochoES[0]['total']+$K_total; #
    //ESCALA
    $ochoES_ESC = new Pruebas();
        $res_ochoES_ESC=$ochoES_ESC->mmpi_ind_esc($idDetalle,$indicador='8-ES',$ochoES_total);
        $ochoES_escala=$res_ochoES_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $ochoES_total, $id_prueba, $ochoES_escala);
        }

    # # # # # '9-MA' # # # # #
    $id_indicador=81;
    //RESULT
    $nueveMA = new Pruebas();
    $resnueveMA = $nueveMA->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    //FRAC_K
    $f='f2';
    $FK = new Pruebas();
    $resFK = $FK->frac_k($f,$K_total);
    $nueveMA_total=$resnueveMA[0]['total']+$resFK[0][$f]; #
    //ESCALA
    $nueveMA_ESC = new Pruebas();
        $res_nueveMA_ESC=$nueveMA_ESC->mmpi_ind_esc($idDetalle,$indicador='9-MA',$nueveMA_total);
        $nueveMA_escala=$res_nueveMA_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $nueveMA_total, $id_prueba, $nueveMA_escala);
        }

    # # # # # '0-LS' # # # # #
    $id_indicador=82;
    //RESULT
    $ceroLS = new Pruebas();
    $resceroLS = $ceroLS->mmpi_ind_suma($idDetalle,$cero=0,$id_indicador,$uno=1);
    $ceroLS_total=$resceroLS[0]['total']; #
    //ESCALA
    $ceroLS_ESC = new Pruebas();
        $res_ceroLS_ESC=$ceroLS_ESC->mmpi_ind_esc($idDetalle,$indicador='0-LS',$ceroLS_total);
        $ceroLS_escala=$res_ceroLS_ESC[0]['escala'];#
    $no = new Pruebas();
    $total=$no->valida_duplicado_resultados($idDetalle,$id_indicador, $id_prueba);
        if($total[0]['COUNT(*)']==0){
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$id_indicador, $ceroLS_total, $id_prueba, $ceroLS_escala);
        }
    //Una vez resguardado el resultado final de esta prueba se eliminan las respuestas del usuario en la tabla "respuestas"
    $t->delete_respuestas($idDetalle,$id_prueba);
    header("Location: index.php?accion=mmpiEj");

} else {
    require_once("views/test/mmpi.php");
}
?>
