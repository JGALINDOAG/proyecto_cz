<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba=8);
if ($avance[0]["Total"] == 1) {
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
}
require_once("views/test/compromiso_ej.php");
?>