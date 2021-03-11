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
    require_once 'models/administradores.php';
    require_once 'models/institucionAdministrador.php';

    $pruebas = "";
    foreach($_POST["cmbPrueba"] as $idPrueba): $pruebas .= $idPrueba.","; endforeach;
    $pruebas = rtrim($pruebas, ",");
    $apellidos = $_POST["txtApPaterno"].' '.$_POST["txtApMaterno"];
   
    $objInstitucion = new Institucion();
    $validInstitucion = $objInstitucion->valid_institucion($_POST["txtRFC"]);
    $objAdministradores = new Administradores();
    $validAdministradores = $objAdministradores->valid_administradores($_POST["txtNombre"], $apellidos);
    
    if(empty($validInstitucion) && empty($validAdministradores)): 
      $telefono = $_POST["txtLada"].'-'.$_POST["txtTelefono"];
      $usuario = AccesoDatos::usuario($_POST["txtNombre"], $_POST["txtApPaterno"], $_POST["txtApMaterno"]);
      $clave = AccesoDatos::codigo();
      $idFolio = AccesoDatos::folio();
      $objInstitucionAdministrador = new InstitucionAdministrador();

      $idInstitucion = $objInstitucion->add_institucion($_POST["txtNombreInst"], $_POST["txtAbreviatura"], $_POST["txtRFC"], $_POST["txtEmail"], $telefono, $pruebas);
      $idAdmin = $objAdministradores->add_administradores($idInstitucion, 2, $_POST["txtNombre"], $apellidos, $usuario, $clave);
      $objInstitucionAdministrador->add_institucionAdministrador($idFolio, $idAdmin, $_POST["txtCosto"], $_POST["txtNoPGratis"], $_POST["txtNoPVendidas"]);
      header("Location: ".AccesoDatos::ruta()."?accion=institucion&pag=index&m=".AccesoDatos::encriptar(1)."");
    else:
      if(count($validInstitucion) == 1) $errno[] = 1;
      if(count($validAdministradores) == 1) $errno[] = 2;
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
    require_once 'models/institucion.php';
    $pruebas = "";
    foreach($_POST["cmbPrueba"] as $idPrueba): $pruebas .= $idPrueba.","; endforeach;
    $pruebas = rtrim($pruebas, ",");

    $idFolio = AccesoDatos::folio();
    $objInstitucionAdministrador = new InstitucionAdministrador();

    $objInstitucionAdministrador->add_institucionAdministrador($idFolio, $_POST["cmbAdmin"], $_POST["txtCosto"], $_POST["txtNoPGratis"], $_POST["txtNoPVendidas"]);

    $objInstitucion= new Institucion();
    $objInstitucion->update_pruebas($_POST["cmbInstitucion"], $pruebas);
    header("Location: ".AccesoDatos::ruta()."?accion=institucion&pag=venta&m=".AccesoDatos::encriptar(1)."");
  }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") {
    InstitucionController::save();
  } elseif ($_POST["validUsuario"] == "addVenta") {
    InstitucionController::addVenta();
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
  }
}
?>
