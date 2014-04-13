<?php



if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$featuredOrg = $org->getOrganizationsRamdom();
	//var_dump($featuredOrg);
	$userId = $featuredOrg['USER_ID'];
	$albumId = $featuredOrg['ALBUM_ID'];
	$name =  htmlspecialchars($featuredOrg['NAME']);
	$description = htmlspecialchars($featuredOrg['DESCRIPTION']);

	$orgAlbum = $pics->table->getPicsByAlbum($albumId);

	//var_dump($orgAlbum); exit;

	if(!isset($orgAlbum[0]['THUMB'])){ $srcImg = 'img/organizations/thumb/default.jpg'; }
	else{ $srcImg = 'img/organizations/thumb/'.$orgAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
	//if(!isset($featuredOrg['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	//else{ $srcImg = $featuredOrg['Pics']['PIC']; }

}else{

	$org = new BOOrganizations;
	$pics = new BOPics;
	$featuredOrg= $org->getOrganizationsById($_GET['p']);
	//var_dump($featuredOrg);
	$userId = $featuredOrg[0]['USER_ID'];
	$albumId = $featuredOrg[0]['ALBUM_ID'];
	$name =  htmlspecialchars($featuredOrg[0]['NAME']);
	$description =  htmlspecialchars($featuredOrg[0]['DESCRIPTION']);
	$orgAlbum = $pics->table->getPicsByAlbum($albumId);
	/*if(!isset($featuredOrg[0]['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredOrg[0]['Pics']['PIC']; } */
	if(!isset($orgAlbum[0]['THUMB'])){ $srcImg = 'img/organizations/thumb/default.jpg'; }
	else{ $srcImg = 'img/organizations/thumb/'.$orgAlbum[0]['THUMB']; } // esta deberia ser la primer foto del album
	
	
}
?>


<div class="mod-header">
	<h2><?php echo $name ?> </h2>
</div>

<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<a class='link-img' href=<?php echo $srcImg ?> >
			<img src= <?php echo $srcImg ?> class="thumb-mid"/>
		</a>
		<!-- <h3> <?php// echo $name ?> </h3> -->
		<a class="visit" href= <?php echo "user-profile.php?u=".$userId; ?> ><span>View user profile</span></a>
	</div>

	<div class="blind">
		<div class="scrollable-text" id="organiztionText">
			<div class="bg-txt-featured-modules">
				
				<p><?php echo $description; ?></p>

			</div>
		</div>
	</div>
</div>


<?php

$t = sizeof($orgAlbum);
$flag = 6;
$default = 0;

if(isset($orgAlbum[0]['PIC'])){

?>

<div id="project-album">
<div class="flexslider carousel">
	<ul class="slides">
<?php

for ($i=0; $i < $t; $i++) { 
		
		$srcImg = $orgAlbum[$i]['THUMB'];
?>

		<li>
			<a class='link-img' href= <?php echo "img/organizations/".$srcImg ?> > 
				<img class="thumb-mid" src= <?php echo 'img/organizations/thumb/'.$srcImg; ?> />
			</a> 
		</li>


<?php
} // end for

if($t < $flag){
	$default = $flag - $t;

	for ($i=0; $i < $default; $i++) { 

		echo "<li>
				<a class='link-img' href= 'img/organizations/default.jpg' > 
					<img class='thumb-mid' src= 'img/organizations/thumb/default.jpg' />
				</a> 
			</li>";
		
	}
}

	
?>
	</ul>	
</div>
</div>

<script type="text/javascript">
	flexslider();
</script>

<?php
} //end if
?>










<script type="text/javascript">
	//modalImg();
	show_img('.link-img');
	start_scroll('scrollable-text', false);
</script>