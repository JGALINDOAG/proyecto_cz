<?php
$idDetalle=$_SESSION["idDetalle"];
require_once("models/pruebas.php");
$id_prueba=5;
$limit=20;
$sum="*24/5.75";
$t = new Pruebas();
//Lista de las preguntas que aún no ha respondido la persona para la prueba en el día actual
$preguntas = $t->ultima_prg($idDetalle,$id_prueba,$limit);

//Si el usuario envió respuestas se guardan y se hace una redirección a la prueba para continuar
if (isset($_POST["save"])) {
    while ($POST = each($_POST)) {
        if ($POST[0] != 'save') {
            $no = new Pruebas();
            $total=$no->valida_duplicado_respuesta($idDetalle,$POST[0]);
            if($total[0]['COUNT(*)']==0){
                //Registra las respuestas del usuario
                $t->add_respuesta($idDetalle,$POST[0], $POST[1]);
            }
        }
    }
    header("Location: index.php?accion=Intereses");
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
    header("Location: index.php?accion=InteresesEj");
} else {
    require_once("views/test/intereses.php");
}
?>