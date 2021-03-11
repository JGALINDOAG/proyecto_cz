<?php
class HomeUsuarioController
{
  
  public static function index(){
    require_once "views/usuario/home.php";
  }

  public static function update(){ 
    header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=profile&m=".AccesoDatos::encriptar($msn));
  }

  public static function updateUser(){ 
    require_once "models/usuario.php";
    $objUsuario = new Usuario();
    $rowUsuario = $objUsuario->get_InnerPersona($_SESSION["idAdmin"]);
    if(isset($_POST["validUsuario"]) && isset($_POST["validUsuario"])=="updateUser"): 
      print_r($rowUsuario);
      $objUsuario->update_cve_usuario($_SESSION["idadmin"], $rowUsuario[0]["usuario"], AccesoDatos::encriptar($_POST["txtContrasena"]), '1');
      $date = strftime("%d de %B del %Y a las %r", strtotime(date('Y-m-d G:i:s')));
      $respuesta = AccesoDatos::updatePass($rowUsuario[0]["email"], $rowUsuario['nombrePersona'], gethostname(), $date);
      if($respuesta === true) header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=updateUser&m=".AccesoDatos::encriptar(1));
      else echo $respuesta;
    endif;
    require_once "views/usuario/update.php";
  }

  public static function delete(){ }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "update") { 
    HomeUsuarioController::update();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "homeUsuario") {
    HomeUsuarioController::index();
  }
}
?>
