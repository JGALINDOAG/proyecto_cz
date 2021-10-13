<?php
#CONTROLADOR - LLAMAMOS AL MODELO Y A SUS METODOS
#SI SE INTENTA CARGAR EL INDEX "FORMULARIO DE LOGEO" UNA VEZ QUE YA EXISTA UNA SESIÓN NO PERMITA ACCEDER Y SE RE DIRECCIONE A HOME -> ?accion=index  X
if(isset($_SESSION["idAdmin"]))
{
	header("Location:".AccesoDatos::ruta()."?accion=homeUsuario&pag=index");
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
			header("Location: ".AccesoDatos::ruta()."?accion=loginUsuario&m=".AccesoDatos::encriptar(1)."");
			exit;
		}else{
			#SI SE CUMPLE LA CONDICIÓN ENTONCES SE EJECUTA UN MÉTODO O EN ESTE CASO EL OBJETO LOGEO
			$rowAdministradores=$objAdministradores->logueo($_POST["login"], $_POST["pass"]);	
			if(count($rowAdministradores) == null):
				header("Location: ".AccesoDatos::ruta()."?accion=loginUsuario&m=".AccesoDatos::encriptar(2)."");
				exit;
			elseif($rowAdministradores[0]["activo"] == 0):
				header("Location: ".AccesoDatos::ruta()."?accion=loginUsuario&m=".AccesoDatos::encriptar(4)."");
				exit;
			elseif($rowAdministradores[0]["activo"] == 1):
				if($rowAdministradores[0]["clave"] === $_POST["pass"]):
					$_SESSION["idAdmin"] = $rowAdministradores[0]["id_admin"];
					$_SESSION["idRol"] = $rowAdministradores[0]["id_rol"];
					$_SESSION["idInstitucion"] = $rowAdministradores[0]["id_institucion"];
					$_SESSION["isLoggedIn"] = true;
					if($_SESSION["idRol"] == 4 || $_SESSION["idRol"] == 2 || $_SESSION["idRol"] == 1) header("Location: ".AccesoDatos::ruta()."?accion=resultados&pag=index");
					elseif($_SESSION["idRol"] == 3) header("Location: ".AccesoDatos::ruta()."?accion=resultados&pag=avance");
					else header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=index");
					exit;
				else:
					header("Location: ".AccesoDatos::ruta()."?accion=loginUsuario&m=".AccesoDatos::encriptar(2)."");
				endif;
			endif;
		    exit;
		}
	}
	require_once("views/usuario/index.php");
}
?>