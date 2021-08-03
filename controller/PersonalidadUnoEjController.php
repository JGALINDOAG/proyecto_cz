<?php
$idDetalle=$_SESSION["idDetalle"];
$id_prueba=2;
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba);
if ($avance[0]["Total"] == 11) {
    /**/
    require_once("models/reporte.php");
    $r2 = new Reporte();
    $smp02 = $r2->res_ind($idDetalle,$id_prueba);
    $sex = new Pruebas();
    $info = $sex->info_persona($idDetalle);
    $pila = array();
    for ($i=0; $i<sizeof($smp02); $i++) {
        $int2 = new Reporte();
        $int = $int2->perfil_smp02($smp02[$i]["id_indicador"],abs($smp02[$i]["resultado"]),$info[0]['sexo']);
        array_push($pila, $int['perfil']);
    }
    rsort($pila);
    //print_r($pila);
    if (in_array(3,$pila)) {
        $perfil=3;
    }elseif(in_array(2,$pila)){
        $perfil=2;
    }elseif(in_array(1,$pila)){
        $perfil=1;
    }
    $test='smpuno';
    $addperfil = new Reporte();
    $addperfil->perfil_test($test,$perfil,$idDetalle);

    $getfinal = new Reporte();
    $perfilfinal = $getfinal->perfil_final($idDetalle);
    if($perfilfinal>0){
        $addperfil = new Reporte();
        $addperfil->perfil_test($test='final',$perfilfinal,$idDetalle);
    }
    /**/
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
}
require_once("views/test/personalidad_uno_ej.php");
?>