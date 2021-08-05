<?php
$idDetalle=$_SESSION["idDetalle"];
$id_prueba=3;
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba);
if ($avance[0]["Total"] == 5) {
    /**/
    require_once("models/reporte.php");
    $r3 = new Reporte();
    $smp03 = $r3->res_ind($idDetalle,$id_prueba);
    $pila = array();
    for ($i=0; $i<sizeof($smp03); $i++) {
        $int2 = new Reporte();
        $int = $int2->perfil_smp03($smp03[$i]["id_indicador"],abs($smp03[$i]["resultado"]));
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
    $test='smpdos';
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
require_once("views/test/personalidad_dos_ej.php");
?>