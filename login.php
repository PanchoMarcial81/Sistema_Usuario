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
				<div class="container-form">
					<div class="card">
						<form onsubmit="return false">
							<div class="row">
								<div class="input-field col s12">
						          <i class="material-icons prefix">account_circle</i>
						          <input id="icon_prefix" type="text" id="username" class="validate">
						          <label for="icon_prefix">Ingresa tu Usuario o Email</label>
								</div>
								
								<div class="input-field col s12">
						          <i class="material-icons prefix">lock_outline</i>
						          <input id="icon_prefix" type="password" id="password" class="validate">
						          <label for="icon_prefix">Contraseña</label>
								</div>
								
								<div class="col s12">
									<div class="center">
										<input type="submit" class="waves-effect wares-light btn blue" value="Ingresar">
									</div>
								</div>	
							</div>
						</form>
					</div>
				</div>
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