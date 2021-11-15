<?php include ('header.php');

if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
	header('Location:'.url);
	exit();
};

$iduser = $_SESSION['id'];

$consulta = sprintf("SELECT * FROM ud_users WHERE id = %s",
					limpiar($iduser, "int"));
$result = mysqli_query($conn, $consulta);
$fech = mysqli_fetch_assoc($result);

?>
	<!-- PROFILE -->
	<main role="main" class="user-profile">
		<div class="parallax-container profile">
	      <div class="parallax">
			<?php if ($fech['banner'] == ''): ?>
				<img src="images/hero.jpg" class="refresB">
			<?php else: ?>
				<img src="<?php echo url.'images/banners/'. $fech['banner']; ?>" class="refresB">
			<?php endif; ?>
	      </div>
	      <div class="content-parallx center">
			<a href="javascript:void(0)" onclick="$('#upPicture').click();">
				<figure>
					<?php if ($fech['picture'] == ''): ?>
						<img src="images/person.png" width="100" class="circle" alt="" id="refresp">
					<?php else: ?>
						<img src="<?php echo url.'images/users/'. $fech['picture']; ?>" width="100" height="100" class="circle" alt="" id="refresp">
					<?php endif; ?>
				</figure>
			</a>
			<form onsubmit="return false" id="frmPicture" class="hidde">
				<input type="file" id="upPicture" name="upPicture" onchange="upload_picture();">
				<input type="hidden" name="userid" value="<?php echo base64_encode($fech['id']); ?>">
				<input type="hidden" name="username" value="<?php echo $fech['user_name']; ?>">
			</form>
      		<h2 class="name-user"><?php echo $fech['user_name']; ?></h2>
			<a href="javascript:void(0)" class="btn-banner" onclick="$('#upBanner').click();">
				<span class="material-icons white-text">image</span>
			</a>
			<form onsubmit="return false" id="frmBanner" class="hidde">
				<input type="file" id="upBanner" name="upBanner" onchange="upload_banner();">
				<input type="hidden" name="userid" value="<?php echo base64_encode($fech['id']); ?>">
				<input type="hidden" name="username" value="<?php echo $fech['user_name']; ?>">
			</form>
      	  </div>
	    </div>
	    <div class="container">
	    	<article class="center">
	    		<h3>Sobre mi</h3>
	    		<figcaption>
	    			<?php echo $fech['description'] ?>
	    		</figcaption>
	    	</article>
	    	<div class="articles-post-user-profile">
	    		<div class="row">
	    			<div class="col s12 m4">
	    				<div class="card">
				        <div class="card-image scalar">
				        	<a href="#">
				          	<img src="images/hero-profile.jpg">				        		
				        	</a>
				          
				        </div>
				        <div class="card-content">
				        	<div class="autor right">
				        		<a href="#">
					        		<img src="images/person.png" width="60" class="circle-img" alt="">
					        	</a>
				        	</div>
				        	<a href="#" >
				          	<span class="card-title">Nuevo articulo</span>
				          </a>
				          <p>I am a very simple card. I am good at containing small bits of information.
				          I am convenient because I require little markup to use effectively.</p>
				          <div class="card-footer">
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
					        		<i class="material-icons">comment</i>
					        	</a>
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
					        		<i class="material-icons">group</i>
					        	</a>
					        </div>
				        </div>
				        
				      </div>
	    			</div>
	    			<div class="col s12 m4">
	    				<div class="card">
				        <div class="card-image scalar">
				        	<a href="#">
				          	<img src="images/hero-profile.jpg">				        		
				        	</a>
				          
				        </div>
				        <div class="card-content">
				        	<div class="autor right">
				        		<a href="#">
					        		<img src="images/person.png" width="60" class="circle-img" alt="">
					        	</a>
				        	</div>
				        	<a href="#" >
				          	<span class="card-title">Nuevo articulo</span>
				          </a>
				          <p>I am a very simple card. I am good at containing small bits of information.
				          I am convenient because I require little markup to use effectively.</p>
				          <div class="card-footer">
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
					        		<i class="material-icons">comment</i>
					        	</a>
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
					        		<i class="material-icons">group</i>
					        	</a>
					        </div>
				        </div>
				        
				      </div>
	    			</div>
	    			<div class="col s12 m4">
	    				<div class="card">
				        <div class="card-image scalar">
				        	<a href="#">
				          	<img src="images/hero-profile.jpg">				        		
				        	</a>
				          
				        </div>
				        <div class="card-content">
				        	<div class="autor right">
				        		<a href="#">
					        		<img src="images/person.png" width="60" class="circle-img" alt="">
					        	</a>
				        	</div>
				        	<a href="#" >
				          	<span class="card-title">Nuevo articulo</span>
				          </a>
				          <p>I am a very simple card. I am good at containing small bits of information.
				          I am convenient because I require little markup to use effectively.</p>
				          <div class="card-footer">
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Comentarios: 200">
					        		<i class="material-icons">comment</i>
					        	</a>
					        	<a href="#" class="tooltipped" data-position="top" data-tooltip="Visitas: 1500">
					        		<i class="material-icons">group</i>
					        	</a>
					        </div>
				        </div>
				        
				      </div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</main>

	<div class="fixed-action-btn">
		<a class="btn-floating btn-large red">
			<i class="large material-icons">mode_edit</i>
		</a>
		<ul>
			<li><a class="btn-floating green modal-trigger" href="#newPost"><i class="material-icons">create</i></a></li>
			<li><a class="btn-floating blue modal-trigger" href="#editDates"><i class="material-icons">person</i></a></li>
		</ul>
	</div>

	<!-- MODAL EDIT USER -->
	
	<!-- Modal Structure -->
	<div id="editDates" class="modal">
		<div class="modal-content">
			<div class="center">
				<h4>Editando datos de perfil</h4>
				<form onsubmit="return false" class="editUser">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" id="up_username" class="validate" value="<?php echo $fech['user_name']; ?>" readonly>
							<label for="up_username">Usuario</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">email</i>
							<input type="email" id="up_email" class="validate" value="<?php echo $fech['email']; ?>" readonly>
							<label for="up_email">Email</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<textarea id="description" class="materialize-textarea"><?php echo $fech['description']; ?></textarea>
							<label for="description">Acerca de</label>
						</div>
						<input type="hidden" id="iduser" value="<?php echo base64_encode($fech['id']); ?>">
						<div class="col s12">
							<div class="center">
								<button type="submit" class="waves-effect wares-light btn blue" onclick="update_user();">
									Actualizar datos
								</button>
							</div>
						</div>	
					</div>
					
				</form>
			</div>
		</div>
	</div>

	<!-- Modal POSTS -->
	<div id="newPost" class="modal">
		<div class="modal-content">
			<div class="center">
				<h4>Agregando un nuevo articulo</h4>
				<form onsubmit="return false" id="newArticle">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<input type="text" id="title" name="title" class="validate" >
							<label for="title">Titulo</label>
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">mode_edit</i>
							<textarea id="description" name="description" class="materialize-textarea"></textarea>
							<label for="description">Descripcion</label>
						</div>
						<div class="col s12">
							<div class="file-field input-field">
								<div class="btn">
									<span>File</span>
									<input type="file" id="images_files" name="images_files">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text">
								</div>
							</div>
						</div>
						<input type="hidden" id="userid" name="userid" value="<?php echo base64_encode($fech['id']); ?>">

						<div class="col s12">
							<div class="center">
								<button type="submit" class="waves-effect wares-light btn blue" onclick="add_post();">
									Publicar
								</button>
							</div>
						</div>	
					</div>
					
				</form>
			</div>
		</div>
	</div>

<?php include ('footer.php'); 
mysqli_free_result($result);
?>