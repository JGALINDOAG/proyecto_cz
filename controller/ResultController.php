<?php 
//$idDetalle=11;
$idDetalle=$_GET["idDetalle"];
require_once("models/pruebas.php");
$obj_pruebas = new Pruebas();
require_once("models/reporte.php");
$obj_reporte = new Reporte();
require_once("models/observacion_resultado.php");
$activo = $obj_pruebas->activo_detalle_personas($idDetalle);
$list = $obj_pruebas->list_pruebas_persona($idDetalle);
$info = $obj_pruebas->info_persona($idDetalle);

$objObservacion = new ObservacionResultado();
$rowObservacion = $objObservacion->valid_observacion_resultado($idDetalle);
// print_r($rowObservacion);

if (isset($_POST['validUsuario']) == 'saveObs'):
    $objObservacion = new ObservacionResultado();
    $dataPsicol = 0;
    if(!empty($_POST['dataPsicol'])) $dataPsicol = 1;
    if(empty($rowObservacion)):
        $objObservacion->add_observacion_resultado($idDetalle, $_POST['textObservacion'], $dataPsicol);
        $number = 1;
    else:
        $objObservacion->update_observacion_resultado($rowObservacion[0]['id_observacion'], $_POST['textObservacion'], $dataPsicol);
        $number = 2;
    endif;
    header("Location: ".AccesoDatos::ruta()."?accion=Result&idDetalle=".$idDetalle."&m=".AccesoDatos::encriptar($number));
endif;


require_once("views/resultados/resultados.php");
?>