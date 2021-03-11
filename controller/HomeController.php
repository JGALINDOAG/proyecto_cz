<?php
//Valida la existencia un post desde la vista para ejecutar el proceso, de lo contrario muestra la vista. 
if (isset($_POST["personal"]) and $_POST["personal"] == "ok") {
    require_once("models/personas.php");
    $nombre = strtoupper($_POST["nom"]);
    $primer_apellido = strtoupper($_POST["ap1"]);
    $segundo_apellido = strtoupper($_POST["ap2"]);
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $grado_estudios = $_POST["grado_estudios"];
    $id_folio = strtolower($_POST["folio"]);
    $get=new Personas();
    $result=$get->verifica_idfolio($id_folio);
    if($result[0]['valor'] == 0){
        header("Location: index.php?accion=Home");
    }else{
        if (empty($_POST["area"]) or empty($_POST["turno"])) {
            $area = null;
            $turno = null;
          }else{
            $area = $_POST["area"];
            $turno = $_POST["turno"];
          }
        $nodoblepersona = new Personas();
        //Valida si la persona existe en la base de datos mediante el correo para evitar insertarla de nuevo.
        $existepersona = $nodoblepersona->get_personas_email($email);
        //print_r($existepersona);
        /**/
        if ($existepersona[0] == 0) {

            $addident = new Personas();
            //Función para agregar a la persona
            $addident->add_persona($nombre, $primer_apellido, $segundo_apellido, $email, $sexo, $fecha_nacimiento, $grado_estudios, $area, $turno);
            //Una vez insertado en la base de datos se vuelve a consultar para obtener su Id_persona
            $ahoraExiste = $addident->get_personas_email($email);

            $max = new Personas();
            $ultimo = $max->max_persona();
            $idadd=$ultimo[0]['Id_persona'];

            $nodobledetalle = new Personas();
            $existedetalle = $nodobledetalle->get_detalle($idadd, $id_folio);
            //print_r($existedetalle);
            if ($existedetalle[0] == 0) {
                $objDetalle = new Personas();
                $objDetalle->add_detalle($idadd, $id_folio);
            }
            //
            $infodetalle = new Personas();
            $sesion = $infodetalle->get_detalle($idadd, $id_folio);
            //print_r($sesion);
            $_SESSION["idAdmin"] = $sesion[1]['id_detalle'];
            header("Location: index.php?accion=Tests");
        } else {
            $idadd=$existepersona[1]['Id_persona'];
            $nodobledetalle = new Personas();
            $existedetalle = $nodobledetalle->get_detalle($idadd, $id_folio);
            //print_r($existedetalle);
            if ($existedetalle[0] == 0) {
                $objDetalle = new Personas();
                $objDetalle->add_detalle($idadd, $id_folio);
            }
            //
            $infodetalle = new Personas();
            $sesion = $infodetalle->get_detalle($idadd, $id_folio);
            //print_r($sesion);
            $_SESSION["idAdmin"] = $sesion[1]['id_detalle'];
            header("Location: index.php?accion=Tests");

        }
        /**/
    }

} else {
    require_once("views/test/home.php");
}
?>
