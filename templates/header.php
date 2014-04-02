<?php

		if(isset($_GET['active'])){
				$active = $_GET['active'];
		}else{

			$active = 1;

		}

		 $href_index = "index.php?active=1";
		 $href_profiles ="profiles.php?active=2";
		 $href_antics = "antics.php?active=3";
		 $href_vet = "vet-talk.php?active=4";
		 $href_projects = "projects.php?active=5";
		 $href_organizations = "organizations.php?active=6";
		 $href_pet_loss = "pet-loss.php?active=7";
		 //$href_forum = "?active=8";
		 //$href_blog = "?active=9";
		


?>


<div id="header">
		<!-- yellow bar -->
		<div id="yellow-bar">
			<div class="container_12">
				<!-- logo -->
				
			<a href='<?php echo $href_index; ?>'>	<h1 class="grid_2" id="logo-pet-magick">Pet Magick</h1> </a><!-- no se si esto es semantico a- h1-->
				
				<!-- form login  -->
				<!--IF QUE SE FIJA Q SI ESTA LOGUEADO CARGUE EL MENU DE USUARIO EN VEZ DEL LOGIN --> 
				<div id="login-reg">

					<?php 
						//session_destroy();
						//var_dump($_SESSION); exit;
						if(isset($_SESSION['id']) && isset($_SESSION['email']))
						{
							include_once 'templates/userMenu.php';
						}
						else
						{
							include_once 'templates/logReg.php';
						}
					?>
					
				</div>
				
			</div>
		</div>
		<!-- END yellow bar -->

		<!-- navbar -->
		<div id="nav-bar">
			<div class="container_12 clearfix">
				<ul class="grid_9 btn-group">
						<li class="<?php if(isset($active) && $active == 1) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_index; ?>">Home</a></li>
						<li class="<?php if(isset($active) && $active == 2) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_profiles; ?>">Profiles</a></li>
						<li class="<?php if(isset($active) && $active == 3) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_antics; ?>">Animal Antics</a></li>
						<li class="<?php if(isset($active) && $active == 4) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_vet; ?>">Vet Talk</a></li>
						<li class="<?php if(isset($active) && $active == 5) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_projects; ?>">Projects</a></li>
						<li class="<?php if(isset($active) && $active == 6) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_organizations; ?>">Organizations</a></li>
						<li class="<?php if(isset($active) && $active == 7) echo "active"; ?> btn btn-small btn-danger"><a href="<?php echo $href_pet_loss; ?>">Pet Loss</a></li>
						<li class="<?php if(isset($active) && $active == 8) echo "active"; ?> btn btn-small btn-danger"><a href="blog/?post_type=forum">Forum</a></li>
						<li class="<?php if(isset($active) && $active == 9) echo "active"; ?> btn btn-small btn-danger"><a href="blog">Blog</a></li>
					<?php
						if(isset($_SESSION['rank']) && $_SESSION['rank'] == 2){
					?>
						<li class="btn btn-small btn-danger"><a href="admin/index.php?active=0">Admin</a></li>
					<?php
						}
					?>
				</ul>
				<div class="grid_3" id='searchF'>
					<input type="text" class="form-control" placeholder="Search..." id='finder' autocomplete="off"/>
					<input type='hidden' id='id-recipientf' name='recipient'/> 
				</div>
			</div>
		</div>
		<!-- END navbar -->
	</div>
	<!-- END header -->

	<!-- Esta libreria es para interpretar JSON en navegadores viejos (IE) -->
	<!--[if lt IE 9]>
	      <script type="text/javascript" src="js/json.js"></script>
	<![endif]-->
