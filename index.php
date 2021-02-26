<?php
#EXTRAEMOS EL ARCHIVO CONFIG.PHP PARA HACER USO DE LOS METODOS
require_once("libs/accesoDatos.php");
require_once("controller/navbarUsuarioController.php");
#CREAMOS UNA SESION O REANUDAMOS LA ACTUAL
session_start();
#SI EXISTE LA SESION REALIZA LO SIGUIENTE
if(isset($_SESSION["idAdmin"]))
{
	#SI LA VARIABLE ACCIÓN QUE VIENE POR CABECERA VIENE VACÍA, A LA VARIABLE ACCIÓN LE DAMOS EL VALOR DEL ARRAY ASOCIATIVO QUE VINE POR LA URL
	if(!empty($_GET["accion"]))
	{
		$accion=$_GET["accion"];
	}
	#SI NO A LA VARIABLE ACCIÓN LE VOY A ASIGNAR EL VALOR DE ALGÚN CONTROLADOR POR DEFECTO: EN ESTE CASO "INDEX"
	else
	{
		$accion="indexUsuario";
	}
	#VERIFICAMOS SI EN EL DIRECTORIO CONTROLLER EXISTE EL CONTROLADOR DE SER ASÍ LO LLAMAMOS
	if(is_file("controller/".$accion."Controller.php")){
		require_once("controller/".$accion."Controller.php");
	}else{
		require_once("controller/errorUsuarioController.php");
	}
}
#SI NO EXISTE EL CONTROLADOR MANDAMOS UN CONTROLADOR DE ERROR POR DEFECTO, EN ESTE CASO UNO DE ERROR
else
{	
	if(isset($_GET["accion"])):
		// ?accion=indexUsuario
		if($_GET["accion"] == 'Home'):
			require_once("controller/HomeController.php");
		elseif ($_GET["accion"] == 'indexUsuario'):
			require_once("controller/indexUsuarioController.php");
		else:
			require_once("controller/errorUsuarioController.php");
		endif;
	else:
		require_once("controller/indexUsuarioController.php");
	endif;
	// Originalmente
	// require_once("controller/indexUsuarioController.php");
}
?>