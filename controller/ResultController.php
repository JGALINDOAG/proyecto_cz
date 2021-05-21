<?php 
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas($idDetalle);
$obj = new Pruebas ();
$list = $obj->list_pruebas_persona($idDetalle);
require_once("Views/test/resultados.php");
?>