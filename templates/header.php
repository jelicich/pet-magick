<?php
		include 'php/functions.php';
?>


<div id="header">
		<!-- yellow bar -->
		<div id="yellow-bar">
			<div class="container_12">
				<!-- logo -->
				
			<a href='index.php'><h1 class="grid_2" id="logo-pet-magick">Pet Magick</h1> </a><!-- no se si esto es semantico a- h1-->
				
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

						<li class="<?php currentPage('index'); ?> btn btn-small btn-danger"><a href="index.php">Home</a></li>
						<li class="<?php currentPage('profile'); ?> btn btn-small btn-danger"><a href="profiles.php">Profiles</a></li>
						<li class="<?php currentPage('antics'); ?> btn btn-small btn-danger"><a href="antics.php">Animal Antics</a></li>
						<li class="<?php currentPage('vet-talk'); ?> btn btn-small btn-danger"><a href="vet-talk.php">Vet Talk</a></li>
						<li class="<?php currentPage('projects'); ?> btn btn-small btn-danger"><a href="projects.php">Projects</a></li>
						<li class="<?php currentPage('organizations'); ?> btn btn-small btn-danger"><a href="organizations.php">Organizations</a></li>
						<li class="<?php currentPage('pet-loss'); currentPage('pet-tribute') ?> btn btn-small btn-danger"><a href="pet-loss.php">Pet Loss</a></li>
						<li class="<?php currentPage('forum'); currentPage('topic'); currentPage('bbp'); ?> btn btn-small btn-danger"><a href="blog/?post_type=forum">Forum</a></li>
						<li class="<?php currentPage(''); ?> btn btn-small btn-danger"><a href="blog">Blog</a></li>
					<?php
						if(isset($_SESSION['rank']) && $_SESSION['rank'] == 2){
					?>
						<li class="btn btn-small btn-danger"><a href="admin/index.php">Admin</a></li>
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
