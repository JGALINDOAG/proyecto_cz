<?php 
$idDetalle=$_GET["idDetalle"];
require_once("models/pruebas.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas($idDetalle);
$obj = new Pruebas ();
$list = $obj->list_pruebas_persona($idDetalle);
$sex = new Pruebas();
$info = $sex->info_persona($idDetalle);
require_once("views/resultados/resultados.php");
?>