<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($idDetalle,$id_prueba=4);
if ($avance[0]["Total"] == 5) {
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
}
require_once("views/test/raven_ej.php");
?>