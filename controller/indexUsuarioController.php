<?php
#CONTROLADOR - LLAMAMOS AL MODELO Y A SUS METODOS
#SI SE INTENTA CARGAR EL INDEX "FORMULARIO DE LOGEO" UNA VEZ QUE YA EXISTA UNA SESIÓN NO PERMITA ACCEDER Y SE RE DIRECCIONE A HOME -> ?accion=index  X
if(isset($_SESSION["idAdmin"]))
{
	header("Location:".AccesoDatos::ruta()."?accion=homeUsuario");
}else{
	#LLAMAMOS AL MODELO
	require_once("models/administradores.php");
	#INSTANCIA DE LA CLASE USUARIOS
	$objAdministradores = new Administradores();
	#ANTES DE LLEGAR A LA VISTA PREGUNTO SI EXISTE POST Y SI ES EJECUTADO DESDE EL SISTEMA
	if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
	{
		#VALIDACIÓN DE CAMPOS VACÍOS
		if(empty($_POST["login"]) || empty($_POST["pass"]))
		{
			header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(1)."");
			exit;
		}else{
			#SI SE CUMPLE LA CONDICIÓN ENTONCES SE EJECUTA UN MÉTODO O EN ESTE CASO EL OBJETO LOGEO
			$rowAdministradores=$objAdministradores->logueo($_POST["login"]);	
			if(count($rowAdministradores) == null):
				header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(2)."");
				exit;
			elseif($rowAdministradores[0]["activo"] == 0):
				header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(4)."");
				exit;
			elseif($rowAdministradores[0]["activo"] == 1):
				if($rowAdministradores[0]["clave"] === $_POST["pass"]):
					$_SESSION["idAdmin"] = $rowAdministradores[0]["id_admin"];
					$_SESSION["idInstitucion"] = $rowAdministradores[0]["id_institucion"];
					$_SESSION["isLoggedIn"] = true;
					header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario");
					exit;
				else:
					header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(2)."");
				endif;
			endif;
		    exit;
		}
	}
	require_once("views/usuario/index.php");
}
?>