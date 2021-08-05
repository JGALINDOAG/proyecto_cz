<?php 
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
require_once("models/reporte.php");
$u = new Pruebas();
// Obtiene el último indicador registrado en la base de datos para la prueba de inteligencia mediante el usuario y la fecha actual, 
// para saber cuál es la próxima serie que le sistema debe mostrar o dar por finalizada la prueba.
$avance = $u->avance_terman($idDetalle);
//print_r($avance);

$progreso = $avance[0]["id_indicador"];

if (empty($progreso)) {
    $progreso = 0;
}
// Ruta al controlador de la prueba
$envia = 'index.php?accion=Terman';
require_once("views/test/terman_ej.php");

?>