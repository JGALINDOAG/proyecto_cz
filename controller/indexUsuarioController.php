<?php
#CONTROLADOR - LLAMAMOS AL MODELO Y A SUS METODOS
#SI SE INTENTA CARGAR EL INDEX "FORMULARIO DE LOGEO" UNA VEZ QUE YA EXISTA UNA SESIÓN NO PERMITA ACCEDER Y SE RE DIRECCIONE A HOME -> ?accion=index  X
if(isset($_SESSION["idAdmin"]))
{
	header("Location:".AccesoDatos::ruta()."?accion=homeUsuario&pag=index");
}else{
	#LLAMAMOS AL MODELO
	require_once("models/usuario.php");
	#INSTANCIA DE LA CLASE USUARIOS
	$objHUsuario = new Usuario();
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
			$rowHUsuario=$objHUsuario->logueo($_POST["login"]);	
			if(count($rowHUsuario) == null):
				header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(2)."");
				exit;
			elseif($rowHUsuario[0]["activo"] == 0):
				header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(4)."");
				exit;
			elseif($rowHUsuario[0]["activo"] == 1):
				if(AccesoDatos::desencriptar($rowHUsuario[0]["password"]) === $_POST["pass"]):
					$_SESSION["idAdmin"] = AccesoDatos::encriptar($rowHUsuario[0]["cve_usuario"]);
					$_SESSION["isLoggedIn"] = true;
					header("Location: ".AccesoDatos::ruta()."?accion=homeUsuario&pag=index");
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