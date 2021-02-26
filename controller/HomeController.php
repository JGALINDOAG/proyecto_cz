<?php
//Valida la existencia un post desde la vista para ejecutar el proceso, de lo contrario muestra la vista. 
if (isset($_POST["personal"]) and $_POST["personal"] == "ok") {
    require_once("models/personas.php");
    $nombre = strtoupper($_POST["nom"]);
    $primer_apellido = strtoupper($_POST["ap1"]);
    $segundo_apellido = strtoupper($_POST["ap2"]);
    $email = $_POST["email"];
    $folio_matricula = NULL;
    $tipo = NULL;
    $area = NULL;
    $noDouble = new Personas();
    //Valida si la persona existe en la base de datos mediante el correo para evitar insertarla de nuevo.
    $existe = $noDouble->no_double_correo($email);
    if ($existe[0] == 0) {
        $addident = new Personas();
        //Función para agregar a la persona
        $addident->add_persona($folio_matricula, $nombre, $primer_apellido, $segundo_apellido, $tipo, $email, $area);
        //Una vez insertado en la base de datos se vuelve a consultar para obtener su Id_persona
        $ahoraExiste = $addident->no_double_correo($email);
        $_SESSION["idAdmin"] = $ahoraExiste[1]['Id_persona'];
        header("Location: index.php?accion=Tests");
    } else {
        $_SESSION["idAdmin"] = $existe[1]['Id_persona'];
        header("Location: index.php?accion=Tests");
    }
} else {
    require_once("views/test/home.php");
}
?>
