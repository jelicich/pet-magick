<?php



if(!isset($_GET['p'])){ // tengo q revisar esto pq en lib mando u, no p

	$featuredOrg = $org->getOrganizationsRamdom();
	//var_dump($featuredOrg);
	$userId = $featuredOrg['USER_ID'];
	$name = $featuredOrg['NAME'];
	$description = $featuredOrg['DESCRIPTION'];
	if(!isset($featuredOrg['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredOrg['Pics']['PIC']; }

}else{

	$org = new BOOrganizations;
	
	$featuredOrg= $org->getOrganizationsById($_GET['p']);
	//var_dump($featuredOrg);
	$userId = $featuredOrg[0]['USER_ID'];
	$name = $featuredOrg[0]['NAME'];
	$description = $featuredOrg[0]['DESCRIPTION'];

	if(!isset($featuredOrg[0]['Pics']['PIC'])){ $srcImg = 'default.jpg'; }
	else{ $srcImg = $featuredOrg[0]['Pics']['PIC']; }
	
}
?>


<div class="mod-header">
	<h2>Featured organization</h2>
</div>

<div class="mod-content clearfix">
	
	<div class="pic-caption">
		<a class='link-img' href=<?php echo "img/organizations/".$srcImg ?> >
			<img src= <?php echo "img/organizations/thumb/".$srcImg ?> class="thumb-mid"/>
		</a>
		<h3> <?php echo $name ?> </h3>
	</div>
	
	<div class="bg-txt txt-wider">
		
		<p> <?php echo $description ?> </p>

	</div>
	<a href= <?php echo "user-profile.php?u=".$userId; ?> ><span>Contact user >></span></a>
	
</div>

<script type="text/javascript">
	modalImg();
</script>