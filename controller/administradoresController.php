<?php
class AdministradoresController
{

  public static function index(){
    require_once 'models/cRol.php';
    require_once 'models/institucion.php';
    $objRol = new CROL();
    $rowRol = $objRol->get_c_rol();
    $objInstitucion = new Institucion();
    $rowInstitucion = $objInstitucion->get_institucion(); 
    if(isset($_GET["institution"])) $institution = AccesoDatos::desencriptar(str_replace(' ', '+', $_GET["institution"]));
    require_once 'views/administrador/index.php';
  }

  public static function save() {
    require_once 'models/administradores.php';
    if(isset($_GET["institution"]) || $_SESSION['idInstitucion'] == 1) $cmbInstitucion = $_POST["cmbInstitucion"];
    else $cmbInstitucion = $_SESSION["idInstitucion"];
    $objAdministradores = new Administradores();
    $apellidos = $_POST["txtApPaterno"].' '.$_POST["txtApMaterno"];
    $validAdministradores = $objAdministradores->valid_administradores($_POST["txtNombre"], $apellidos, $cmbInstitucion);
    if(empty($validAdministradores)):
      $usuario = AccesoDatos::usuario($_POST["txtNombre"], $_POST["txtApPaterno"], $_POST["txtApMaterno"]);
      $clave = AccesoDatos::codigo();
      $idFolio = AccesoDatos::folio();
      $idAdmin = $objAdministradores->add_administradores($cmbInstitucion,  $_POST["cmbCargo"], $_POST["txtNombre"], $apellidos, $usuario, $clave);
      if(isset($_GET["institution"])) header("Location: ".AccesoDatos::ruta()."?accion=institucion&pag=index&m=".AccesoDatos::encriptar(1)."");
      else header("Location: ".AccesoDatos::ruta()."?accion=administradores&m=".AccesoDatos::encriptar(1)."");
    else:
      if(count($validAdministradores) == 1) $errno[] = 1;
      $_POST["errno"] = $errno;
    endif;
  }
}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") {
    AdministradoresController::save();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "administradores") {
    AdministradoresController::index();
  }
}
?>
