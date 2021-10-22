<?php
require_once 'db_conexion.php';
include ('header.php');

if (isset($_GET['verificar'])) {
	$token = $_GET['verificar'];
	$stmt = $conn->prepare("UPDATE ud_users SET status= 1 WHERE token = ?");
	$stmt->bind_param("s", $token);

?>


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

	
<?php 

include ('footer.php');
//Cerrar sentencia
$stmt->close();
}else{
	header('Location:'.url);
	exit();
}
?>