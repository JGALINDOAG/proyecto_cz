<?php
require_once("models/pruebas.php");
$id_prueba=1;
//El post viene de la vista terman_ej.php para mostrar la serie en curso
if (isset($_POST["serie"])) {
    $serie = $_POST["serie"];
    //Depende de la serie que se mostrara se ocultara los radio button ó checkbox en un rango de tiempo de 2, 3, 4 o 5 minutos
    if ($serie == 1 || $serie == 2 || $serie == 3 || $serie == 6 || $serie == 7 || $serie == 9) {
        $time = "javascript:dosMin()";
    }
    if ($serie == 4 || $serie == 8) {
        $time = "javascript:tresMin()";
    }
    if ($serie == 10) {
        $time = "javascript:cuatroMin()";
    }
    if ($serie == 5) {
        $time = "javascript:cincoMin()";
    }
    for ($s = 1; $s < 11; $s++) {
        if ($serie == $s) {
            $t = new Pruebas();
            ///Muestra las preguntas correspondientes a un indicador o serie
            $preguntas = $t->preguntas_por_serie($s);
            require_once("Views/test/terman.php");
        }
    }
    //El post viene de la vista terman.php para mostrar la serie en curso
} elseif (isset($_POST["save"])) {
    //Se da un punto por cada respuesta correcta y cero puntos si la respuesta es incorrecta o está en blanco.
    //En las series 2, 5 y 10 el número de aciertos se multiplica por dos para lograr el cómputo parcial.
    //En las series 3, 6 y 8 se resta al total de aciertos el número de respuestas incorrectas.
    //Cuando se piden dos respuestas en cada pregunta, el puntaje es un punto por cada reactivo completo, es decir, se dará un punto sólo si las DOS respuestas son correctas. No existen medios puntos.
    $serie = $_POST["save"];
    //El siguiente ciclo agrupa todas las opciones que el usuario respondió en una variable global llamada “contesto”, 
    //para posteriormente incrustarla en una consulta de MySQL
    $contesto = "";
    $count = count($_POST);
    $cuenta = 0;
    while ($POST = each($_POST)) {
        $cuenta++;
        if ($POST[0] != 'save') {
            if ($count != $cuenta) {
                $coma = ",";
            } else {
                $coma = "";
            }
            $contesto = $contesto . $POST[1] . $coma;
        }
    }
    if (!empty($contesto)) {
        if ($serie == 1 || $serie == 3 || $serie == 6 || $serie == 7 || $serie == 8 || $serie == 9) {
            $string = new Pruebas();
            //Realiza una suma acorde al valor de las opciones que recibe la consulta, esto no afecta a las series 3, 6 y 8 debido a sus valores positivos y negativos 
            $resultado = $string->suma($contesto);
            $result = $resultado[0]["total"];
            //Se almacena el resultado obtenido por indicador a la tabla "resultados"
            $no = new Pruebas();
            $total=$no->valida_duplicado_resultados($serie, $id_prueba);
            if($total[0]['COUNT(*)']==0){
                //Se almacena el resultado obtenido por indicador a la tabla "resultados"
                $obj = new Pruebas();
                $obj->add_resultados($serie, $result, $id_prueba);
            }
        }
        if ($serie == 2 || $serie == 5 || $serie == 10) {
            $string = new Pruebas();
            //Realiza una suma multiplicada por 2 acorde al valor de las opciones que recibe la consulta.
            $resultado = $string->sumaX2($contesto);
            $result = $resultado[0]["total"];
            $no = new Pruebas();
            $total=$no->valida_duplicado_resultados($serie, $id_prueba);
            if($total[0]['COUNT(*)']==0){
                //Se almacena el resultado obtenido por indicador a la tabla "resultados"
                $obj = new Pruebas();
                $obj->add_resultados($serie, $result, $id_prueba);
            }
        }
        if ($serie == 4) {
            $string = new Pruebas();
            //De las opciones que recibe la consulta obtiene únicamente aquellas que solo marcaron 2 casillas y que las opciones sean las dos correctas para posteriormente realizar la suma en el controlador
            $resultado = $string->sumaS4($contesto);
            $res=0;
            for ($i = 0; $i < sizeof($resultado); $i++) {
                $res += $resultado[$i]["resultadoPorPregunta"];
                }
            $result=$res/2;
            $no = new Pruebas();
            $total=$no->valida_duplicado_resultados($serie, $id_prueba);
            if($total[0]['COUNT(*)']==0){
                //Se almacena el resultado obtenido por indicador a la tabla "resultados"
                $obj = new Pruebas();
                $obj->add_resultados($serie, $result, $id_prueba);
            }
        }
    }
    $contesto = "";
    header("Location: index.php?accion=TermanEj");
} else {
    header("Location: index.php?accion=TermanEj");
}
?>

