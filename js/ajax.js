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
	ajax.send("rg_username=" + rg_username + "& rg_email=" + rg_email + "& password=" + rg_pass1);
}

/*=============================================
VALIDANDO FORMULARIO DE REGISTRO
=============================================*/
function update_user() {
	var up_username = document.querySelector('#up_username').value;
	var up_email = document.querySelector('#up_email').value;
	var description = document.querySelector('#description').value;
	var iduser = document.querySelector('#iduser').value;

	email_expresion = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	expresion = /^[a-zA-Z0-9]+$/;
	exp_d = /^[,\\@\\?\\$\\.\\'\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/;

	if (up_username == '') {
		M.toast({ html: 'El campo usuario no puede estar vacio' })
		return;
	} else if (!expresion.exec(up_username)) {
		M.toast({ html: 'En el campo Usuario, no se permiten carácteres especiales ni espacios' })
		return;
	}
	if (up_email == '') {
		M.toast({ html: 'El campo email no puede estar vacio' })
		return;
	} else if (!email_expresion.exec(up_email)) {
		M.toast({ html: 'Por favor introduce un email válido' })
		return;
	}
	if (description == '' ) {
		M.toast({ html: 'El campo acerca de mi no puede estar vacio' })
		return;
	} else if (!exp_d.exec(description)) {
		M.toast({ html: 'En el campo acerca de mi, no se permiten algunos, carácteres especiales' })
		return;
	}

	var ajax = new XMLHttpRequest();
	var URL = 'ajax/users.ajax.php';
	var method = 'POST';
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var response = ajax.responseText;
			if (response == "ok") {
				window.location.reload()
				M.toast({ html: 'Su perfil se actualizo correctamente' })
			} else if (response == "email_invalido"){
				M.toast({ html: 'El email enviado no es válido' })
			} else if (response == "user_name_invalido") {
				M.toast({ html: 'El usuario enviado no es válido' })
			} else if (response == "description_invalido") {
				M.toast({ html: 'La descripcion enviado no es válido' })
			} else if (response == "campos_vacios"){
				M.toast({ html: 'Algunos de los campos enviados están vacios' })
			}
		}
	};
	ajax.open(method, URL, true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("up_username=" + up_username + "& up_email=" + up_email + "& description=" + description + "& iduser=" + iduser);
}

/*=============================================
VALIDANDO FORMULARIO LOGIN
=============================================*/
$('.login_ajax').on('click', function () {
	var lg_username = document.querySelector('#lg_username').value;
	var lg_password = document.querySelector('#lg_password').value;
	var fr_login = "ok";

	expresion = /^[a-zA-Z0-9\\@\\.\\_]+$/;

	if (lg_username == '') {
		M.toast({ html: 'El campo usuario no puede estar vacio' })
		return;
	} else if (!expresion.exec(lg_username)) {
		M.toast({ html: 'En el campo Usuario, no se permiten carácteres especiales ni espacios' })
		return;
	}
	if (lg_password == '') {
		M.toast({ html: 'El campo contraseña no puede estar vacio' })
		return;
	} else if (!expresion.exec(lg_password)) {
		M.toast({ html: 'En el campo Contraseña, no se permiten carácteres especiales ni espacios' })
		return;
	}

	var ajax = new XMLHttpRequest();
	var URL = 'ajax/users.ajax.php';
	var method = 'POST';
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var response = ajax.responseText;
			if (response == "user_name_invalido") {
				M.toast({ html: 'El usuario o email enviado no es válido' })
			} else if (response == "password_invalido") {
				M.toast({ html: 'El password enviado no es válido' })
			} else if (response == "campos_vacios") {
				M.toast({ html: 'Algunos de los campos enviados estan vacios' })
			} else if (response == "ok") {
				window.location = 'perfil';
			} else if (response == "no_existe") {
				M.toast({ html: 'Usuario y/o contraseña incorrectos' })
			}
		}
	};
	ajax.open(method, URL, true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("lg_username=" + lg_username + "& lg_password=" + lg_password + "& fr_login=" + fr_login);
})

/*=============================================
SUBIENDO IMAGEN DE PERFIL
=============================================*/
function upload_picture() {
	var frmP = new FormData($('#frmPicture')[0]);
	$.ajax({
		url: 'ajax/users.ajax.php',
		type: 'POST',
		data: frmP,
		contentType: false,
		processData: false,
		success: function(response) {
			M.toast({html: 'Foto actualizada'});
			$('#frmPicture')[0].reset();
			$('#refresp').attr('src', response);
		}
	});
}

/*=============================================
SUBIENDO BANNER DE PERFIL
=============================================*/
function upload_banner() {
	var frmP = new FormData($('#frmBanner')[0]);
	$.ajax({
		url: 'ajax/users.ajax.php',
		type: 'POST',
		data: frmP,
		contentType: false,
		processData: false,
		success: function (response) {
			M.toast({ html: 'Banner actualizado' });
			$('#frmBanner')[0].reset();
			$('.refresB').attr('src', response);
		}
	});
}

/*=============================================
PAGINACION
=============================================*/

$('.show_cascade').on('click', function(){

	let value =$('.paginate').attr('cargar');
	$.ajax({
		url: 'ajax/articles.ajax.php',
		type: 'POST',
		data: "cascada_page="+value,
		cache: false,
		processData: false,
		dataType: "json",
		beforeSend: function(){
			$(".progress_paginate").show();
		},
		success: function(data){
			if (data['error'] == 'error') {
				$(".progress_paginate").fadeOut(600);
				$(".show_cascade").fadeOut(600);
				M.toast({ html: 'No se encontraron mas articulos' });
			}else{
				$(".progress_paginate").slideUp(600);

				data.forEach(functionForEach);

				function functionForEach(item, index){
					//console.log("item", item);
					var titulo = item[1],
						descripcion = item[2].substr(0, 120),
						imagen = item[3],
						ruta = item[4],
						visitas = item[6],
						comentarios = item[7],
						picture = item[14],
						usuario = item[10];

					if (imagen != '') {
						var imagen = "images/articles/" + item[3];
					}else{
						var imagen = "images/hero.jpg";
					}

					if (picture != '') {
						var picture = "images/users/" + item[14];
					}else{
						var picture = "images/person.png";
					}
					$('#cascade_articles .row').append(`
					<div class="col s12 m4">
	    				<div class="card">
				        <div class="card-image scalar">
				        	<a href="!#" class="modal-trigger" data-target="open_modal" onclick="open_modal_item('${ruta}');">
				          		<img src="${imagen}">
				        	</a>
				        </div>
				        <div class="card-content">
				        	<div class="autor right">
				        		<a href="#" class="circle">
									<img src="${picture}" width="60" class="circle" alt="">
					        	</a>
				        	</div>
				        	<a href="!#" >
				          	<span class="card-title modal-trigger" data-target="open_modal" onclick="open_modal_item('${ruta}');">${titulo}</span>
				          </a>
				          <p>${descripcion}</p>
				          <div class="card-footer">
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Comentarios: ${comentarios}">
					        		<i class="material-icons">comment</i>
					        	</a>
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Visitas: ${visitas}">
					        		<i class="material-icons">group</i>
					        	</a>
					        </div>
				        </div>
				      </div>
	    			</div>
					`);
				};
				$('.tooltipped').tooltip();
			}
		}
	})
});


/*=============================================
VALIDANDO FORM DE ARTICULO
=============================================*/
function add_post() {
	var title = document.querySelector('#title').value;
	var description = document.querySelector('#description').value;
	
	exp = /^[,\\@\\?\\$\\.\\'\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/;

	if (title == '') {
		M.toast({ html: 'El campo titulo no puede estar vacio' })
		return;
	} else if (!exp.exec(title)) {
		M.toast({ html: 'En el campo titluto, no se permiten algunos carácteres especiales' })
		return;
	}
	if (description == '') {
		M.toast({ html: 'El campo descripcion no puede estar vacio' })
		return;
	} else if (!exp.exec(description)) {
		M.toast({ html: 'En el campo descripcion, no se permiten algunos carácteres especiales' })
		return;
	}

	var formD = new FormData($('#newArticle')[0]);

	$.ajax({
		url: 'ajax/articles.ajax.php',
		type: 'POST',
		data: formD,
		contentType: false,
		processData: false,
		success: function(response) {
			if (response == "ok") {
				M.toast({ html: 'Articulo agregado correctamente' });
				$('#newArticle')[0].reset();
			}
			
		}
	});

}

/*=============================================
MOSTRAR INFORMACION DEL ARTICULO
=============================================*/
function open_modal_item(value){
	$.ajax({
		url: 'inc/item.php',
		type: 'POST',
		data: 'value=' + value,
		success: function (response){
			$('.res_modal').html(response);
		}
	});
}