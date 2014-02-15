<?php


if(isset($_GET['active'])){

	$active = $_GET['active'];
}

?>

<div class="row-fluid clearfix ">
	<div class="navbar navbar-fixed-top navbar-static-top">
		<div class="navbar-inner">
		    <div class="container">

		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" >
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>

		      <a class="brand" href="index.php"><h1>Pet Magick admin panel</h1></a>

		      <div class="nav-collapse collapse">
		        <ul class="nav" style="padding: 10px; ">
		        	<li class=<?php if(isset($active) && $active == 1) echo "active"; ?>><a href="pop-ups.php?active=1">Pop-ups content</a></li>
					<li class=<?php if(isset($active) && $active == 2)  echo "active"; ?>><a href="advertisement.php?active=2" >Advertisement</a></li>
					<li class=<?php if(isset($active) && $active == 3)  echo "active"; ?>><a href="php/logout.php?active=3" id="logout" >Logout</a></li>
				</ul>
		      </div>
		 
		    </div>
		</div>
	</div>
</div>	


	