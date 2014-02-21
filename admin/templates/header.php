<?php


if(isset($_GET['active'])){
		$active = $_GET['active'];
}

$path = $_SERVER['PHP_SELF'];
$blog = strpos($path, 'wp-admin');

if($blog === false) 
{
	 $href_index = "index.php?active=0";
	 $href_pop = "pop-ups.php?active=1";
	 $href_ads = "advertisement.php?active=2";
	 $href_blog = "../blog/wp-admin/index.php?active=3";
	 $href_vets = "vets.php?active=4";
	 $href_site = "../index.php";
	 $href_logout = "php/logout.php";
	//$href_vets = "vets.php";
}
else
{
	 $href_index = "../../admin/index.php?active=0";
	 $href_pop ="../../admin/pop-ups.php?active=1";
	 $href_ads = "../../admin/advertisement.php?active=2";
	 $href_blog = "index.php?active=3";
	 $href_vets = "../../admin/vets.php?active=4";
	 $href_site = "../../index.php";
	 $href_logout = "../../admin/php/logout.php";
}




?>
<!-- id=just_wp esta solo para acomodar el header en el worpress 
	 y los archivos de WP q toque fueron: wp_admin/index.php y wp_admin/admin-header.php
-->
<div id="just_wp" class="row-fluid clearfix ">
	<div class="navbar navbar-fixed-top navbar-static-top">
		<div class="navbar-inner">
		    <div class="container">

		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" >
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>

		      <a class="brand" href=<?php echo $href_index; ?>><h1>Pet Magick admin panel</h1></a>

		      <div class="nav-collapse collapse">
		        <ul class="nav" style="padding: 10px; ">

		        	<li class=<?php if(isset($active) && $active == 1) echo "active"; ?>><a href=<?php echo $href_pop; ?>>Pop-ups content</a></li>
					<li class=<?php if(isset($active) && $active == 2)  echo "active"; ?>><a href=<?php echo $href_ads; ?> >Advertisement</a></li>
					<li class=<?php if(isset($active) && $active == 3)  echo "active"; ?>><a href=<?php echo $href_blog;?> >Blog &amp; Forums</a></li>
					<li class=<?php if(isset($active) && $active == 4)  echo "active"; ?>><a href=<?php echo $href_vets; ?> >Vets</a></li>
					<li><a href=<?php echo $href_site; ?> >Site</a></li>
					<li><a href=<?php echo $href_logout; ?> id="logout" >Logout</a></li>
				</ul>
		      </div>
		 
		    </div>
		</div>
	</div>
</div>	


	