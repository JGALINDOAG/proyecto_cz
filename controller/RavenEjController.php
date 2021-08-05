<?php
$idDetalle=$_SESSION["idDetalle"];
$id_prueba=4;
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba);
if ($avance[0]["Total"] == 5) {
    /**/
    require_once("models/reporte.php");
    $r4 = new Reporte();
    $raven = $r4->res_total($idDetalle,$id_prueba);
    $datos4 = new Reporte();
    $data4 = $datos4->perfil_raven($raven[0]['total']);
    $perfil=$data4['perfil'];
    $test='ci';
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
require_once("views/test/raven_ej.php");
?>