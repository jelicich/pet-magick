<?php



if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$featuredOrg = $org->getOrganizationsRamdom();
	//var_dump($featuredOrg);
	$userId = $featuredOrg['USER_ID'];
	$name =  htmlspecialchars($featuredOrg['NAME']);
	$description = htmlspecialchars($featuredOrg['DESCRIPTION']);
	if(!isset($featuredOrg['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredOrg['Pics']['PIC']; }

}else{

	$org = new BOOrganizations;
	
	$featuredOrg= $org->getOrganizationsById($_GET['p']);
	//var_dump($featuredOrg);
	$userId = $featuredOrg[0]['USER_ID'];
	$name =  htmlspecialchars($featuredOrg[0]['NAME']);
	$description =  htmlspecialchars($featuredOrg[0]['DESCRIPTION']);

	if(!isset($featuredOrg[0]['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredOrg[0]['Pics']['PIC']; }
	
}
?>


<div class="mod-header">
	<h2><?php echo $name ?> </h2>
</div>

<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<a class='link-img' href=<?php echo "img/organizations/".$srcImg ?> >
			<img src= <?php echo "img/organizations/thumb/".$srcImg ?> class="thumb-mid"/>
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

<script type="text/javascript">
	//modalImg();
	show_img('.link-img');
	start_scroll('scrollable-text', false);
</script>