/*=============================================
VALIDANDO FORMULARIO DE REGISTRO
=============================================*/

function register(){
	var rg_username = document.querySelector('#rg_username').value;
	var rg_email = document.querySelector('#rg_email').value;
	var rg_pass1 = document.querySelector('#rg_pass1').value;
	var rg_pass2 = document.querySelector('#rg_pass2').value;

	email_expresion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	expresion = /^[a-zA-Z0-9]+$/;

	if (rg_username == '') {
		M.toast({html: 'El campo usuario no puede estar vacio'})
		return;
	}else if(!expresion.exec(rg_username)){
		M.toast({html: 'En el campo Usuario, no se permiten carácteres especiales ni espacios'})
		return;
	}
	if (rg_email == '') {
		M.toast({html: 'El campo email no puede estar vacio'})
		return;
	}else if(!email_expresion.exec(rg_email)){
		M.toast({html: 'Por favor introduce un email válido'})
		return;
	}
	if (rg_pass1 == '' || rg_pass2 == '') {
		M.toast({html: 'El campo contraseña no puede estar vacio'})
		return;
	}else if(!expresion.exec(rg_pass1) || !expresion.exec(rg_pass2)){
		M.toast({html: 'En el campo Contraseña, no se permiten carácteres especiales ni espacios'})
		return;
	}
	if (rg_pass1 !== rg_pass2) {
		M.toast({html: 'Las contraseñas no coinciden'})
		return;
	}

	var ajax = new XMLHttpRequest();
	var URL = 'ajax/users.ajax.php';
	var method = 'POST';
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			var response = ajax.responseText;
			if (response == "email_invalido") {
				M.toast({html: 'El email enviado no es válido'})
			}else if (response == "user_name_invalido") {
				M.toast({html: 'El usuario enviado no es válido'})
			}else if (response == "password_invalido") {
				M.toast({html: 'El password enviado no es válido'})
			}else if(response == "campos_vacios"){
				M.toast({html: 'Algunos de los campos enviados estan vacios'})
			}else if(response == "ok"){
				M.toast({html: 'Su registro se realizo correctamente, por favor verifique su cuenta '+rg_email+' para ingresar'});
				document.getElementById('form_r').reset();
			}else if(response == "user_existe"){
				M.toast({html: 'El usuario ya se encuentra regitrado, intente con uno diferente'})
			}else if(response == "email_existe"){
				M.toast({html: 'El email ya se encuentra regitrado, intente con uno diferente'})
			}
		}
	};
	ajax.open(method, URL, true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("user_name=" + rg_username + "& email=" + rg_email + "& password=" + rg_pass1);
}


