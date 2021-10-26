<?php 
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$obj_pruebas = new Pruebas();
require_once("models/reporte.php");
$obj_reporte = new Reporte();
require_once("models/observacion_resultado.php");
$activo = $obj_pruebas->activo_detalle_personas($idDetalle);
$list = $obj_pruebas->list_pruebas_persona($idDetalle);
$info = $obj_pruebas->info_persona($idDetalle);
require_once("views/resultados/resultadosSesion.php");
?>