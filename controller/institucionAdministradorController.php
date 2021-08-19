<?php
class InstitucionAdministradorController
{
  
  public static function getFolio () {
    require_once 'models/institucionAdministrador.php';
    $objInstitucionAdministrador = new InstitucionAdministrador();
    $rowFolio = $objInstitucionAdministrador->get_idFolio($_POST['folio']);
    $dataJson = json_encode($rowFolio, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }
  
  public static function getFolioByInst () {
    require_once 'models/institucionAdministrador.php';
    $objInstitucionAdministrador = new InstitucionAdministrador();
    $rowFolio = $objInstitucionAdministrador->get_folios_by_institucion($_POST['idInstitucion']);
    $dataJson = json_encode($rowFolio, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "") { }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "institucionAdministrador" && $_GET["pag"] == "getFolio") {
    InstitucionAdministradorController::getFolio();
  } elseif ($_GET["accion"] == "institucionAdministrador" && $_GET["pag"] == "getFolioByInst") {
    InstitucionAdministradorController::getFolioByInst();
  }
}
?>
