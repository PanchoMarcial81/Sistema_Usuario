<?php require_once 'db_conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FactorSystem | Usuarios</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="apple-mobbile-web-app-capable" content="yes">
	<meta name="apple-mobbile-web-app-title" content="">

	<link rel="icon" href="<?php echo url; ?>images/isotipo.png">
	<meta name="title" content="USERS">
	<meta name="description" content="Administracion de usuarios">
	<meta name="keyword" content="suers, perfil, web">

	<!-- CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="<?php echo url; ?>css/normalize.css">
	<link rel="stylesheet" href="<?php echo url; ?>css/materialize.min.css">
	<link rel="stylesheet" href="<?php echo url; ?>css/main.css">

	<!-- JAVASCRIPT -->
	<script src="<?php echo url; ?>js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo url; ?>js/materialize.min.js"></script>
	
</head>

<body>
	<!-- HEADER -->
	<header class="navbar-fixed index-1">
		<nav class="blue">
			<div class="container">
				<div class="nav-wrapper">
			      <a href="inicio" class="brand-logo left">
			      	<img src="<?php echo url; ?>images/logo.png" width="150" >
			      </a>
			      <a href="#" data-target="nav-mobil" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
			      <ul class="right hide-on-med-and-down">
			        <li>
						<a href="<?php echo url; ?>articulos">Articulos</a>
					</li>
					<?php if (isset($_SESSION['id'])): ?>
			        	<li>
							<a href="<?php echo url; ?>perfil" class="waves-effect waves-light btn green darken-1"><?php echo $_SESSION['username']; ?></a>
						</li>
						<li>
							<a href="<?php echo url; ?>salir" class="waves-effect waves-light btn red darken-1">X</a>
						</li>
						<?php else: ?>
						<li>
							<a href="<?php echo url; ?>login">Ingresar</a>
						</li>
						<li>
							<a href="<?php echo url; ?>registro" class="waves-effect waves-light btn red darken-1">Registro</a>
						</li>
					<?php endif; ?>
			      </ul>
			    </div>
			</div>
		</nav>

	    <ul class="sidenav" id="nav-mobil">
		    <li><a href="<?php echo url; ?>articulos">Articulos</a></li>
	        <?php if (isset($_SESSION['id'])): ?>
				<li>
					<a href="<?php echo url; ?>perfil" class="waves-effect waves-light btn green darken-1"><?php echo $_SESSION['username']; ?></a>
				</li>
				<li>
					<a href="<?php echo url; ?>salir" class="waves-effect waves-light btn red darken-1">X</a>
				</li>
				<?php else: ?>
				<li>
					<a href="<?php echo url; ?>login">Ingresar</a>
				</li>
				<li>
					<a href="<?php echo url; ?>registro" class="waves-effect waves-light btn red darken-1">Registro</a>
				</li>
			<?php endif; ?>
	  	</ul>
	</header>