<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	
	include_once "php/classes/BOUsers.php";
	include_once "php/classes/BONews.php";
	include_once "php/classes/BOPets.php";
	include_once "php/classes/BOVideos.php";
	include_once "php/classes/BOAnimalCategories.php";
	include_once "php/classes/BOFavorites.php";
	
	
	$u = new BOUsers;
	$n = new BONews;
	$p = new BOPets;
	$ac = new BOAnimalCategories;
	$v = new BOVideos;
	$f = new BOFavorites;


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
<!-- <script type="text/javascript" src="js/uploader.js"></script> -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<?php
	//imprimo lo necesario para el datepicker
	if($u->isOwn())
	{
		echo 
		'<link rel="stylesheet" type="text/css" href="datepicker/css/ui-lightness/datepicker.css" />
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.10.3.custom.min.js"></script>
		';
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

		<!--====================================================================== favorites test =========================== -->
		<div class="row-fluid"> <!-- div provisorio para contener el testeo -->

			<?php 
				// Ver de no repetir esta llamada aca pq ya la ejecuto en favoritesModule.php
				if(isset($_SESSION['id'])){
					
						$favorites = $f->getFavorite($_SESSION['id']);
						$t = sizeof($favorites);
					
					if($u->isOwn()){
			?>
						<div class="projects-mod mod span5">
							<div class="mod-header">
								<h2>My favorites</h2>
								<span>Keep your favorite pets closer</span>
							</div>
							<ul class="mod-content pet-loss-mod-list talks-list"  id="favorites-mod">
			<?php 
								include_once 'templates/favoritesModule.php'; 
			?>
							</ul>
						</div>
			<?php
					}else{
						
						if($t > 0){

							for ($i=0; $i < $t; $i++) { 
								
								if($favorites[$i]['ID_USER_FAVORITE'] ==  $_GET['u']){

									echo "<div class='alert alert-success text-center span3' ><span>One of your favorites !</span></div>";
									break;

								}else{

									echo "<input type='button'  id='addFavorite' name=".$_GET['u']." value='add favorite' />";
									break;
								}
							}
						}else{

							echo "<input type='button'  id='addFavorite' name=".$_GET['u']." value='add favorite' />";
						}
					}
				}
			?>

		</div>
	<!--====================================================================== favorites test =========================== -->

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
				include_once 'templates/userAdmin.php';
			}
		?>
	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>


</div>
<!-- END wrapper-->
<?php 
		include_once 'templates/player.php'; 
	?>


<script type="text/javascript">
	//profile();
	news();
	//deletePet();
	//addPet();
	vetTalkAnswer();
	favorites();


	
	$('.nav-tabs a').click(function (e)
	{
		e.preventDefault();
		$(this).tab('show');
	});
</script>

</body>
</html>
