<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	
	include_once "php/classes/BOUsers.php";
	include_once "php/classes/BONews.php";
	include_once "php/classes/BOPets.php";
	include_once "php/classes/BOAnimalCategories.php";
	
	
	$u = new BOUsers;
	$n = new BONews;
	$p = new BOPets;
	$ac = new BOAnimalCategories;

	$u->getUserData($_GET['u']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />

<script type="text/javascript" src="js/lib.js"></script>

<?php
	//imprimo lo necesario para el datepicker
	if($u->isOwn())
	{
		echo 
		'<link rel="stylesheet" type="text/css" href="datepicker/css/ui-lightness/datepicker.css" />
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript">	
			$(document).ready(function() {
			   $("#tr-since").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-thru").datepicker({dateFormat: "yy-mm-dd"});
			   $("#tr-since").css("cursor","pointer");
			   $("#tr-thru").css("cursor","pointer");
			});
		</script>';
	}
?>

</head>

<body>
<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>


	<!-- site content -->
	<div class="container_12" id="content">

		

			<!-- about module -->
			<div class="mod grid_12 profiles-mod nogrid-mod" id="user-about">
				<?php 
					include_once 'templates/userAbout.php'; 
				?>
			</div>
			<!-- END about module -->






		<!-- my pets -->
		<div class="grid_5">
			<div class="mod  profiles-mod" id="pet-list">
				
				<?php
					$pets = $p->getPetList($_GET['u']);
					include_once 'templates/petList.php';
				?>

				
			</div>
			<!-- END my pets -->


			<!-- news -->
			<?php 
				include_once 'templates/userNews.php'; 
			?>
			<!-- END news -->
			
		</div>
		<!-- END left -->


		<!-- pet profile -->


		<div id="pet-profile" class="mod grid_7 profiles-mod nogrid-mod ">


			<?php 
				if($p->getPetList($_GET['u']))
				{	
					$p->getPetData($pets[0]['ID_PET']);
					include_once 'templates/petProfile.php';
			?>		
					
			<?php 
				}//END IF pets
			?>
	
		</div>
		<!-- END my pet profile -->

		<!-- user album -->
		<div id='user-album' class="mod grid_12 profiles-mod clearfix">
			<?php
				include_once 'templates/userAlbum.php'; 
			?>
		</div>
		<!-- END user album -->

		<?php
		//OPCIONES PARA SECCIONES EXTERNAS
			if($u->isOwn())
			{
		?>
				<div id="admin" class="mod grid_12 clearfix profiles-mod">

					<div class="mod-header">
						<h2>Admin</h2>
					</div>
					<div id="tribute">
						<h3>Create tribute</h3>
						<?php
							if(isset($_GET['error']))
							{	
								var_dump($_GET);
								echo '<ul class="error-tribute">';
								foreach ($_GET as $key => $value) 
								{
									switch ($key)
									{
										case 'ti':
											echo '<li>The title filed is mandatory</li>';
											break;
										
										case 'co':
											echo '<li>The message field is mandatory</li>';
											break;

										case 'na':
											echo '<li>The name filed is mandatory</li>';
											break;

										default:
											break;
									}
								}
								echo '</ul>';
							}
						?>
						<form method="post" action="php/createTribute.php">
							<label for="tr-title">Tribute title*</label>
							<input type="text" name="title" id="tr-title"/>

							<label for="tr-img">Image</label>
							<input type="file" id="tr-img" name="img"/>

							<label for="tr-content">Message*</label>
							<textarea name="content"></textarea>

							<label for="tr-name">Pet Name*</label>
							<input type="text" name="name" id="tr-name"/>

							<label for="tr-breed">Breed</label>
							<input type="text" name="breed" id="tr-breed"/>

							<label for="tr-since">Since</label>
							<input type="text" name="since" id="tr-since" readonly="readonly"/>

							<label for="tr-thru">Thru</label>
							<input type="text" name="thru" id="tr-thru" readonly="readonly" />

							<label for="tr-pet">Is this one of your pets in your profile?</label>
							<select name="pet" id="tr-pet">
								<option></option>
								<?php

									
									if($pets) 
									{
										
										for($i = 0; $i < sizeof($pets); $i++)
										{	
											

								?>
											<option value=<?php echo '"'.$pets[$i]['ID_PET'].'"' ?>>
												<?php echo $pets[$i]['NAME'] ?> 
											</option>
								<?php
										
										}//END FOR
									
									}//END IF 
								?>
							</select>
							<p>* Mandatory fields</p>
							<input type="hidden" name="u" value=<?php echo '"'.$_GET['u'].'"'?> />
							<input type="submit" value="Create" />

						</form>
					</div><!-- end tribute -->
				</div><!-- end admin -->
		<?php 
			}
		?>
	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>


</div>
<!-- END wrapper-->

<script type="text/javascript">
	//profile();
	news();
	//deletePet();
	//addPet();
</script>

</body>
</html>
