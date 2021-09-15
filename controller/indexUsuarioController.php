<?php

if (isset($_POST['validUsuario']) == 'send'):
    $respuesta = AccesoDatos::sendContact($_POST['name'], $_POST['email'], $_POST['message']);
    if($respuesta === false) print $respuesta;
    header("Location: ".AccesoDatos::ruta()."?accion=indexUsuario&m=".AccesoDatos::encriptar(1).'#contact');
endif;

require_once("views/usuario/principal.php");

