<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$id_prueba=7;
$limit=30;
$sum="";
$t = new Pruebas();
//Lista de las preguntas que aún no ha respondido la persona para la prueba en el día actual
$preguntas = $t->ultima_prg($idDetalle,$id_prueba,$limit);

//Si el usuario envió respuestas se guardan y se hace una redirección a la prueba para continuar
if (isset($_POST["save"])) {
    // while ($POST = each($_POST)) { $POST[0] => key, $POST[1] => item
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
    header("Location: index.php?accion=Analisis");
}

//Si el usuario ha respondido todas las peguntas se procesa su resultado
if (empty($preguntas)) {
    //Calculo por indicador mediante las respuestas almacenadas
    $resultados = $t->suma_prueba($idDetalle,$id_prueba,$sum);
    for ($i = 0; $i < sizeof($resultados); $i++) {
        $no = new Pruebas();
        $total=$no->valida_duplicado_resultados($idDetalle,$resultados[$i]["id_indicador"], $id_prueba);
        if($total[0]['COUNT(*)']==0){
            //Se almacena el resultado obtenido por indicador a la tabla "resultados"
            $obj = new Pruebas();
            $obj->add_resultados($idDetalle,$resultados[$i]["id_indicador"], $resultados[$i]["Result"], $id_prueba, $escala=NULL);
        }
    }
    //Una vez resguardado el resultado final de esta prueba se eliminan las respuestas del usuario en la tabla "respuestas"
    $t->delete_respuestas($idDetalle,$id_prueba);
    header("Location: index.php?accion=AnalisisEj");
} else {
    require_once("views/test/analisis.php");
}
?>