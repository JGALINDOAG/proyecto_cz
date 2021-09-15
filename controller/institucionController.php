<?php
class InstitucionController
{

  public static function index(){
    require_once 'models/pruebas.php';
    $objPruebas = new Pruebas();
    $rowPruebas = $objPruebas->list_byInstitucion();
    require_once 'views/institucion/index.php';
  }

  public static function save() {
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $validInstitucion = $objInstitucion->valid_institucion($_POST["txtRFC"]);
    if(empty($validInstitucion)): 
      $pruebas = "";
      foreach($_POST["cmbPrueba"] as $idPrueba): $pruebas .= $idPrueba.","; endforeach;
      $pruebas = rtrim($pruebas, ",");
      $idInstitucion = $objInstitucion->add_institucion($_POST["txtNombreInst"], $_POST["txtAbreviatura"], $_POST["txtRFC"], $_POST["txtEmail"], $_POST["txtTelefono"], $pruebas);
      header("Location: ".AccesoDatos::ruta()."?accion=administradores&pag=index&institution=".AccesoDatos::encriptar($idInstitucion));
    else:
      if(count($validInstitucion) == 1) $errno[] = 1;
      $_POST["errno"] = $errno;
    endif;
  }

  public static function venta() {
    require_once 'models/pruebas.php';
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_institucion();
    $objPruebas = new Pruebas();
    $rowPruebas = $objPruebas->list_byInstitucion();
    require_once 'views/institucion/addVenta.php';
  }
  
  public static function getAdmin() {
    require_once 'models/administradores.php';
    $objAdministradores = new Administradores();
    $rowAdministradores = $objAdministradores->get_byIdInstitucion($_GET['idInstitucion']);
		$dataJson = json_encode($rowAdministradores, JSON_UNESCAPED_UNICODE);
		print $dataJson;
  }

  public static function addVenta() {
    require_once 'models/institucionAdministrador.php';
    require_once 'models/administradores.php';
    $idFolio = AccesoDatos::folio();
    $objInstitucionAdministrador = new InstitucionAdministrador();
    $objInstitucionAdministrador->add_institucionAdministrador($idFolio, $_POST["cmbAdmin"], $_POST["txtCosto"], $_POST["txtNoPGratis"], $_POST["txtNoPVendidas"]);
    
    $objAdministradores = new Administradores();
    $rowAdmin = $objAdministradores->get_id_admin($_POST["cmbAdmin"]);

    $nombre = $rowAdmin[0]['nombre']." ".$rowAdmin[0]['apellidos'];
    $telefono = "52".$rowAdmin[0]['telefono'];

    $respuesta = AccesoDatos::sendFolio($nombre, $idFolio, $rowAdmin[0]['email'], $_POST["txtNoPVendidas"], $_POST["txtNoPGratis"], $_POST["txtCosto"]);
    if($respuesta === false) print $respuesta;

    header("Location: ".AccesoDatos::ruta()."?accion=institucion&pag=venta&m=".AccesoDatos::encriptar(1).
    "&f=".AccesoDatos::encriptar($idFolio)."&t=".AccesoDatos::encriptar($telefono)."&n=".AccesoDatos::encriptar($nombre)."&c=".AccesoDatos::encriptar($_POST["txtCosto"]).
    "&v=".AccesoDatos::encriptar($_POST["txtNoPVendidas"])."&g=".AccesoDatos::encriptar($_POST["txtNoPGratis"]));
  }
  
  public static function listInstitucion() {
    require_once 'models/institucion.php';
    require_once 'models/pruebas.php';
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_institucion();
    $objPruebas = new Pruebas();
    $rowPruebas = $objPruebas->list_byInstitucion();
    require_once 'views/institucion/getInstitucion.php';
  }
  
  public static function listPruebas() {
    require_once 'models/pruebas.php';
    $objPruebas = new Pruebas();
    $rowPruebas = $objPruebas->list_byInstitucion();
    $dataJson = json_encode($rowPruebas, JSON_UNESCAPED_UNICODE);
    print $dataJson;
  }
 
  public static function getInstitucion() {
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_id_institucion($_POST['idInstitucion']);
    $dataJson = json_encode($rowInstitucion[0], JSON_UNESCAPED_UNICODE);
    print $dataJson;
  }
  
  public static function updateIntitucion() {
    require_once 'models/institucion.php';
    $objInstitucion = new Institucion();
    $pruebas = "";
    foreach($_POST["cmbPrueba"] as $idPrueba): $pruebas .= $idPrueba.","; endforeach;
    $objInstitucion->update_institucion($_POST['cmbInstitucion'], $_POST['txtNombreInst'], $_POST['txtAbreviatura'], $_POST['txtRFC'], $_POST['txtEmail'], $_POST['txtTelefono'], $pruebas);
    header("Location: ".AccesoDatos::ruta()."?accion=institucion&pag=listInstitucion&m=".AccesoDatos::encriptar(1)."");
  }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") {
    InstitucionController::save();
  } elseif ($_POST["validUsuario"] == "addVenta") {
    InstitucionController::addVenta();
  } elseif ($_POST["validUsuario"] == "updateIntitucion") {
    InstitucionController::updateIntitucion();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "institucion" && $_GET["pag"] == "index") {
    InstitucionController::index();
  } elseif ($_GET["accion"] == "institucion" && $_GET["pag"] == "venta") {
    InstitucionController::venta();
  } elseif ($_GET["accion"] == "institucion" && $_GET["pag"] == "listAdmin") {
    InstitucionController::getAdmin();
  } elseif ($_GET["accion"] == "institucion" && $_GET["pag"] == "listInstitucion") {
    InstitucionController::listInstitucion();
  } elseif ($_GET["accion"] == "institucion" && $_GET["pag"] == "getInstitucion") {
    InstitucionController::getInstitucion();
  } elseif ($_GET["accion"] == "institucion" && $_GET["pag"] == "listPruebas") {
    InstitucionController::listPruebas();
  }
}
?>
