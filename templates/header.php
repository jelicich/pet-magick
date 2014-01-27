<div id="header">
		<!-- yellow bar -->
		<div id="yellow-bar">
			<div class="container_12">
				<!-- logo -->
				
			<a href='index.php'>	<h1 class="grid_2" id="logo-pet-magick">Pet Magick</h1> </a><!-- no se si esto es semantico a- h1-->
				
				<!-- form login  -->
				<!--IF QUE SE FIJA Q SI ESTA LOGUEADO CARGUE EL MENU DE USUARIO EN VEZ DEL LOGIN --> 
				<div id="login-reg">

					<?php 
						//session_destroy();

						if(isset($_SESSION['token']) && isset($_SESSION['email']))
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
				<ul class="grid_10 btn-group">
						<li class="btn btn-small btn-danger"><a href="profiles.php">Profiles</a></li>
						<!--<li class="btn btn-small btn-danger"><a href="#">Formums</a></li> -->
						<li class="btn btn-small btn-danger"><a href="antics.php">Animal Antics</a></li>
						<li class="btn btn-small btn-danger"><a href="vet-talk.php">Vet Talk</a></li>
						<li class="btn btn-small btn-danger"><a href="projects.php">Projects</a></li>
						<li class="btn btn-small btn-danger"><a href="organizations.php">Organizations</a></li>
						<li class="btn btn-small btn-danger"><a href="pet-loss.php">Pet Loss</a></li>
						<li class="btn btn-small btn-danger"><a href="#">Forum</a></li>
						<li class="btn btn-small btn-danger"><a href="#">Blog</a></li>
						<li class="btn btn-small btn-danger">
							<a href="#" class="btn dropdown-toggle btn-small btn-danger" id="dd" data-toggle="dropdown">Groups <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Perro</a></li>
								<li><a href="#">Gato con botas</a></li>
								<li><a href="#">Lazarillo</a></li>
							</ul>
						</li>
				</ul>
				<div class="grid_2" id='searchF'>
					<input type="text" placeholder="Find pet lovers" id='finder' autocomplete="off"/>
					<input type='hidden' id='id-recipientf' name='recipient'/> 
				</div>
			</div>
		</div>
		<!-- END navbar -->
	</div>
	<!-- END header -->