<?php 
//$idDetalle=2;
$idDetalle=$_GET["idDetalle"];
require_once("models/pruebas.php");
require_once("models/observacion_resultado.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas($idDetalle);
$obj = new Pruebas ();
$list = $obj->list_pruebas_persona($idDetalle);
$sex = new Pruebas();
$info = $sex->info_persona($idDetalle);

$objObservacion = new ObservacionResultado();
$rowObservacion = $objObservacion->valid_observacion_resultado($idDetalle);
// print_r($rowObservacion);

if (isset($_POST['validUsuario']) == 'saveObs'):
    $objObservacion = new ObservacionResultado();
    if(empty($rowObservacion)):
        $objObservacion->add_observacion_resultado($idDetalle, $_POST['textObservacion']);
        $number = 1;
    else:
        $objObservacion->update_observacion_resultado($rowObservacion[0]['id_observacion'], $_POST['textObservacion']);
        $number = 2;
    endif;
    header("Location: ".AccesoDatos::ruta()."?accion=Result&idDetalle=".$idDetalle."&m=".AccesoDatos::encriptar($number));
endif;


require_once("views/resultados/resultados.php");
?>