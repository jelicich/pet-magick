<?php

function checklogin(){

      if(!isset($_SESSION['id'])){
        
        header('Location: index.php');

      }//end if
}//end checklogin()
checklogin();

?>



<div class="container-fluid">

	<?php
		include_once("templates/header.php");
	?>

</div>


