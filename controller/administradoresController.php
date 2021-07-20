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
      $nombre = $_POST["txtNombre"]." ".$_POST["txtApPaterno"]." ".$_POST["txtApMaterno"];
      $usuario = AccesoDatos::usuario($_POST["txtNombre"], $_POST["txtApPaterno"], $_POST["txtApMaterno"]);
      $clave = AccesoDatos::codigo();
      $objAdministradores->add_administradores($cmbInstitucion, $_POST["cmbCargo"], $_POST["txtNombre"], $apellidos, $_POST["txtEmail"], $_POST["txtTelefono"], $usuario, $clave);

      $tel = "52".$_POST["txtTelefono"];
      if(isset($_GET["institution"])):
        $url = "?accion=institucion";
      else:
        $url = "?accion=administradores";
      endif;
      $email = $_POST["txtEmail"];
      header("Location: ".AccesoDatos::ruta().$url."&pag=index&m=".AccesoDatos::encriptar(1).
      "&u=".AccesoDatos::encriptar($usuario)."&c=".AccesoDatos::encriptar($clave).
      "&e=".AccesoDatos::encriptar($email)."&t=".AccesoDatos::encriptar($tel)."&n=".AccesoDatos::encriptar($nombre));
    else:
      if(count($validAdministradores) == 1) $errno[] = 1;
      $_POST["errno"] = $errno;
    endif;
  }

  public static function messageEmail(){
    $respuesta = AccesoDatos::addAdmin($_POST['email'], $_POST['nombre'], $_POST['usuario'], $_POST['clave']);
    if($respuesta === false) print $respuesta;
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
  if ($_GET["accion"] == "administradores" && $_GET["pag"] == "index") {
    AdministradoresController::index();
  } elseif ($_GET["accion"] == "administradores" && $_GET["pag"] == "messageEmail") {
    AdministradoresController::messageEmail();
  }
}
?>
