<?php
// INCLUIMOS LA CONEXION A LA BD
require_once '../db_conexion.php';

/*=================================================================
CREAR USUARIO
=================================================================*/
if(isset($_POST['rg_username']) && isset($_POST['rg_email'])){
	
	if ($_POST['rg_email'] !== '' && $_POST['rg_username'] !== '' && $_POST['password'] !== '') {
		if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $_POST['email'])) {
			echo 'email_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['rg_username'])) {
			echo 'user_name_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])) {
			echo 'password_invalido';
			exit();
		}

		$user = $_POST['rg_username'];
		$email = $_POST['rg_email'];
		$password = md5($_POST['password']);
		$description = '';
		$picture = '';
		$banner = '';
		$status = 0;
		$token = md5($_POST['rg_email']);

		$consulta = sprintf("SELECT * FROM ud_users WHERE user_name = %s", limpiar($user, "text"));
		$result = mysqli_query($conn, $consulta);
		$row_cnt = mysqli_num_rows($result);

		if ($row_cnt == 0) {
			$consulta_e = sprintf("SELECT * FROM ud_users WHERE email = %s", limpiar($email, "text"));
			$result_e = mysqli_query($conn, $consulta_e);
			$row_cnt_e = mysqli_num_rows($result_e);

			if ($row_cnt_e == 0) {
				$stmt = $conn->prepare("INSERT INTO ud_users (user_name, email, password, description, picture, banner, status, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
				// Ligar parametros para marcadores
				$stmt->bind_param("ssssssis", $user, $email, $password, $description, $picture, $banner, $status, $token);

				// Ejecutar la consulta
				if ($stmt->execute()) {
					// ENVIOS DE EMAIL DE CONFIRMACION

					$para = $email;
					$titulo = "Verifique su correo electronico";
					$mensaje = "Utilice este enlace ".url."verificar/".$token." para verificar su cuenta";

					// Para enviar un correo HTML, debe establecerse la cabecera Content-type
					$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Cabeceras adicionales
					$cabeceras .= 'From: Sistema de usuario FactorOne <sistema-usuario@gmail.com>' . "\r\n";
					
					// Enviarlo
					mail($para, $titulo, $mensaje, $cabeceras);

					echo 'ok';
				}else{
					echo 'error';
				}

				// Cerrar sentencia
				$stmt->close();
			}else{
				echo 'email_existe';
			}
			mysqli_free_result($result_e);

		}else{
			echo 'user_existe';
		}
		mysqli_free_result($result);

	}else{
		echo 'campos_vacios';
	}
}

/*=================================================================
VALIDANDO DATOS LOGIN
=================================================================*/
if (isset($_POST['fr_login']) && isset($_POST['lg_username']) && isset($_POST['lg_password'])) {

	if ($_POST['lg_username'] !== '' && $_POST['lg_password'] !== '') {

		if (!preg_match("/^[a-zA-Z0-9\\@\\.\\_]+$/", $_POST['lg_username'])) {
			echo 'user_name_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['lg_password'])) {
			echo 'password_invalido';
			exit();
		}

		$user = $_POST['lg_username'];
		$password = md5($_POST['lg_password']);

		$consulta = sprintf("SELECT * FROM ud_users WHERE user_name = %s AND password = %s AND status > 0 OR email = %s AND password = %s AND status > 0", 
							limpiar($user, "text"), 
							limpiar($password, "text"),
							limpiar($user, "text"), 
							limpiar($password, "text"));
		$result = mysqli_query($conn, $consulta);
		$fech = mysqli_fetch_assoc($result);
		$row_cnt = mysqli_num_rows($result);
	
		if ($row_cnt == 1) {

			$_SESSION['id'] = $fech['id'];
			$_SESSION['username'] = $fech['user_name'];

			echo "ok";

		}else{
			echo "no_existe";
		}
		mysqli_free_result($result);

	}else{
		echo 'campos_vacios';
	}
}

/*=================================================================
VALIDANDO DATOS ACTUALIZACION DE PERFIL
=================================================================*/
if (isset($_POST['up_username']) && isset($_POST['up_email']) && isset($_POST['description'])) {

	if ($_POST['up_username'] !== '' && $_POST['up_email'] !== '' && $_POST['description'] !== '') {

		if (!preg_match('/^([a-zA-Z0-9])+$/', $_POST['up_username'])) {
			echo 'user_name_invalido';
			exit();
		}
		else if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $_POST['up_email'])) {
			echo 'email_invalido';
			exit();
		}
		else if (!preg_match('/^[,\\@\\?\\$\\.\\´\\\\¨\\¡\\!\\"\\#a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_ ]+$/', $_POST['description'])) {
			echo 'description_invalido';
			exit();
		}

		$iduser = base64_decode($_POST['iduser']);
		$user = $_POST['up_username'];
		$email = $_POST['up_email'];
		$description = $_POST['description'];

		$stmt = $conn->prepare("UPDATE ud_users SET user_name = ?, email = ?, description = ? WHERE id = ?");
		$stmt->bind_param("sssi", $user, $email, $description, $iduser);
			
		if ($stmt->execute()) {

			echo "ok";

		}else{
			echo "error";
		}

		$stmt->close();		

	}else{
		echo 'campos_vacios';
	}
}

/*=================================================================
SUBIENDO IMAGEN DE PERFIL
=================================================================*/
if (isset($_FILES['upPicture'])) {
	if ($_FILES['upPicture']['type'] == 'image/jpg' || $_FILES['upPicture']['type'] == 'image/jpeg' || $_FILES['upPicture']['type'] == 'image/png') {
		
		$iduser = trim(base64_decode($_POST['userid']));
		$extent = explode('/', $_FILES['upPicture']['type']);
		$name_picture = $iduser.'_'.$_POST['username'].'.'.$extent[1];

		move_uploaded_file($_FILES['upPicture']['tmp_name'], '../images/users/'. $name_picture);

		$stmt = $conn->prepare("UPDATE ud_users SET picture = ? WHERE id = ?");
		$stmt->bind_param("si", $name_picture, $iduser);

		if ($stmt->execute()) {
			echo url."images/users/".$name_picture;
		}else{
			echo "error";
		}

		$stmt->close();

	}else{
		echo "file_no_aceptado";
	}
}

/*=================================================================
SUBIENDO BANNER DE PERFIL
=================================================================*/
if (isset($_FILES['upBanner'])) {

	if ($_FILES['upBanner']['type'] == 'image/jpg' || $_FILES['upBanner']['type'] == 'image/jpeg' || $_FILES['upBanner']['type'] == 'image/png') {
		
		$iduser = trim(base64_decode($_POST['userid']));
		$extent = explode('/', $_FILES['upBanner']['type']);
		$name_banner = $iduser.'_'.$_POST['username'].'.'.$extent[1];

		move_uploaded_file($_FILES['upBanner']['tmp_name'], '../images/banners/'. $name_banner);

		$stmt = $conn->prepare("UPDATE ud_users SET banner = ? WHERE id = ?");
		$stmt->bind_param("si", $name_banner, $iduser);

		if ($stmt->execute()) {
			echo url."images/banners/".$name_banner;
		}else{
			echo "error";
		}

		$stmt->close();

	}else{
		echo "file_no_aceptado";
	}
}