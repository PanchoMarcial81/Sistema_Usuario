<?php
// INCLUIMOS LA CONEXION A LA BD
require_once '../db_conexion.php';

if(isset($_POST['user_name']) && isset($_POST['email'])){
	

	if ($_POST['email'] !== '' && $_POST['user_name'] !== '' && $_POST['password'] !== '') {
		if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $_POST['email'])) {
			echo 'email_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['user_name'])) {
			echo 'user_name_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])) {
			echo 'password_invalido';
			exit();
		}

		$user = $_POST['user_name'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$description = '';
		$picture = '';
		$banner = '';
		$status = 0;
		$token = md5($_POST['email']);

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

if (isset($_POST['fr_login']) && isset($_POST['user_name']) && isset($_POST['password'])) {

	if ($_POST['user_name'] !== '' && $_POST['password'] !== '') {

		if (!preg_match("/^[a-zA-Z0-9\\@\\.\\_]+$/", $_POST['user_name'])) {
			echo 'user_name_invalido';
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])) {
			echo 'password_invalido';
			exit();
		}

		$user = $_POST['user_name'];
		$password = md5($_POST['password']);
		
		$consulta = sprintf("SELECT * FROM ud_users WHERE user_name = %s AND password = %s AND status > 0", limpiar($user, "text"), limpiar($password, "text"));
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