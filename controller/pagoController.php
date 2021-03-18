<?php
class PagoController
{
  
  public static function index(){
    // require_once "models/detallePersonasPruebas.php";
    // $objDetallePersonasPruebas = new DetallePersonasPruebas();
    // $rowDetallePersonasPruebas = $objDetallePersonasPruebas->get_detallePersonasPruebas();
    require_once "views/pago/index.php";
  }

  public static function save(){ 
    // header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&m=".AccesoDatos::encriptar(1));
  }

  public static function updateUser(){ }

  public static function delete(){ }

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
  }
}
?>
