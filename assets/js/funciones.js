function dosMin() {
	setTimeout(function () {
		for (i = 0; i < form1.elements.length; i++) {
			if (form1.elements[i].type == 'radio') { form1.elements[i].hidden = true }
			if (form1.elements[i].type == 'checkbox') { form1.elements[i].hidden = true }
		}
		alert("Finalizo el tiempo para esta serie; pulsa en continuar");
	}, 120000);//3000
}

function tresMin() {
	setTimeout(function () {
		for (i = 0; i < form1.elements.length; i++) {
			if (form1.elements[i].type == 'radio') { form1.elements[i].hidden = true }
			if (form1.elements[i].type == 'checkbox') { form1.elements[i].hidden = true }
		}
		alert("Finalizo el tiempo para esta serie; pulsa en continuar");
	}, 180000);
}

function cuatroMin() {
	setTimeout(function () {
		for (i = 0; i < form1.elements.length; i++) {
			if (form1.elements[i].type == 'radio') { form1.elements[i].hidden = true }
			if (form1.elements[i].type == 'checkbox') { form1.elements[i].hidden = true }
		}
		alert("Finalizo el tiempo para esta serie; pulsa en continuar");
	}, 240000);
}

function cincoMin() {
	setTimeout(function () {
		for (i = 0; i < form1.elements.length; i++) {
			if (form1.elements[i].type == 'radio') { form1.elements[i].hidden = true }
			if (form1.elements[i].type == 'checkbox') { form1.elements[i].hidden = true }
		}
		alert("Finalizo el tiempo para esta serie; pulsa en continuar");
	}, 300000);
}
