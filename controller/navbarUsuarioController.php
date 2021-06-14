<?php
class NavbarUsuarioController
{
  
  public static function index(){
    if(isset($_SESSION["idAdmin"])):
      require_once 'models/privilegio.php';
      require_once "models/administradores.php";
      $objAdministradores = new Administradores();
      $rowAdmin = $objAdministradores->get_id_admin($_SESSION["idAdmin"]);
      $_SESSION["nombre"] = ucwords(strtolower($rowAdmin[0]["nombre"]." ".$rowAdmin[0]["apellidos"]));
      $_SESSION["idRol"] = $rowAdmin[0]["id_rol"];
      
      $objPrivilegio = new Privilegio();
      $menu = $objPrivilegio->get_menu($_SESSION["idRol"]);
    endif;
    require_once 'views/layout/navbar.php';
  }

  public static function navResultado(){ 
    require_once 'views/layout/navbarResultado.php';
  }

  public static function update(){ }

  public static function delete(){ }

}
?>
