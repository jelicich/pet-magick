<?php

	$favorites = $f->getFavorite($_SESSION['id']);
	$t = sizeof($favorites);

for ($i=0; $i < $t; $i++) { 
		
	  $fd = $f->getFavoriteList($favorites[$i]['ID_USER_FAVORITE']);

	  if(!isset($fd[0]['Pics']['PIC'])){ $srcImg = 'img/projects/thumb/default.jpg'; }
	  else{ $srcImg = "img/users/thumb/".$fd[0]['Pics']['PIC']; } 

	  $nickname = $fd[0]['NICKNAME'];
	  $user_id = $fd[0]['ID_USER'];
?>

	<li id="list-user-fav">
			<img src= <?php echo $srcImg ?> class="thumb-small side-img" />
			<a href=<?php echo 'user-profile.php?u='.$user_id ?> class='linkToModule'  >
				<strong><?php echo $nickname; ?></strong>
			</a><br><!-- remove br!!!!!!! -->
			<!-- <a href=<?php //echo 'user-profile.php?u='.$user_id ?> class='linkToModule'>View profile</a> -->
			<!--<input type="button" class="deleteFavorite" name=<?php //echo $user_id; ?> value="Delete" /> -->
			<a href="<?php echo '#'.$user_id; ?>" class='deleteFavorite btn btn-danger'>Delete</a>
	</li>

<?php
}// end for
?>


<script type="text/javascript">
	start_scroll_profile('favotires', false);
</script>