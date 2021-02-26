<?php
class HomeUsuarioController
{
  
  public static function index(){
    require_once "models/persona.php";
    $objPersona = new Persona();
    $listPersonas = $objPersona->get_byTipoCliente();
    #Enviar correos a los pacientes de prox. citas
    require_once "models/events.php";
    $objEvents = new Events();
    $rowEvents = $objEvents->get_nextEvents();
    require_once "models/msn_events.php";
    foreach ($rowEvents as $value):
      $objMSNEvents= new MSNEvents();
      $valid = $objMSNEvents->get_byCveEvents($value["id"]);
      if(empty($valid)):
        $objMSNEvents->add_msn_events($value["id"], date("Y-m_d"));
        $date = strftime("%d de %B del %Y a la(s) %r", strtotime($value["start"]));
        $respuesta = AccesoDatos::nextAppointment($value["email"], $value["nombre"], $date);
        if($respuesta === false) echo $respuesta;
      endif;
    endforeach;
    require_once "views/usuario/home.php";
  }

  public static function profile(){ 
    require_once "models/persona.php";
    $objPersona = new Persona();
    $rowPersonaSession = $objPersona->get_byTipoPersona(AccesoDatos::desencriptar($_SESSION["idadmin"]), $_SESSION["tipoPersona"]);
    list($lada, $telefono) = explode("-", $rowPersonaSession[0]["telefono"]);
    require_once "views/usuario/profile.php";
  }

  public static function update(){ 
    require_once "models/persona.php";
    $objPersona = new Persona();
    $rowPersona = $objPersona->get_cve_persona($_SESSION["idadmin"]);	
    $msn="";
    if($rowPersona[0]["cve_tipo_persona"] != 3):
      require_once "models/administrador.php";
      $objAdministrador = new Administrador();
      $txtTelefono = $_POST["txtLada"]."-".$_POST["txtTelefono"];
      $objAdministrador->update_cve_admin($_SESSION["idadmin"], $txtTelefono);
    endif;
    if($_POST["txtEmail"] != $rowPersona[0]["email"]):
      $objPersona = new Persona();
      $validEmail = $objPersona->get_validEmail($_POST["txtEmail"]);
      // print_r($validEmail);
      if(empty($validEmail)):
        $objPersona->update_cve_persona($_SESSION["idadmin"], $rowPersona[0]["nombre"], $rowPersona[0]["ap_paterno"], $rowPersona[0]["ap_materno"], $_POST["txtEmail"]);
        $msn=1;
      else:
        $msn=2;
      endif;
    else: $msn=1;
    endif;
    header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=profile&m=".AccesoDatos::encriptar($msn));
  }

  public static function updateUser(){ 
    require_once "models/usuario.php";
    $objUsuario = new Usuario();
    $rowUsuario = $objUsuario->get_InnerPersona($_SESSION["idadmin"]);
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
  if ($_GET["accion"] == "homeUsuario" && $_GET["pag"] == "index") {
    HomeUsuarioController::index();
  } elseif ($_GET["accion"] == "homeUsuario" && $_GET["pag"] == "profile") {
    HomeUsuarioController::profile();
  } elseif ($_GET["accion"] == "homeUsuario" && $_GET["pag"] == "updateUser") {
    HomeUsuarioController::updateUser();
  }
}
?>
