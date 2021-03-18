<?php
class RecoveryController
{
  
    public static function index(){        
      require_once "views/usuario/recovery.php";
    }

    public static function save(){ }

    public static function update() {
      require_once ("models/institucion.php");
      $objPersona = new Institucion();	
      $rowValidEmail = $objPersona->get_recoveryEmail($_POST["txtEmail"], $_POST["txtUsuario"]);	
      if(empty($rowValidEmail)){
        echo"<script type='text/javascript'>window.location='?accion=recovery&m=".AccesoDatos::encriptar(1)."';</script>";					
      }else{ 
        #OBTIENE DATOS DE USUARIO
        require_once ("models/administradores.php");
        $objAdministradores = new Administradores();	
        $rowAdministradores = $objAdministradores->get_id_admin($rowValidEmail[0]["id_admin"]);	

        $nombre = $rowAdministradores[0]["apellidos"]." ".$rowAdministradores[0]["nombre"];
        $date = strftime("%d de %B del %Y a las %r", strtotime(date('Y-m-d G:i:s')));
        $respuesta = AccesoDatos::recoveryPass($_POST["txtEmail"], $nombre, gethostname(), $date, $rowAdministradores[0]["usuario"], $rowAdministradores[0]["clave"]);
        if($respuesta === true) echo"<script type='text/javascript'>window.location='?accion=recovery&m=".AccesoDatos::encriptar(2)."';</script>";
        else echo $respuesta;
      }
    }

    public static function delete(){ }

}

//obtiene los datos del usuario desde la vista y redirecciona a UsuarioController.php
if (isset($_POST['validUsuario'])) {
  if ($_POST["validUsuario"] == "update") {
    RecoveryController::update();
  }
}
//se verifica que action esté definida
if (isset($_GET["accion"])) {
  if ($_GET["accion"] == "recovery") {
    RecoveryController::index();
  }
}
?>