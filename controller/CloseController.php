<?php 
//Modelo para cerrar sesión
require_once("models/personas.php");
$u=new Personas();
$u->close();
?>
