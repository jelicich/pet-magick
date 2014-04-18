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
							<li><a href="#deleteTab" data-toggle="tab">Account</a></li>
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

								<label for="password">Enter your current password</label>
								<input type="password" name="password" id="password" />

								<label for="newPassword">Enter your new password</label>
								<input type="password" name="newPassword" id="newPassword" />
								<input type="button" name="update" value="Update" id="update" class="btn btn-admin" />

						 	</div>

						 	<div class="tab-pane" id="deleteTab">

								<p>If you don't want to keep your Pet Magick account in Pet Magick you can delete it by clicking the button bellow. <br/>Please take into account that all the information (including media files) will be deleted as well and it won't may be recovered.</p>
								<button class="btn btn-danger" id="btn-delete-account">Delete Account</button>

						 	</div>		

						 </div><!-- end tab content -->

					</div><!-- end mod contet -->
					
				</div><!-- end admin -->

<?php
		if(isset($_SESSION['id'])){
?>
			<script type="text/javascript">
				updatePassword(<?php echo $_SESSION['id']; ?>);
				function deleteAccount()
				{
					if(byid('btn-delete-account'))
					{
						byid('btn-delete-account').onclick = function()
						{
							byid('modal-edit-container').style.display='block';
							var html = '<div id="modal-edit" class="edit-scrollable"><div class="mod-header"><h2>Delete Account</h2></div><div class="mod-content"><p>Are you sure you want to delete your account?</p><button class="btn btn-danger" id="confirm-delete">Yes</button><button class="btn" id="cancel-delete">No</button></div>';
							printEdit('modal-edit',html);
							byid('cancel-delete').onclick = function(){cancelDelete();}
							byid('confirm-delete').onclick = function(){confirmDelete();}
						}
					}
				
					function cancelDelete()
					{
						byid('modal-edit-container').style.display='none';
						printEdit('modal-edit','<img class="loading" src="img/loading.gif" width="208" height="13" />');
					}
					function confirmDelete()
					{
						ajax('POST', 'ajax/login.php', printEditDeleteUsr, vars, true);
					}
					function printEditDeleteUsr()
					{
						printEdit('modal-edit', this.responseText);
						setTimeout(function()
						{
							window.location.href='www.petmagick.com';
						}, 3000);
					}
				}
				
				deleteAccount();




			</script>
			
<?php
}
?>