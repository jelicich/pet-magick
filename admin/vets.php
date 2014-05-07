<?php 
session_start();
include 'php/functions.php';
chkadmin();

include_once "../php/classes/BOUsers.php";
$u = new BOUsers;
$u = $u->getVets();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Pet Magick</title>

		
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/layout.css" type="text/css" />

		<script src="../js/jquery.js"></script> 
	 	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script> 
	 	<script type="text/javascript" src="../js/lib.js"></script> 
	    <script type="text/javascript" src="js/functions.js"></script> 



<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</head>
<body>
<div class="container-fluid" >

<?php
	include_once("templates/header.php");
?>

<div class="alert alert-danger span7" id="alert-vet"><strong>Remeber!</strong> The users must be registered to be able to become a Vet</div>
<div class="well span7  " id="pop-upsModule">
	<div class="tabbable"> 
		<ul class="nav nav-tabs">
		<!--	<li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'new' || !isset($_GET['tab'])) echo "active"; ?>><a href="#new" data-toggle="tab">New</a></li> -->
		    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'existing' || !isset($_GET['tab'])) echo "active"; ?>><a href="#existing" data-toggle="tab" >Admin Vets</a></li>
		    <li class=<?php if(isset($_GET['tab']) && $_GET['tab']== 'delete') echo "active"; ?>><a href="#delete" data-toggle="tab">Delete Vets</a></li>
		   
		</ul>

		<div class="tab-content">
			
		<!--	<div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'new' || !isset($_GET['tab'])) echo "active"; ?>" id="new">
				<form action="php/vets_new.php" method="post" id="vets_new" >
					<label><b><small>Create a new Vet user</small></b></label>
					<input type="text" id="nickname" name="nickname" class="form-control" placeholder="Nick name" required /><br>
				    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus /><br>
				    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required /><br>
				    <input type="password" id="password2" name="password2" class="form-control" placeholder="Password again" required /><br>
				   <!--  <input type="hidden" id="rank" name="rank" class="form-control" value=2 /><br> 

				    <input type="button" class="btn btn-info btn-mini" id="reg" value="Save" />
				</form>
				<div id="here"></div>
			</div>
		-->

		
			<div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'existing'|| !isset($_GET['tab'])) echo "active"; ?>" id="existing">
				<form action="php/becomeVet.php" method="post" id="vetsform" >
					<label><b><small>Modify existing users status</small></b></label>
				    <input type="email" name="email" id="email-log" class="form-control" placeholder="Email address" required autofocus /><br>
				    <label>
				   	 	<input id="yesOrNot" type="radio" name="yesOrNot" value=1 checked> Vet (normal users)
					</label>
				    <label>
				   	 	<input id="yesOrNot" type="radio" name="yesOrNot" value=0> No vet (Vet users)
					</label><br>

				     <a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('vetsform').submit(); return false;" >Save</a>
				</form>
			</div>
	

		
			<div class="tab-pane <?php if(isset($_GET['tab']) && $_GET['tab']== 'delete') echo "active"; ?>" id="delete">
				<form action="php/deleteVet.php" method="post" id="deleteForm" >
					<div class="table-responsive">
					    <table class="table table-bordered table-striped">
					      <thead>
					        <tr>
					           <th> Delete </th>
					           <th> Name </th>
					           <th> Lastname </th>
					           <th> Nickname </th>
					           <th> Email </th>
					        </tr>
					      </thead>
					      <tbody>
					      	<?php
					      			for ($i=0; $i < sizeof($u); $i++) { 
					        ?>
								        <tr>
								        	<td> <input type="checkbox" name="vets[]" value=<?php echo $u[$i]['ID_USER']; ?> /></td>
								        	<td><?php echo $u[$i]['NAME']; ?></td>
								        	<td><?php echo $u[$i]['LASTNAME']; ?></td>
								        	<td><?php echo $u[$i]['NICKNAME']; ?></td>
								        	<td><?php echo $u[$i]['EMAIL']; ?></td>
								        </tr>

					        <?php
					        		}// end for
					        ?>
					      </tbody>
					    </table>
					  </div>
					<a href="#" class="save btn btn-mini btn-info" onclick="document.getElementById('deleteForm').submit(); return false;" >Save</a>
				</form>
			</div>

		</div>
	</div>
</div>



</body>
</html>

<script type="text/javascript">
	//admin_reg(); 
</script>