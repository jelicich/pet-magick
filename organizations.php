<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOOrganizations.php";
	include_once "php/classes/BOPics.php";
	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
	$org = new BOOrganizations;
	$pics = new BOPics;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pet Magick is a global social network for pet and animal lovers to connect and share the joy that animal companions bring into their life. A place where those grieving with pet loss can get support from others who've been through the same traumatic experience.">
<meta name="keywords" content="pet lovers,pet owners,pet loss,funny pet videos,pet health,animal health,pet information,animal rescue,pet stories,dog club,cat club">
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
 <script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script>  
<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>

<?php 
		include_once 'templates/No_IE.php'; 
?>

<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->

	<div id="content" class="container_12" >

	<div id='what' >
		<a href="#"><p>What is organizations ?</p></a>
		<div class='active'>
			<div id='pop-up' class='mod grid_4 '>

				<p> 
					<?php echo nl2br($pop->getPopUps("organizations")); ?>
				</p>

			</div>
			<div class=' arrow-top'></div>
		</div>
	</div>

	<!-- featured project module -->
	<div class="mod grid_12 org-mod nogrid-mod " id='featured-org'>
		<?php 
			include_once 'templates/featuredOrganizationsModule.php'; 
		?>
	</div>
	<!-- END featured project module -->


	<!-- Current projects module -->
		<?php 
			include_once 'templates/organizationListModule.php'; 
		?>
	<!-- END Current projects module -->


		<div class="publi-org mod grid_4">
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div>
		<div class="publi-org mod grid_4">
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div> 

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->


<script type="text/javascript">
	selectedFromList('featured-org', 'ajax/getSelectedOrg.php?p=');
	start_scroll('scrollable-list-sections', false);
	//start_scroll('scrollable-text');
</script>

</body>
</html>



