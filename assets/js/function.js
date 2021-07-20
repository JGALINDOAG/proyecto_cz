function conMayusculas(field) {
    field.value = field.value.toUpperCase();
}

function validarEmail(email, confirmEmail){
	if(email === confirmEmail){
		document.getElementById("recuperar").removeAttribute("disabled"); 
		document.getElementById("result").innerHTML = '';
	} else {
		document.getElementById("recuperar").setAttribute("disabled", ""); 
		var str = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>¡AVISO!</strong><hr>Los correos no son identicos <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
        document.getElementById("result").innerHTML = str;
	}
}

function soloLetras(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	especiales = "8-37-39-46";
	tecla_especial = false
	for(var i in especiales){
		if(key == especiales[i]){
		tecla_especial = true;
		break;
		}
	}
	if(letras.indexOf(tecla)==-1 && !tecla_especial){
		return false;
	}
}
			
function soloNumeros(e){
	var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
    	return true;        
        return /\d/.test(String.fromCharCode(keynum));
}

function validarPassword(password, confirmPassword){
	if(password === confirmPassword){
		document.getElementById("actualizar").removeAttribute("disabled"); 
		document.getElementById("result").innerHTML = '';
	} else {
		document.getElementById("actualizar").setAttribute("disabled", ""); 
		var str = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>¡AVISO!</strong><hr>Las contraseñas no son identicas<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
        document.getElementById("result").innerHTML = str;
	}
}

function getPassAdmin($email, $nombre, $usuario, $clave){
	alert('entra')
}