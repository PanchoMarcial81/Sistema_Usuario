<?php include ('header.php');

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
				<img src="images/hero.jpg">
			<?php else: ?>
				<img src="<?php echo url.'images/banners/'. $fech['banner']; ?>">
			<?php endif; ?>
	      </div>
	      <div class="content-parallx center">
      		<figure>
				<?php if ($fech['picture'] == ''): ?>
					<img src="images/person.png" width="100" class="circle-img" alt="">
				<?php else: ?>
					<img src="<?php echo url.'images/users/'. $fech['picture']; ?>" width="100" class="circle-img" alt="">
				<?php endif; ?>
      		</figure>
      		<h2 class="name-user"><?php echo $fech['user_name'] ?></h2>
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


<?php include ('footer.php'); 
mysqli_free_result($result);
?>