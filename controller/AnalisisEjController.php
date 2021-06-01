<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba=7);
if ($avance[0]["Total"] == 12) {
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
}
require_once("views/test/analisis_ej.php");
?>