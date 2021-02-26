<?php
require_once("models/Pruebas.php");
$u = new Pruebas();
//Valida si el usuario ya termino la prueba en el día actual
$avance = $u->fin_prueba($id_prueba=2);
if ($avance[0]["Total"] == 11) {
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
}
require_once("views/test/personalidad_uno_ej.php");
?>