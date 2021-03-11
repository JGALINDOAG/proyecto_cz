<?php 
require_once("models/pruebas.php");
$objactivo = new Pruebas();
$activo = $objactivo->activo_detalle_personas();
//print_r($activo);
$obj = new Pruebas ();
$list = $obj->list_pruebas();
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
    }
}
require_once("views/test/test.php");
?>