<?php
class PagoController
{
  
  public static function index(){
    require_once "models/institucion.php";
    $objInstitucion = new Institucion();
    // $_SESSION["idInstitucion"]
    $rowInstitucion = $objInstitucion->get_folio();
    require_once "views/pago/index.php";
  }

  public static function save(){ 
    require_once "models/administradores.php";
    require_once "models/pago.php";
    $jsonCmbFolio = json_decode($_POST['cmbFolio'], true);
    $json = json_decode($_POST['cmbFormaPago'], true);
    $objPago = new Pago();
    if(isset($_FILES['file']['name'])) $dir = 'assets/files/voucher/'.$jsonCmbFolio['id_folio'].'/'.str_replace(' ','_',$_FILES['file']['name']);
    if($json['key'] == 2):
      $array = [
        "total" => $_POST['txtCantidad']
      ];
      $transaccion = json_encode($array);
    elseif($json['key'] == 3):
      $array = [
        "total" => $_POST['txtCantidad'],
        "referencia" => $_POST['txtReferencia'],
        "clv_rastreo" =>  $_POST['txtRastreo'],
        "vaucher" => $dir
      ];
      $transaccion = json_encode($array);
    elseif ($json['key'] == 4):
      $array = [
        "total" => $_POST['txtCantidad'],
        "folio" => $_POST['txtFolio'],
        "linea_captura" =>  $_POST['txtLinea'],
        "vaucher" => $dir
      ];
      $transaccion = json_encode($array);
    endif;
    $objPago->add_pago($jsonCmbFolio['id_folio'], $json['item'], $transaccion);
    if($json['key'] == 3 || $json['key'] == 4) PagoController::move_file($_FILES['file']['name'], $_FILES["file"]["tmp_name"], $jsonCmbFolio['id_folio']);
    $date = strftime("%d de %B del %Y a las %r", strtotime(date('Y-m-d G:i:s')));
    $objAdministradores = new Administradores();
    $rowAdministradores = $objAdministradores->get_id_admin($_SESSION['idAdmin']);
    $nameAdmin = $rowAdministradores[0]['nombre'].' '.$rowAdministradores[0]['apellidos'];
    $respuesta = AccesoDatos::payFolio($nameAdmin, $jsonCmbFolio['id_folio'], $date);
    if($respuesta === true) header("Location: ".AccesoDatos::ruta()."?accion=pago&pag=index&m=".AccesoDatos::encriptar(2));
    else echo $respuesta;
  }
  
  public static function paypal(){ 
    require_once "models/pago.php";
    $json = json_decode($_GET['cmbFormaPago'], true);
    $objPago = new Pago();
    $array = [
        "total" => $_GET['txtCantidad']
      ];
    $transaccion = json_encode($array);
    $objPago->add_pago($_GET['cmbFolio'], $json['item'], $transaccion);
    $objAdministradores = new Administradores();
    $rowAdministradores = $objAdministradores->get_id_admin($_SESSION['idAdmin']);
    $nameAdmin = $rowAdministradores[0]['nombre'].' '.$rowAdministradores[0]['apellidos'];
    $respuesta = AccesoDatos::payFolio($nameAdmin, $_POST['cmbFolio'], $date);
    if($respuesta === true) header("Location: ".AccesoDatos::ruta()."?accion=pago&pag=index&m=".AccesoDatos::encriptar(2));
    else echo $respuesta;
  }

  public static function move_file($file, $temporal, $folio) {
		$dir = 'assets/files/voucher/'.$folio.'/';
		if(!file_exists($dir)) mkdir($dir);
		$filename = $dir.$file;
    move_uploaded_file($temporal, str_replace(' ','_',$filename));
	}

  public static function report(){
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_institucion();
    require_once "views/pago/report.php";
  }
  
  public static function getReport(){
    require_once "models/pago.php";
    $objPago = new Pago();
    $rowPago = $objPago->get_reportPago($_POST['fechaInicio'], $_POST['fechaFin']);
    $dataJson = json_encode($rowPago, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }
  
  public static function getPagos(){
    require_once "models/pago.php";
    $objPago = new Pago();
    $rowPago = $objPago->get_pagos_by_folio($_POST['folio']);
    $dataJson = json_encode($rowPago, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }
}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") { 
    PagoController::save();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "pago" && $_GET["pag"] == "index") {
    PagoController::index();
  } else if ($_GET["accion"] == "pago" && $_GET["pag"] == "paypal") {
    PagoController::paypal();
  } else if ($_GET["accion"] == "pago" && $_GET["pag"] == "report") {
    PagoController::report();
  } else if ($_GET["accion"] == "pago" && $_GET["pag"] == "getReport") {
    PagoController::getReport();
  } else if ($_GET["accion"] == "pago" && $_GET["pag"] == "getPagos") {
    PagoController::getPagos();
  }
}
?>
