<?php
class NavbarUsuarioController
{
  
  public static function index(){
    if(isset($_SESSION["idadmin"])):
      require_once 'models/privilegio.php';
      require_once "models/persona.php";
      $objPersona = new Persona();
      $rowPersona = $objPersona->get_cve_persona($_SESSION["idAdmin"]);
      $_SESSION["nombre"] = ucwords(strtolower($rowPersona[0]["nombre"]." ".$rowPersona[0]["ap_paterno"]." ".$rowPersona[0]["ap_materno"]));
      $_SESSION["tipoPersona"] = $rowPersona[0]["cve_tipo_persona"];
      
      $objPrivilegio = new Privilegio();
      $menu = $objPrivilegio->get_menu($_SESSION["tipoPersona"]);
      $objPrivilegio = new Privilegio();
      $submenu= $objPrivilegio->get_subMenu($_SESSION["tipoPersona"]);
    endif;
    require_once 'views/layout/navbar.php';
  }

  public static function save(){ }

  public static function update(){ }

  public static function delete(){ }

}
?>
