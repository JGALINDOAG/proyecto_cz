<?php 
$idDetalle=$_GET["idDetalle"];//POST['id_detalle'];
require_once("models/pruebas.php");
$id_prueba=13;
//Valida si el usuario ya termino la prueba en el día actual
$u = new Pruebas();
$avance = $u->fin_prueba($idDetalle,$id_prueba);
if ($avance[0]["Total"] == 16) {
    $progreso = 'Finalizo';
} else {
    $progreso = 'Progreso';
    $t = new Pruebas();
    //Lista de las preguntas que aún no ha respondido la persona para la prueba en el día actual
    $preguntas = $t->ultima_prg($idDetalle,$id_prueba,$limit=100);
}

if (isset($_POST["save"])) {
    foreach($_POST as $key => $item) {
        if ($key != 'save') {
            $no = new Pruebas();
            $total=$no->valida_duplicado_respuesta($idDetalle,$key);
            if($total[0]['COUNT(*)']==0){
                //Registra las respuestas del usuario
                $t->add_respuesta($idDetalle,$key, $item);
            }
        }
    }
    foreach($_POST as $key => $item) {
        if ($key != 'save') {
            $no = new Pruebas();
            $total=$no->valida_duplicado_respuesta($idDetalle,$key);
            if($total[0]['COUNT(*)']==0){
                //Registra las respuestas del usuario
                $t->add_respuesta($idDetalle,$key, $item);
            }
        }
    }
    $ss = new Pruebas();
    $resultados = $ss->suma_prueba($idDetalle,$id_prueba,$sum="");
    for ($i = 0; $i < sizeof($resultados); $i++) {
        $resu = new Pruebas();
        $total=$resu->valida_duplicado_resultados($idDetalle,$resultados[$i]["id_indicador"], $id_prueba);
        //echo $resultados[$i]["id_indicador"].'-'.$resultados[$i]["Result"].'-'.$total[0]['COUNT(*)'].'<br>';
        if($total[0]['COUNT(*)']==0){
            //Se almacena el resultado obtenido por indicador a la tabla "resultados"
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$resultados[$i]["id_indicador"], $resultados[$i]["Result"], $id_prueba, $escala=NULL);
        }
    }
    $d = new Pruebas();
    $d->delete_respuestas($idDetalle,$id_prueba);
}

require_once("views/test/machover.php");
?>