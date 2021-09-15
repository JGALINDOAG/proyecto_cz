<?php
class ResultadosController
{
  
  public static function index(){
    // require_once "models/institucionAdministrador.php";
    // $objInstitucionAdministrador = new InstitucionAdministrador();
    // $rowFolios = $objInstitucionAdministrador->get_institucionAdministrador();
    require_once "views/resultados/index.php";
  }
  
  public static function getList(){
    require_once "models/detallePersonasPruebas.php";
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    // $rowDetallePersonas = $objDetallePersonasPruebas->get_resultados($_POST['folio']);
    $rowDetallePersonas = $objDetallePersonasPruebas->get_resultados();
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

  public static function perfiles(){
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_institucion();
    require_once "views/resultados/perfiles.php";
  }
 
  public static function getPerfiles(){
    require_once "models/detallePersonasPruebas.php";
    require_once("models/reporte.php");
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    $rowDP = $objDetallePersonasPruebas->get_personas_folio($_POST['folio']);
    foreach ($rowDP as $key=>$item):
      # Personalidad 1
      $r2 = new Reporte();
      $smp02 = $r2->res_ind($item["id_detalle"], 2);
      for ($i=0; $i<sizeof($smp02); $i++) {
        $rowDP[$key]['personalidad_1'][] = [
            "indicador" => $smp02[$i]["indicador"],
            "id_indicador" => $smp02[$i]["id_indicador"],
            "resultado" => $smp02[$i]["resultado"]
        ];
      }
      # Personalidad 2
      $r2 = new Reporte();
      $smp02 = $r2->res_ind($item["id_detalle"], 3);
      for ($i=0; $i<sizeof($smp02); $i++) {
        $rowDP[$key]['personalidad_2'][] = [
            "indicador" => $smp02[$i]["indicador"],
            "id_indicador" => $smp02[$i]["id_indicador"],
            "resultado" => $smp02[$i]["resultado"]
        ];
      }
      # TERMAN
      $r1 = new Reporte();
      $terman = $r1->res_total($item["id_detalle"], 1);
      $datos1 = new Reporte();
      $data1 = $datos1->perfil_terman($terman[0]['total']);
      $rowDP[$key]['ci_terman'] = $data1['ci'];
      # RAVEN
      $r4 = new Reporte();
      $raven = $r4->res_total($item["id_detalle"], 4);
      $datos4 = new Reporte();
      $data4 = $datos4->perfil_raven($raven[0]['total']);
      $rowDP[$key]['ci_raven'] = $data4['ci'];
    endforeach;
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
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "perfiles") {
    ResultadosController::perfiles();
  } elseif ($_GET["accion"] == "resultados" && $_GET["pag"] == "getPerfiles") {
    ResultadosController::getPerfiles();
  }
}
?>
