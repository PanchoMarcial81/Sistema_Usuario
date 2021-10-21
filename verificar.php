<?php
require_once 'db_conexion.php';
if (isset($_GET['verificar'])) {
	$token = $_GET['verificar'];
	$stmt = $conn->prepare("UPDATE ud_users SET status= 1 WHERE token = ?");
	$stmt->bind_param("s", $token);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FactorSystem | Usuarios</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobbile-web-app-capable" content="yes">
	<meta name="apple-mobbile-web-app-title" content="">

	<link rel="icon" href="images/isotipo.png">
	<meta name="title" content="USERS">
	<meta name="description" content="Administracion de usuarios">
	<meta name="keyword" content="suers, perfil, web">

	<!-- CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- JAVASCRIPT -->
	<script src="js/materialize.min.js"></script>
</head>
<body>
	<!-- HEADER -->
	<header class="navbar-fixed index-1">
		<nav class="blue">
			<div class="container">
				<div class="nav-wrapper">
			      <a href="#!" class="brand-logo left">
			      	<img src="images/logo.png" width="150" >
			      </a>
			      <a href="#" data-target="nav-mobil" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
			      <ul class="right hide-on-med-and-down">
			        <li><a href="#">Articulos</a></li>
			        <li><a href="#" class="waves-effect waves-light btn red">Registro</a></li>
			      </ul>
			    </div>
			</div>
		</nav>

	    <ul class="sidenav" id="nav-mobil">
		    <li><a href="#">Articulos</a></li>
	        <li><a href="#" class="waves-effect waves-light btn red">Registro</a></li>
	  	</ul>
	</header>

	<!-- HERO -->
	<section class="section-hero">
		<div class="hero">
			<div class="container">
				<?php if ($stmt->execute()): ?>
				<div class="container-hero">
					<h2 class="title-hero">
						Bienvenido cuenta verificada
					</h2>
					<p>Su cuenta se a verificado puede ingresar</p>
					<a href="login.php" class="waves-effect waves-light btn blue darken-1">Ingresar</a>
				</div>
				<?php else: ?>
				<div class="container-hero">
					<h2 class="title-hero">
						Ocurrio un error al verificar su cuenta
					</h2>
					<a href="register.php" class="waves-effect waves-light btn red darken-1">Registro</a>
				</div>
				<?php endif; ?>
			</div>
			
		</div>
	</section>

	<!-- FOOTER -->
	<footer class="black">
		<div class="container">
			<p class="copy">
				&copy; Todos los derechos reservados - Sistema de Usuarios
			</p>
		</div>
	</footer>
	<script src="js/app.js"></script>
</body>
</html>

<?php 
//Cerrar sentencia
$stmt->close();
}else{
	header('Location:'.url);
	exit();
}
?>