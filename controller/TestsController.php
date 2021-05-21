<?php 
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas($idDetalle);
//print_r($activo);
$obj = new Pruebas ();
$list = $obj->list_pruebas_persona($idDetalle);
//print_r($list);
if (isset($_POST["select_test"]) and $_POST["select_test"] == "ok") {
    if (isset($_POST["TERMAN"])) {
        header("Location: index.php?accion=TermanEj");
    }elseif (isset($_POST["PERSONALIDAD1"])) {
        header("Location: index.php?accion=PersonalidadUnoEj");
    }elseif (isset($_POST["PERSONALIDAD2"])) {
        header("Location: index.php?accion=PersonalidadDosEj");
    }elseif (isset($_POST["RAVEN"])) {
        header("Location: index.php?accion=RavenEj");
    }elseif (isset($_POST["INTERESES"])) {
        header("Location: index.php?accion=InteresesEj");
    }elseif (isset($_POST["APTITUDES"])) {
        header("Location: index.php?accion=AptitudesEj");
    }elseif (isset($_POST["MMPI"])) {
        header("Location: index.php?accion=mmpiEj");
    }elseif (isset($_POST["ANÁLISISTRANSACCIONAL"])) {
        header("Location: index.php?accion=AnalisisEj");
    }elseif (isset($_POST["NIVELDEESCUCHA"])) {
        header("Location: index.php?accion=EscuchaEj");
    }elseif (isset($_POST["COMPROMISOALAORGANIZACIÓN"])) {
        header("Location: index.php?accion=CompromisoEj");
    }elseif (isset($_POST["TIPODECULTURAORGANIZACIONAL"])) {
        header("Location: index.php?accion=CulturaEj");
    }elseif (isset($_POST["CLIMAPARAELCAMBIO"])) {
        header("Location: index.php?accion=ClimaEj");
    }elseif (isset($_POST["TESTPROYECTIVOKARENMACHOVER"])) {
        header("Location: index.php?accion=Machover");
    }elseif (isset($_POST["GRADODERETROALIMENTACIÓN"])) {
        header("Location: index.php?accion=RetroalimentacionEj");
    }
}
require_once("views/test/test.php");
?>