<?php
class ResultadosController
{
  
  public static function index(){
    require_once "models/institucionAdministrador.php";
    $objInstitucionAdministrador = new InstitucionAdministrador();
    $rowFolios = $objInstitucionAdministrador->get_institucionAdministrador();
    require_once "views/resultados/index.php";
  }
  
  public static function getList(){
    require_once "models/detallePersonasPruebas.php";
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    $rowDetallePersonas = $objDetallePersonasPruebas->get_resultados($_POST['folio']);
    $dataJson = json_encode($rowDetallePersonas, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }
  
  public static function avance(){
    require_once "models/institucionAdministrador.php";
    $objInstitucionAdministrador = new InstitucionAdministrador();
    $rowFolios = $objInstitucionAdministrador->get_institucionAdministrador();
    require_once "views/resultados/avance.php";
  }

  public static function getListPruebas(){
    require_once "models/pruebas.php";
    $objPruebas = new Pruebas();
    $rowPruebas = $objPruebas->list_pruebas_institucion($_POST['folio']);
    $dataJson = json_encode($rowPruebas, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }
  
  public static function getAvanceList(){
    require_once "models/detallePersonasPruebas.php";
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    $rowDP = $objDetallePersonasPruebas->get_avance($_POST['folio']);
    $dataJson = json_encode($rowDP, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") { 
    // ResultadosController::save();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "resultados" && $_GET["pag"] == "index") {
    ResultadosController::index();
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "getList") {
    ResultadosController::getList();
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "avance") {
    ResultadosController::avance();
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "getListPruebas") {
    ResultadosController::getListPruebas();
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "getAvanceList") {
    ResultadosController::getAvanceList();
  }
}
?>
