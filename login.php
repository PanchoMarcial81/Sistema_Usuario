<?php include ('header.php'); ?>

	<!-- HERO -->
	<section class="section-hero">
		<div class="hero">
			<div class="container">
				<div class="container-form">
					<div class="card">
						<form onsubmit="return false" id="formL">
							<div class="row">
								<div class="input-field col s12">
						          <i class="material-icons prefix">account_circle</i>
						          <input type="text" id="lg_username" class="validate">
						          <label for="icon_prefix">Ingresa tu Usuario o Email</label>
								</div>
								
								<div class="input-field col s12">
						          <i class="material-icons prefix">lock_outline</i>
						          <input type="password" id="lg_password" class="validate">
						          <label for="icon_prefix">Contraseña</label>
								</div>
								
								<div class="col s12">
									<div class="center">
										<input type="submit" class="waves-effect wares-light btn blue login_ajax" value="Ingresar">
									</div>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</section>

<?php include ('footer.php'); ?>