<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
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



<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 

<script type="text/javascript" src="js/lib.js"></script>



<style type="text/css">
	
	#contact-form input[type="text"],
	#contact-form input[type="email"],
	#contact-form input[type="number"]
	 {
		border-radius: 4px 4px 4px 4px;
		color: #555555;
		display: inline-block;
		font-size: 14px;
		height: 30px;
		line-height: 20px;
		margin-bottom: 10px;
		padding: 4px 6px;
		vertical-align: middle;
	}

</style>
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
<div class="container_12" id="content">

	<div class="mod vet-talk-mod  terms" id='mainArticle'>
		<div class="mod-header">
			<h2>Contact Us</h2>
		</div>
		<div class="clearfix mod-content">
			<div><!-- scrolleable -->
				<div class="vet-talk-article clearfix"> 
					<div class="blind">
						<div class="terms_scroll" id="aboutText">
							<div class="bg-txt-featured-modules">
								<p>If you have any questions about this site, the practices of this site, or your dealings 
								with this site, please contact us by filling this form in:<br><br>

									</p><br><br>

										<form action="ajax/contact.php" method="post" enctype="multipart/form-data" id="contact-form" >

											<label for="name">Full Name</label>
											<input type="text" class="form-element" name="name" id="name" required /><br>

											<label for="email">Email</label>
											<input type="email" class="form-element" name="email" id="email" required /><br>

											<label for="phone">Phone / Mobile</label>
											<input type="number" class="form-element" name="phone" id="phone" required /><br>

											<!-- <label for="message">Subject</label>
											<input type="text" class="form-element" name="subject" id="subject"  /> -->


											<label for="message">Message</label>
											<textarea class="form-element" name="story" id="message" required></textarea><br>

											<input type="submit" class="btn">

										</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<script type="text/javascript">
	start_scroll('terms_scroll', false);
</script>

</body>
</html>
