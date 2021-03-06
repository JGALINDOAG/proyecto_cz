<?php
class HomeUsuarioController
{
  
  public static function index(){
    require_once "models/detallePersonasPruebas.php";
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    $rowDetallePersonasPruebas = $objDetallePersonasPruebas->get_detallePersonasPruebas();
    require_once "views/usuario/home.php";
  }

  public static function save(){ 
    require_once "models/detallePersonasPruebas.php";
    $objDetallePersonasPruebas = new DetallePersonasPruebas();
    foreach($_POST as $POST => $val){
      if($POST != 'user_length' && $POST != 'validUsuario'){
        $json = json_decode($val, true);
        // echo $json['id'];
        $rowDetallePersonasPruebas = $objDetallePersonasPruebas->update_detallePersonasPruebas($json['id']);
      }
    }
    header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=index&m=".AccesoDatos::encriptar(1));
  }

  public static function updateUser(){ 
    require_once "models/administradores.php";
    $objAdministradores = new Administradores();
    $rowAdministradores = $objAdministradores->get_InnerPersona($_SESSION["idAdmin"]);
    if(isset($_POST["validUsuario"]) && isset($_POST["validUsuario"])=="updateUser"): 
      $objAdministradores->update_id_admin_pass($_SESSION["idAdmin"], $rowAdministradores[0]["usuario"], $_POST["txtClave"]);
      header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=updateUser&m=".AccesoDatos::encriptar(1));
    endif;
    require_once "views/usuario/update.php";
  }

  public static function delete(){ }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "save") { 
    HomeUsuarioController::save();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "homeUsuario" && $_GET["pag"] == "index") {
    HomeUsuarioController::index();
  } elseif ($_GET["accion"] == "homeUsuario" && $_GET["pag"] == "updateUser") {
    HomeUsuarioController::updateUser();
  }
}
?>
