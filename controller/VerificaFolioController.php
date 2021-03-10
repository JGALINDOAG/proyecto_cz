<?php 
require_once("models/personas.php");
$get=new Personas();
$result=$get->verifica_idfolio($_POST["folio"]);
//print_r($result);
if($result[0]['valor'] == 0){
    echo '<p style="color:red;">Folio incorrecto</p>';
}else{
    echo '<p style="color:green;">Folio correcto</p>';
}

?>