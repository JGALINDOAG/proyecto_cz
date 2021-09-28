<?php 
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas($idDetalle);
//print_r($activo);
$obj = new Pruebas ();
$list = $obj->list_pruebas_persona($idDetalle);
//print_r($list);
$sex = new Pruebas();
$info = $sex->info_persona($idDetalle);
$estud=$info[0]['grado_estudios'];

if (isset($_POST["costo"])){
    require_once("models/personas.php");
    $up = new Personas();
    $up->update_costo($_POST["costo"],$idDetalle);
}
if (isset($_POST["select_test"]) and $_POST["select_test"] == "ok") {
    if (isset($_POST["1"])) {
        header("Location: index.php?accion=TermanEj");
    }elseif (isset($_POST["2"])) {
        header("Location: index.php?accion=PersonalidadUnoEj");
    }elseif (isset($_POST["3"])) {
        header("Location: index.php?accion=PersonalidadDosEj");
    }elseif (isset($_POST["4"])) {
        header("Location: index.php?accion=RavenEj");
    }elseif (isset($_POST["5"])) {
        header("Location: index.php?accion=InteresesEj");
    }elseif (isset($_POST["6"])) {
        header("Location: index.php?accion=AptitudesEj");
    }elseif (isset($_POST["7"])) {
        header("Location: index.php?accion=AnalisisEj");
    }elseif (isset($_POST["8"])) {
        header("Location: index.php?accion=CompromisoEj");
    }elseif (isset($_POST["9"])) {
        header("Location: index.php?accion=CulturaEj");
    }elseif (isset($_POST["10"])) {
        header("Location: index.php?accion=ClimaEj");
    }elseif (isset($_POST["11"])) {
        header("Location: index.php?accion=EscuchaEj");
    }elseif (isset($_POST["12"])) {
        header("Location: index.php?accion=mmpiEj");
    }elseif (isset($_POST["13"])) {
        header("Location: index.php?accion=Machover");
    }elseif (isset($_POST["14"])) {
        header("Location: index.php?accion=RetroalimentacionEj");
    }
}
require_once("views/test/test.php");
?>