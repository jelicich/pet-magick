				<div id="admin" class="mod grid_12 clearfix profiles-mod">

					<div class="mod-header">
						<h2>Admin</h2>
					</div>
					
					<div class="mod-content clearfix">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#organization" data-toggle="tab">Organizations</a></li>
							<li><a href="#project" data-toggle="tab">Projects</a></li>
						<?php

						if(isset($_SESSION['rank'] )){ 
							$sessionRank = $_SESSION['rank'];
						}else{
							$sessionRank = 0;
						}


						if($sessionRank == 1 || $sessionRank == 2)
						{
						?>
							<li><a href="#vet-talk" data-toggle="tab">Vet Talk Articles</a></li>
							<li><a href="#vtquestions" data-toggle="tab">Vet Talk Questions</a></li>
						<?php
						}

						?>
							<li><a href="#passwordTab" data-toggle="tab">Password</a></li>
						</ul><!-- end navtabs -->


						<div class="tab-content">
							




							<!-- ORGSS HERE -->
							<div class="tab-pane active" id="organization">
								
								<?php
									include_once 'php/classes/BOOrganizations.php';
									$org = new BOOrganizations;
									include_once 'templates/adminOrganizations.php';
								?>
								
							</div>
							




							<!-- PROJECTS HERE -->
							<div class="tab-pane" id="project">

								<?php
									include_once 'php/classes/BOProjects.php';
									$pro = new BOProjects;
									include_once 'templates/adminProjects.php';
								?>

							</div>
						






						<?php
						if($sessionRank == 1 || $sessionRank == 2)
						{
						?>

						<!-- VET ARTICLES HERE -->
							<div class="tab-pane" id="vet-talk">
								<?php
									include_once 'php/classes/BOVettalk.php';
									$vt = new BOVettalk;
									include_once 'templates/adminVettalk.php';
								?>
							</div>
							
						<!-- VET QUESTIONS HERE -->
							
						<?php
							
							include_once 'templates/adminVetqa.php';
						}
						?>


							<!-- EDIT PASSWORD HERE -->
							<div class="tab-pane" id="passwordTab">

								<label for="password">Enter your actual password</label>
								<input type="password" name="password" id="password" />

								<label for="newPassword">Enter your new password</label>
								<input type="password" name="newPassword" id="newPassword" />
								<input type="button" name="update" value="Update" id="update" class="btn btn-admin" />

						 	</div>		

						 </div><!-- end tab content -->

					</div><!-- end mod contet -->
					
				</div><!-- end admin -->

<?php
		if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
				updatePassword(<?php echo $_SESSION['id']; ?>);
			</script>
<?php
}
?>